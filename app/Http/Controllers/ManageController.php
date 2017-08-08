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
		$notes = Note::where('user_id', Auth::user()->id)->take(5)->orderBy('created_at','dsc')->get();

		return view('user.profil')->withCustomers($customers)->withNotes($notes);
	}


   public function test()
   {
		$users = User::with('roles')->get();
		$permissions = Permission::all();

		foreach ($users as $user)
		{
			echo "<h2>".$user->name."</h2><hr />";

			foreach($user->roles as $role)
			{
				echo $role->display_name."<br />";
			}

			foreach($permissions as $permission)
			{
				if($user->can($permission->name))
				{
					echo $permission->display_name ." - TAK <br />";
				}
				else
				{
					echo $permission->display_name ." - NIE <br />";
				}

			}
				echo "<br />";
		}





	}

}
