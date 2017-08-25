<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use App\Note;


class AppServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {

	    view()->composer('layouts.partials.nav', function($view)
	     {

			$curl = curl_init();
			$urlCreate  = "https://api.smslabs.net.pl/apiSms/account";
			$appkey = config('constant.SmsLabsAppKey');
			$secret = config('constant.SmsLabsSecretKey');
			curl_setopt($curl, CURLOPT_HTTPAUTH, CURLAUTH_BASIC);
			curl_setopt($curl, CURLOPT_USERPWD, "$appkey:$secret");
			curl_setopt($curl, CURLOPT_URL, $urlCreate);
			curl_setopt($curl, CURLOPT_RETURNTRANSFER, 1);
			$result = json_decode(curl_exec($curl), true);
         if($result['status'] == 'success')
         {
            $smsbalance = $result['data']['account'];
            $smsconnect  = true;
         }
         else
         {
            $smsbalance = "0";
            $smsconnect  = false;
         }

			$notification_all = Note::where('notification','=','1')->get()->count();
			$notification_today = Note::where('notification','=','1')->where('notification_date','=', date('Y-m-d'))->get()->count();
			$notification_old = Note::where('notification','=','1')->where('notification_date','<', date('Y-m-d'))->get()->count();
			$notification_future = Note::where('notification','=','1')->where('notification_date','>', date('Y-m-d'))->get()->count();
			$notication = Note::where('notification','=','1')->where('notification_date','<=',date('Y-m-d'))->get()->count();






	        $view->with('notification_count', $notication)
                 ->with('smsbalance',$smsbalance)
                 ->with('smsconnect',$smsconnect)
				     ->with('notification_all',$notification_all)
				     ->with('notification_today',$notification_today)
				     ->with('notification_old',$notification_old)
				     ->with('notification_future',$notification_future);
	     });



		view()->composer('home', function($view)
 	     {

			$notification_all = Note::where('notification','=','1')->get()->count();
			$notification_today = Note::where('notification','=','1')->where('notification_date','=', date('Y-m-d'))->get()->count();
			$notification_old = Note::where('notification','=','1')->where('notification_date','<', date('Y-m-d'))->get()->count();
			$notification_future = Note::where('notification','=','1')->where('notification_date','>', date('Y-m-d'))->get()->count();
			$notication = Note::where('notification','=','1')->where('notification_date','<=',date('Y-m-d'))->get()->count();



 	        $view->with('notification_all',$notification_all)
			   ->with('notification_today',$notification_today)
			   ->with('notification_old',$notification_old)
			   ->with('notification_future',$notification_future);
 	     });


 	}

    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        //
    }
}
