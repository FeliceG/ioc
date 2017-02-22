<?php

namespace ioc\Http\Controllers;

use DB;
use Carbon;
use App\User;
use App\Research;
use Illuminate\Http\Request;

class EditController extends Controller
{
    //
    public function getShowResearch(Request $request) {
      $user = \Auth::user();

      if(is_null($user))
        return redirect()->route('login');

      $count = \ioc\Research::where('user_id', '=', $user->id)->count();
      $researches = \ioc\Research::where('user_id', '=', $user->id)->get();

        if ($count === 1 || $count === 2 )  {
            return view('/research/show')->with(['researches' => $researches, 'count' => $count, 'user' => $user]);
        } elseif ( $count < 2 ) {
            return view('/research/add');
        }
    }

    public function postShowResearch(Request $request) {
      $user = \Auth::user();

      if(is_null($user))
        return redirect()->route('login');

      if(is_null($request->research_id))
        return redirect()->route('show');

      $count = \ioc\Research::where('user_id', '=', $user->id)->count();
      $researches = \ioc\Research::where('user_id', '=', $user->id)->get();

      session(['research_id' => $request->research_id, 'researches' => $researches, 'count' => $count]);

      return redirect('/research/edit')->with(['research_id' => $request->research_id]);
    }

    public function getEditResearch(Request $request)
    {
      $research_id = $request->session()->get('research_id');

      $user = \Auth::user();
      if(is_null($user))
        redirect ('/login');

      $researches = \ioc\Research::where('id', '=', $research_id)->get();

       if(is_null($researches))
        {
          \Session::flash('message', 'ID for Research Not Found. You have been redirected to add a research submission.');
           return redirect('research/add');
        }

      $count = \ioc\Research::where('user_id', '=', $user->id)->count();
      session(['researches' => $researches, 'count' => $count]);
      return view('/research/edit')->with(['researches' => $researches, 'count' => $count]);
    }


    public function postEditResearch(Request $request)
    {

      $user = \Auth::user();
      if(is_null($user))
        redirect ('/login');

      if(is_null($request)) {
      \Session::flash('message', 'Research Entry Not Found');
      return redirect('research/add');
      }

        //Code to enter edited research paper or poster data into database table
        $research = \ioc\Research::find($request->research_id);
        $research->type = $request->type;
        $research->track = $request->track;
        $research->title = $request->title;
        $research->research = $request->research;
        $research->abstract = $request->abstract;
        $research->auth_count = $request->countAuths;

        for ($i=0; $i < $request->countAuths; $i++) {
            $first = "first" . $i;
            $last = "last" . $i;
            $research->$first = $request->$first;
            $research->$last = $request->$last;
        }
        $research->user_id = $user->id;

        $research->save();

        $count = \ioc\Research::where('user_id', '=', $user->id)->count();
        $researches = \ioc\Research::where('user_id', '=', $user->id)->get();

      session(['researches' => $researches, 'count' => $count, 'user' => $user]);
      return view('research.show')->with(['researches' => $researches, 'count' => $count, 'user' => $user]);
    }

    public function getDeleteResearch(Request $request)
    {
      $research_id = $request->session()->get('research_id');

      $user = \Auth::user();
      if(is_null($user))
        redirect ('/login');

      $count = \ioc\Research::where('user_id', '=', $user->id)->count();
      $researches = \ioc\Research::where('user_id', '=', $user->id)->get();

       if(is_null($researches))
        {
          \Session::flash('message', 'ID for Research Not Found. You have been redirected to add a research submission.');
           return redirect('research/add');
        }

      session(['researches' => $researches, 'count' => $count, 'user' => $user]);
      return view('/research/delete')->with(['researches' => $researches, 'count' => $count, 'user' => $user]);
    }


    public function postDeleteResearch(Request $request)
    {
      $user = \Auth::user();
  		if(is_null($user))
  			redirect ('/login');

  				$research_id = $request->research_id;

  				$submission = \ioc\Research::find($research_id);

  				$submission->delete();

  				\Session::flash('message', 'Your selected research entry was deleted.');

  				$count = \ioc\Research::where('user_id', '=', $user->id)->count();
  				session(['count' => $count]);

  				\Session::flash('message', 'Your selected research entry was deleted.');

  		return view('research.add')->with(['count' => $count]);
    }
}
