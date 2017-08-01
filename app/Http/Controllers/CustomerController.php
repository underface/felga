<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Str;
use App\Customer;
use App\Note;
use App\User;
use Auth;
use Session;

class CustomerController extends Controller
{
    public function index ()
    {
      $customers = Customer::orderBy('id', 'asc')->paginate(10);
      return view('customer.index')->withCustomers($customers);
   }

   public function create()
   {
      return view('customer.create');
   }

   public function store(Request $request)
   {
      $this->validate($request, array(
         'name'         => 'required|min:6|max:255',
         'number_phone' => 'unique:customers|required|min:9|max:9'
      ));
      $customer = new Customer;
      $customer->name         = Str::upper($request->name);
      $customer->number_phone = $request->number_phone;
      $customer->save();

      return view('customer.store')->withCustomer($customer);
   }

   public function show ($id)
   {
      $customer = new Customer;
      $customer = Customer::findorfail($id);

      $notes = new Note;
      $notes = Note::where('customer_id', $id)->orderBy('updated_at', 'desc')->paginate(15);

      $data = date('d-m-Y');

      return view('customer.show')->withCustomer($customer)->withNotes($notes)->withData($data);
   }

   public function addNote (Request $request)
   {
      $this->validate($request, array(
         'customer_id'  => 'required',
         'content'      => 'required',
         'title'        => 'max:50'
      ));

      $note = new Note;

      $note->customer_id       = $request->customer_id;
      $note->user_id           = Auth::user()->id;
      $note->notification      = $request->notification;
      $note->notification_date = $request->notification_date;
      $note->title             = Str::upper($request->title);
      $note->content           = $request->content;
      $note->save();
      Session::flash('message', 'Dodano notatkę!');
      return redirect()->route('customer.show', ['id' => $note->customer_id]);

   }

   public function delNotification(Request $request)
   {

      $note = Note::findorfail($request->note_id);

      $note->notification = 0;
      $note->content .= " (".Auth::user()->name." wyłączył powiadomienie dnia:".date('d-m-Y H:i').")";
      $note->updated_at = date('Y-m-d H:i:s');
      Session::flash('message', "Usunięto powiadomienie notatki ID: ".$note->id);
      $note->save();
      return redirect()->route('customer.show', ['id' => $note->customer_id]);
   }

   public function destroy(Request $request)
   {

      $note = Note::findorfail($request->note_id);
      Session::flash('message', "Usunięto notatkę ID: ".$note->id);
      $note->delete();
      return redirect()->route('customer.show', ['id' => $note->customer_id]);
   }

   public function sendSMS(Request $request)
   {
      $this->validate($request, array(
         'content' => 'min:20|max:160|required',
         'number_phone' => 'required'
      ));

      $note = new Note;

      $note->title = "Wysyłka SMS na nr: ".$request->number_phone;
      $note->content = $request->content;
      $note->user_id = Auth::user()->id;
      $note->customer_id= $request->customer_id;
      $note->notification = 0;
      $note->notification_date = date('Y-m-d');

      //$note->save(); // zapis wiadomości jako notatki

      $curl = curl_init();
      $urlCreate  = "https://api.smslabs.net.pl/apiSms/sendSms";
      $appkey = '082910da5f526163218f13d53ca13c05344bdc64';
      $secret = '855f5ae3839d87b20d3a29459a81feb11cfaf2f8';
       $data = array(
           'flash' => '0',
           'expiration' => '0',
           'phone_number' => "+48".$request->number_phone,
           'sender_id' => 'SMS INFO',
           'message' => $request->content,

       );
       $result = ""; $error ="";
      curl_setopt($curl, CURLOPT_POSTFIELDS, http_build_query($data));
      curl_setopt($curl, CURLOPT_CUSTOMREQUEST, "PUT");
      curl_setopt($curl, CURLOPT_HTTPAUTH, CURLAUTH_BASIC);
      curl_setopt($curl, CURLOPT_USERPWD, "$appkey:$secret");
      curl_setopt($curl, CURLOPT_URL, $urlCreate);
      curl_setopt($curl, CURLOPT_RETURNTRANSFER, 1);
      $result = curl_exec($curl);
      $error = curl_error($curl);

      if(!empty($error))
      {
         Session::flash('message', "Status wysyłki SMSa BŁĄD!: ". $error);
      }
      else {
         $note->save(); // zapis wiadomości jako notatki
         Session::flash('message', "Status wysyłki SMSa: ". $result);
      }

      return redirect()->route('customer.show', ['id' => $note->customer_id]);


   }

   public function found($number)
   {
	   $customer = new Customer;
	   $customer = Customer::where('number_phone','=', $number)->first();
	   return redirect()->route('customer.show', $customer->id);
  }

  public function searchbox()
  {
  	return view('customer.searchbox');
  }

  public function search(Request $request)
  {
	  $this->validate($request, array(
		  'search' => 'required|min:3'
	  ));

	  $customers = Customer::where('number_phone', '=', $request->search)->orwhere('name', 'Like', "%".$request->search."%")->orderby('name','asc')->paginate(10);
	  Session::flash('message', "Wyniki wyszukiwania: ". $customers->count());
   	  return view('customer.index')->withCustomers($customers);
  }
}
