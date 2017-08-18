<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Auth;
use Session;

use App\User;
use App\Note;
use App\Customer;



class SendSMSContoller extends Controller
{
    //

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
	       $appkey = '082910da5f526163218f13d53ca13c05344bdc64';
	       $secret = '855f5ae3839d87b20d3a29459a81feb11cfaf2f8';
	        $data = array(
	            'flash' => '0',
	            'expiration' => '0',
	            'phone_number' => "+48".$customer->number_phone,
	            'sender_id' => 'SMS INFO',
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
	       $result = curl_exec($curl);
	       $error = curl_error($curl);

	 		 $note = new Note;
	       $note->title        = Str::upper("Wysyłka SMS z kategorii #".date('Y-m-d')." na nr: ".$customer->number_phone);
	       $note->content = $request->content." (".$result.")";
	       $note->user_id = Auth::user()->id;
	       $note->customer_id  = $customer_id;
	       $note->notification = 0;
	       $note->notification_date = date('Y-m-d');

			 $note->save();
		 }

		 Session::flash('message', 'Wysłano!');
       // $users = User::where('id', $request->customer_id)->all();
		 return view('category.sendSMS');//->withUsers($users);

	 }
}
