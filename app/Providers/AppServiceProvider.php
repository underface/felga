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

		/*	$curl = curl_init();

			$urlCreate  = "https://api.smslabs.net.pl/apiSms/account";

			$appkey = '082910da5f526163218f13d53ca13c05344bdc64';
			$secret = '855f5ae3839d87b20d3a29459a81feb11cfaf2f8';

			curl_setopt($curl, CURLOPT_HTTPAUTH, CURLAUTH_BASIC);
			curl_setopt($curl, CURLOPT_USERPWD, "$appkey:$secret");
			curl_setopt($curl, CURLOPT_URL, $urlCreate);
			curl_setopt($curl, CURLOPT_RETURNTRANSFER, 1);

			$result = curl_exec($curl);

			preg_match( '/\d+}/', $result, $result);
			$result= $result[0];

			$SMSBalance = str_replace ('}',"",$result);

			*/
			$SMSBalance = 1000;
			$notification_all = Note::where('notification','=','1')->get()->count();
			$notification_today = Note::where('notification','=','1')->where('notification_date','=', date('Y-m-d'))->get()->count();
			$notification_old = Note::where('notification','=','1')->where('notification_date','<', date('Y-m-d'))->get()->count();
			$notification_future = Note::where('notification','=','1')->where('notification_date','>', date('Y-m-d'))->get()->count();
			$notication = Note::where('notification','=','1')->where('notification_date','<=',date('Y-m-d'))->get()->count();






	        $view->with('notification_count', $notication)->with('smsbalance',$SMSBalance)
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
