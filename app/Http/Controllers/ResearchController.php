<?php

namespace ioc\Http\Controllers;

use DB;
use Carbon;
use App\User;
use App\Research;
use Illuminate\Http\Request;

class ResearchController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
      return view('/');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
      $user = \Auth::user();

      if(is_null($user))
        redirect ('/login');

              $count = \ioc\Research::where('user_id', '=', $user->id)->count();

              if ($count < 2) {
                return view('research.add');
              }
              else {
                 $researches = \ioc\Research::where('user_id', '=', $user->id)->get();
                 session(['researches' => $researches, 'count' => $count]);
                 return view('research.show')->with(['researches' => $researches, 'count' => $count]);
              }
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */

    public function store(Request $request)
    {

      $user = \Auth::user();
      if(is_null($user))
        redirect ('/login');

      $count = \ioc\Research::where('user_id', '=', $user->id)->count();

      if(is_null($request))
        return redirect()->route('/research/add');

      //Code to enter research paper or poster into database table
      if($count < 2) {
          $research = new \ioc\Research();
          $research->type = $request->type;
          $research->track = $request->track;
          $research->title = $request->title;
          $research->research = $request->research;
          $research->abstract = $request->abstract;
          $research->auth_count = $request->countAuths;
          $research->user_id = $user->id;

          for ($i=0; $i <= $request->countAuths; $i++) {
              $first = "first" . $i;
              $last = "last" . $i;
              $org = "org" . $i;
               if ( ($request->$first != "") && ($request->$last != "") && ($request->$org != "")) {
               $research->$first = $request->$first;
               $research->$last = $request->$last;
               $research->$org = $request->$org;
            }
          }

          $research->save();

        } else {
           $researches = \ioc\Research::where('user_id', '=', $user->id)->get();
          \Session::flash('message', 'You have reached the maximum of 2 research submissions.');
           return redirect('/research/show')->with(['researches' => $researches, 'count' => $count, 'user' => $user]);
           //redirect()->route('/research/show');
        }

          $researches = \ioc\Research::where('user_id', '=', $user->id)->get();

          session(['researches' => $researches, 'count' => $count, 'user' => $user]);
          return redirect('/research/show')->with(['researches' => $researches, 'count' => $count, 'user' => $user]);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $user = \Auth::user();

          dump("show");

        if(is_null($user))
          return redirect()->route('login');

        $count = \ioc\Research::where('user_id', '=', $user->id)->count();
        $researches = \ioc\Research::where('user_id', '=', $user->id)->get();

          if ($count === 2 )  {
              return view('/research/show')->with(['researches' => $researches, 'count' => $count, 'user' => $user]);
          } elseif ( $count < 2 ) {
              return view('/research/add');
          }
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */

    public function edit(Request $request, $id)
    {

    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {

    }
}
