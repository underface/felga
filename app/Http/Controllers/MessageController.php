<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

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


      $messages = Message::paginate(20);


      return view('messages.index')->withMessages($messages)
                                   ->withSmsbalance($smsbalance)
                                   ->withSmsconnect($smsconnect);
   }
}
