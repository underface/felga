<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Auth;
use Session;

use App\Note;
use App\Customer;
use App\Category;

class NoteController extends Controller
{


    public function index()
    {
      $notes = new Note;
      $notes = Note::orderBy('updated_at', 'desc')->paginate(10);
      return view('note.index')->withNotes($notes);
   }

   public function notification($type = null)
   {
     $notes = new Note;

	switch($type)
	{
		case "old":
			Session::flash('type', 'Powiadomienia po terminie');
			$notes = Note::where('notification_date','<', date('Y-m-d'))->where('notification','=','1')->orderBy('updated_at', 'desc')->paginate(20);
		break;

		case "today":
			Session::flash('type', 'Powiadomienia na dziś');
			$notes = Note::where('notification','=','1')->where('notification_date','=', date('Y-m-d'))->orderBy('updated_at', 'desc')->paginate(20);
		break;

		case "future":
			Session::flash('type', 'Powiadomienia po terminie');
			$notes = Note::where('notification','=','1')->where('notification_date','>', date('Y-m-d'))->orderBy('updated_at', 'desc')->paginate(20);
		break;

		default:
			$notes = Note::where('notification', '=', '1')->orderBy('updated_at', 'desc')->paginate(20);
			Session::flash('type', 'Powiadomienia');
		break;
	}


	$notification_all = Note::where('notification','=','1')->get()->count();
	$notification_today = Note::where('notification','=','1')->where('notification_date','=', date('Y-m-d'))->get()->count();
	$notification_old = Note::where('notification','=','1')->where('notification_date','<', date('Y-m-d'))->get()->count();
	$notification_future = Note::where('notification','=','1')->where('notification_date','>', date('Y-m-d'))->get()->count();


     return view('note.notification')->withNotes($notes)
							  ->withNotification_all($notification_all)
							  ->withNotification_today($notification_today)
					  		  ->withNotification_old($notification_old)
							  ->withNotification_future($notification_future);
  }

  public function delNotification(Request $request)
  {
	  	// usunięcie powiadomienia - notatka zostaje
	  $note = Note::findorfail($request->note_id);

       $note->notification = 0;
       $note->content .= " (".Auth::user()->name." wyłączył powiadomienie dnia:".date('d-m-Y H:i').")";
       $note->updated_at = date('Y-m-d H:i:s');
       Session::flash('message', "Usunięto powiadomienie notatki ID: ".$request->note_id);
       $note->save();
       return redirect()->route('note.notification');
  }

  public function destroy(Request $request)
  {
	$note = Note::findorfail($request->id);
  	Session::flash('message', "Usunięto notatkę ID: ".$note->id);
  	$note->delete();
  	return redirect()->route('note.notification');
  }

	public function create()
	{
		$categories = Category::all();
		return view('note.create')->withCategories($categories);
	}

	public function store(Request $request)
	{
		$categories = Category::all();
		switch($request->submitbutton)
		{
			case "check":
				$customer = Customer::where('number_phone',$request->number_phone)->first();
				return view('note.create')->withCustomer($customer)->withCategories($categories);
				break;

			case "save":
				return "store";
				break;
		}
	}

}
