<?php

namespace ioc\Http\Controllers;

use DB;
use Carbon;
use App\User;
use App\Research;
use Illuminate\Http\Request;


class PageController extends Controller
{
  public function home() {
    return view('home');
  }

  public function information() {
    return view('information');
  }

  public function eligibility() {
    return view('eligibility');
  }

  public function guidelines() {
    return view('guidelines');
  }

}
