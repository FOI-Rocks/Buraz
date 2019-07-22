<?php


namespace App\Http\Controllers\Admin;


use App\Http\Controllers\Controller;
use App\Mentor;
use App\Student;
use App\User;
use Exception;
use Illuminate\Support\Facades\Mail;


class EmailController extends Controller
{
    public function getPage()
    {
        return view('admin.email');
    }

    public function sendEmail()
    {
        $recipient = request()->get('recipients');
        $subject = request()->get('subject');
        $header = request()->get('header');
        $message = request()->get('message');

        if (!($message && $recipient && $subject && $header)) {
            return "Unesite sva polja!";
        }
        $recipients = false;
        switch ($recipient) {
            case 'mentori':
                $recipients = Mentor::all();
                break;
            case 'studenti':
                $recipients = Student::all();
                break;
            default:
                $recipients = User::all();
                break;
        }

        $sentEmailsNum = 0;
        $sentEmails = "";
        $notSentEmail = "";
        foreach ($recipients as $m) {
            if ($m->getTable() == 'users') {
                $user = $m;
            } else {
                $user = $m->user;
            }
            if ($user->email != null) {
                try {
                    Mail::send('email.masterbutton',
                        [
                            'header' => $header,
                            'paragraphs' => [
                                $message
                            ]
                        ],
                        function ($message) use ($user, $subject) {
                            $message->from('noreply@foi.rocks', 'FOI Buraz');
                            $message->to($user->email, $user->ime);
                            $message->subject($subject);
                        }
                    );
                    $sentEmails .= $user->name . " => SENT </br>";
                    $sentEmailsNum++;
                } catch (Exception $e) {
                    $notSentEmail .= $user->email . "=> ERROR </br>";
                }
            } else {
                $notSentEmail .= $user->name . " => SKIPPING </br>";
            }
        }

        return "Ukupno poslano emailova: " . $sentEmailsNum . "</br> Mailovi poslani: " . $sentEmails . "</br> Mailovi nisu poslani: " . $notSentEmail;
    }

}