<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Hash;
use Mail;

use Session;
use App\User;
use App\Role;
use App\Permission;

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
	 	$user = User::findOrFail($id);

		$this->validate($request, array(
			'name' => 'required|min:3|max:255',
			'login' => 'required|min:3|max:255',
			'email' => 'required|email|min:7|max:255'
		));
		$user->name !== $request->name ? $user->name = $request->name : "" ;
		$user->login !== $request->login ? $user->login = $request->login : "" ;
		$user->email !== $request->email ? $user->email = $request->email : "" ;
		//
		//$user->name = $request->name;
		if(!empty($request->password))
		{
			$user->password = bcrypt($request->password);
		}

		$user->save();
		Session::flash('message', "Zaktualizowano dane użytkowanika");
		return redirect()->route('admin.show',$user->id);

	 }

	 public function role()
	 {
		 $roles = Role::all();
		 return view('admin.role.index')->withRoles($roles);
	 }


	 public function role_show($id)
	 {
		 $role = Role::findOrFail($id);
		 $permissions = Permission::all();
		 return view('admin.role.show')->withRole($role)->withPermissions($permissions);
	 }


	 public function role_edit($id, Request $request)
	 {
	 	$role = Role::findOrFail($id);
		$role->permissions()->sync($request->permission);

		Session::flash('message', "Zaktualizowano uprawnienia roli.");
		return redirect()->route('admin.role.show',$id);
	 }

	 public function permission()
	 {
		 $permissions = Permission::all();
		 return view('admin.permission.index')->withPermissions($permissions);
	 }

	 public function permission_edit($id)
	 {
		 $permission = Permission::findOrFail($id);
		 return view('admin.permission.edit')->withPermission($permission);
	 }

	 public function permission_update($id, Request $request)
	 {

		 $this->validate($request, array(
			 'display_name' => 'required|min:3|max:255',
			 'description' => 'required|min:3|max:255'
		 ));
		 $permission = permission::findOrFail($id);

		 $permission->display_name = $request->display_name;
		 $permission->description = $request->description;
		 $permission->save();

		 Session::flash('message', "Zaktualizowano uprawnienia id:".$id);
		 return redirect()->route('admin.permission.index');
	 }

	 public function permission_delete($id)
	 {
		 $permission = Permission::findOrFail($id);
		 $name = $permission->display_name;
		 $permission->delete();

		 Session::flash('message', "Usunięto uprawnienie: ".$name);
		 return redirect()->route('admin.permission.index');
	 }


	 public function permission_create()
	 {
		 return view('admin.permission.create');
	 }

	 public function permission_store(Request $request)
   {
		$this ->validate($request, array(
			'name' => 'required|min:4|max:255|unique:permissions',
			'display_name' => 'required|min:4|max:255|unique:permissions',
			'description' => 'required|min:4|unique:permissions'
		));

		dd($request->name);

		$permision = new Permission;
		$permission->name = $request->name;
		$permission->display_name = $request->display_name;
		$permission->description = $request->description;

		dd($permission);
   }

}
