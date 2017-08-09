<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Auth;
use App\User;
use App\Customer;
use App\Note;
use App\Permission;

class ManageController extends Controller
{
    //

   public function index()
   {
     return redirect()->route('manage.panel');
  }

   public function panel()
   {
   return view('manage.panel');
   }


	public function profil(){
		$user = User::where('id', Auth::user()->id)->get();

		$customers = Customer::where('user_id', Auth::user()->id)->orderBy('created_at','dsc')->take(5)->get();
		$notes = Note::where('user_id', Auth::user()->id)->orderBy('created_at','dsc')->take(5)->get();

		return view('user.profil')->withCustomers($customers)->withNotes($notes);
	}


}
