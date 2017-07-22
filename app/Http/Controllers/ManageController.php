<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

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

}
