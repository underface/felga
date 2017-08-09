<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Hash;
use Mail;

use Session;
use App\User;

class AdminController extends Controller
{
    //

	 public function index()
	 {
		 $users = User::all();
		 return view('admin.index')->withUsers($users);
	 }

	 public function create()
	 {
		 return view('admin.create');
	 }

	 public function store(Request $request)
	 {
		 $this->validate($request, array(
			 'name' => 'required|unique:users|min:3|max:255',
			 'login' => 'required|unique:users|min:3|max:255',
			 'email' => 'required|unique:users|email|min:7|max:255',
			 'password' => 'required|min:6'
		 ));

		 $user = new User;
		 $user->name = $request->name;
		 $user->login = $request->login;
		 $user->email = $request->email;
		 $user->password = bcrypt($request->name);
		 $user->save();
		 $user->attachRole('administrator');

		 Session::flash('message', "Dodano użytkownika: ".$user->name."!");

		 return redirect()->route('admin.index');

	 }

	 public function show($id)
	 {
		 	$user = User::where('id', $id)->first();
			return view('admin.show')->withUser($user);
	 }

	 public function deleteaccess($id)
	 {
		 $user = User::where('id', $id)->first();

		 $user->detachRoles(['Administrator','Superadministrator','User']);
		 Session::flash('message', "Usunięto dostęp do systemu");

		 return redirect()->route('admin.show',$user->id);

	 }

	 public function access($id)
	 {
		 $user = User::where('id', $id)->first();
		 $user->attachRoles(['Administrator']);
		 Session::flash('message', "Dodano uprawneinia do systemu");

		 return redirect()->route('admin.show',$user->id);
	 }

	 public function edit($id)
	 {
		 $user = User::where('id', $id)->first();
		 return view('admin.edit')->withUser($user);
	 }

	 public function update($id, Request $request)
	 {
	 	return "Test";
	 }


}
