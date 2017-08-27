<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Str;
use App\Customer;
use App\Note;
use App\User;
use App\Category;
use App\Message;
use Auth;
use Session;

class CustomerController extends Controller
{
    public function index ()
    {
      $customers = Customer::orderBy('name', 'asc')->paginate(15);
      return view('customer.index')->withCustomers($customers);
   }

   public function create()
   {
	   $categories = new Category;
	   $categories = Category::all();
      return view('customer.create')->withCategories($categories);
   }

   public function store(Request $request)
   {

      $this->validate($request, array(
         'name'         => 'required|min:6|max:255',
         'number_phone' => 'unique:customers|required|min:9|max:9'
      ),array(
         'name'=>'Wpisałeś złą nazwę',
         'number_phone' => 'Taki numer już występuje!'
      ));
      $customer = new Customer;
      $customer->name         = Str::upper($request->name);
      $customer->number_phone = $request->number_phone;
		$customer->email = $request->email;
      $customer->save();
	   $customer->categories()->attach($request->categories);
      return view('customer.store')->withCustomer($customer);
   }

   public function show ($id)
   {
      $customer = new Customer;
      $customer = Customer::findorfail($id);

      $notes = new Note;
      $notes = Note::where('customer_id', $id)->orderBy('updated_at', 'desc')->paginate(15);
      return view('customer.show')
	 		->withCustomer($customer)
	 		->withNotes($notes)
			->withData(date('d-m-Y'))
	 		->withCategories($categories = Category::all());
   }

   public function add_category(Request $request)
   {
	   $customer = Customer::findorfail($request->customer_id);
	   $customer->categories()->sync($request->categories);

	   return redirect()->route('customer.show', $request->customer_id);
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

  public function checked($id)
  {
     $customer = Customer::findorfail($id);

     $customer->checked = 1;

     $customer->save();
     Session::flash('message', "Zmieniono status na sprzedaż zakończona!");
     return redirect()->route('customer.show', $customer->id);
 }

 public function unchecked($id)
 {
    $customer = Customer::findorfail($id);

    $customer->checked = 0;

    $customer->save();
    Session::flash('message', "Zmieniono status na zainteresowany ofertą!");
    return redirect()->route('customer.show', $customer->id);
}
}
