<?php

namespace ioc\Http\Controllers;

use DB;
use Carbon;
use App\User;
use App\Research;
use Illuminate\Support\Facades\Mail;
use Illuminate\Http\Request;

class EmailController extends Controller
{

/*public function send() {
*  \Mail::send([], [], function ($message) {
*    $message->to('felice.gardner@gmail.com')
    ->subject('Test Message')
    ->setBody('This is a test message; Testing 123.');
  });

  return 'Basic, plain text email sent.';
}

public function accepted() {
  $user = \Auth::user();

  if(!user) return redirect()->guest('login');

  $count = \ioc\Research::where('user_id', '=', $user->id)->count();
  $researches = \ioc\Research::where('user_id', '=', $user->id)->get();

  $data = array(
    'user' => $user,
    'researches' => $researches,
    'count' => $count,
  );
  \Mail::send(research.submission-accepted, $data, function ($message) use ($user, $researches, $count){

    $recipient_email = $user->email;
    $recipient_name = $user->first;
    $subject = "Institute of Coaching Research Submission";
    $message->to($recipient_email, $recipient_name)->subject($subject);
  });

echo 'HTML email sent.';
}

}
*/
