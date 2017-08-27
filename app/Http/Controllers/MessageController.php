<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Auth;
use Session;

use App\User;
use App\Note;
use App\Customer;
use App\Message;

class MessageController extends Controller
{
    public function index()
    {
      $curl = curl_init();
      $urlCreate  = "https://api.smslabs.net.pl/apiSms/account";
      $appkey = config('constants.SmsLabsAppKey');
      $secret = config('constants.SmsLabsSecretKey');;
      curl_setopt($curl, CURLOPT_HTTPAUTH, CURLAUTH_BASIC);
      curl_setopt($curl, CURLOPT_USERPWD, "$appkey:$secret");
      curl_setopt($curl, CURLOPT_URL, $urlCreate);
      curl_setopt($curl, CURLOPT_RETURNTRANSFER, 1);
      $result = json_decode(curl_exec($curl), true);
      if($result['status'] == 'success')
      {
         $smsbalance = $result['data']['account']; $smsconnect  = true;
      }
      else
      {
         $smsbalance = "0"; $smsconnect  = false;
      }


      $messages = Message::orderBy('created_at','dsc')->paginate(20);


      return view('messages.index')->withMessages($messages)
                                   ->withSmsbalance($smsbalance)
                                   ->withSmsconnect($smsconnect);
   }


   public function sendSMS(Request $request)
   {
      $this->validate($request, array(
         'content' => 'min:20|max:160|required',
         'number_phone' => 'required'
      ));

      $curl = curl_init();
      $urlCreate  = "https://api.smslabs.net.pl/apiSms/sendSms";
      $appkey = config('constants.SmsLabsAppKey');
      $secret = config('constants.SmsLabsSecretKey');
       $data = array(
           'flash' => '0',
           'expiration' => '0',
           'phone_number' => "+48".$request->number_phone,
           'sender_id' => config('constants.SmsLabsSenderID'),
           'message' => $request->content,

       );
       $result = ""; $error ="";
      curl_setopt($curl, CURLOPT_POSTFIELDS, http_build_query($data));
      curl_setopt($curl, CURLOPT_CUSTOMREQUEST, "PUT");
      curl_setopt($curl, CURLOPT_HTTPAUTH, CURLAUTH_BASIC);
      curl_setopt($curl, CURLOPT_USERPWD, "$appkey:$secret");
      curl_setopt($curl, CURLOPT_URL, $urlCreate);
      curl_setopt($curl, CURLOPT_RETURNTRANSFER, 1);
      $result = json_decode(curl_exec($curl),true);

      $error = curl_error($curl);


      if($result['status'] == null)
      {
         $result['status'] = "ERROR";
         $result['message'] = "SSL certificate problem: unable to get local issuer certificate";
      }
      $note = new Note;
         $note->title = "Wysyłka SMS na nr: ".$request->number_phone;
         $note->content = $request->content." (".$result['status']."- ".$result['message'].")";
         $note->user_id = Auth::user()->id;
         $note->customer_id= $request->customer_id;
         $note->notification = 0;
         $note->notification_date = date('Y-m-d');

      if($result['status'] !== 'success')
      {
         Session::flash('message', "Status wysyłki SMSa : ".$result['message']);
      }
      else {
         $note->save(); // zapis wiadomości jako notatki
         Session::flash('message', "Status wysyłki SMSa: ". $result['status']);
      }

      $message = new Message;
         $message ->status = $result['status'];

         if($result['status'] == 'success'){
            $message->sms_id = $result['data']['sms_id'];
         }
         else {
            $message->sms_id = "Błąd";
         }
         $message ->user_id =  Auth::user()->id;

         if($result['status'] == 'success'){
            $message ->note_id = $note->id;
         }
         else{
            $message->note_id = 0;
         }
         $message->customer_id = $request->customer_id;
         $message->message = $result['message'];
         $message->save();

      return redirect()->route('customer.show', ['id' => $note->customer_id]);


   }



   public function send(Request $request)
   {
      if($request->customer_id == null)
      {
         $this->validate($request, array(
            "customer_id"=> "required",
            "content" => "required"
         ));
         return redirect()->route('category.show', $request->category_id)->withRequest($request);
      }

      foreach($request->customer_id as $customer_id)
      {
         $customer = Customer::findOrFail($customer_id);

         $curl = curl_init();
         $urlCreate  = "https://api.smslabs.net.pl/apiSms/sendSms";
         $appkey = config('constants.SmsLabsAppKey');
         $secret = config('constants.SmsLabsSecretKey');
          $data = array(
              'flash' => '0',
              'expiration' => '0',
              'phone_number' => "+48".$customer->number_phone,
              'sender_id' => config('constants.SmsLabsSenderID'),
              'message' => $request->content,
           );
         $result = "";
         $error ="";
         curl_setopt($curl, CURLOPT_POSTFIELDS, http_build_query($data));
         curl_setopt($curl, CURLOPT_CUSTOMREQUEST, "PUT");
         curl_setopt($curl, CURLOPT_HTTPAUTH, CURLAUTH_BASIC);
         curl_setopt($curl, CURLOPT_USERPWD, "$appkey:$secret");
         curl_setopt($curl, CURLOPT_URL, $urlCreate);
         curl_setopt($curl, CURLOPT_RETURNTRANSFER, 1);
         $result = json_decode(curl_exec($curl),true);

         $error= curl_error($curl);

         $note = new Note;
         $note->title        = Str::upper("Wysyłka SMS z kategorii #".date('Y-m-d')." na nr: ".$customer->number_phone);
         $note->content = $request->content." (".$result['status']."- ".$result['message'].")";
         $note->user_id = Auth::user()->id;
         $note->customer_id  = $customer_id;
         $note->notification = 0;
         $note->notification_date = date('Y-m-d');

         if($result['status'] == null)
         {
            $result['status'] = "ERROR";
            $result['message'] = "SSL certificate problem: unable to get local issuer certificate";
         }

         if($result['status'] !== 'success')
         {
            Session::flash('message', "Status wysyłki SMSa : ".$result['message']);
         }
         else {
            $note->save(); // zapis wiadomości jako notatki
            Session::flash('message', "Status wysyłki SMSa: ". $result['status']);
         }

         $message = new Message;
            $message ->status = $result['status'];

            if($result['status'] == 'success'){
               $message->sms_id = $result['data']['sms_id'];
            }
            else {
               $message->sms_id = "Błąd";
            }
            $message ->user_id =  Auth::user()->id;

            if($result['status'] == 'success'){
               $message ->note_id = $note->id;
            }
            else{
               $message->note_id = 0;
            }
            $message->customer_id = $customer->id;
            $message->message = $result['message'];
            $message->save();
      }

      Session::flash('message', 'Wysłano!');
      $customers = Customer::wherein('id', $request->customer_id)->get();
      return view('category.sendSMS')->withCustomers($customers)->withRequest($request);

   }
}
