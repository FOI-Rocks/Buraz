<?php


namespace App\Http\Controllers\Admin;


use App\Http\Controllers\Controller;
use App\Mentor;
use App\Student;
use DateTime;
use Exception;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Mail;

class SettingsController extends Controller
{
    public function getSettingsPage()
    {
        return view('admin.settings');
    }

    public function setMatching()
    {
        $error = false;
        $response = [];
        try {
            $response = $this->setEnvironmentValue('APP_MATCHING', 'true', 'false');
        } catch (Exception $exception) {
            $error = $exception;
        }

        if (!$error) {
            echo "</br> Matching postavljen na true </br>" .$response[0];
        } else {
            echo "</br> Greška prilikom postavljanja matchinga na true: </br>" . $error->getMessage() . "</br>" . $response[1];
        }
    }

    public function notifyMatch()
    {
        $students = Student::where('notified', false)->get();
        foreach($students as $s) {
            if($s->mentor_id !== null) {
                if($s->user_id != 265) $s->sendBigBroNotificationEmail(true);
                $s->bigBro()->mentor->sendLittleBroNotificationEmail($s, true);
            }
        }
        echo "Korisnici su obaviješteni!";
    }

    public function setStudentsAsMentors()
    {
        $error = false;
        try {
            $this->setEnvironmentValue('APP_MATCHING', 'false', 'true');
        } catch (Exception $exception) {
            $error = $exception;
        }


        $students = DB::table('students')->get();
        $newMentors = [];
        foreach ($students as $student) {
            $mentor = [
                'user_id' => $student->user_id,
                'visible' => true,
                'created_at' => new DateTime(),
                'updated_at' => new DateTime()
            ];
            array_push($newMentors, $mentor);

        }
        try {
            DB::table('mentors')->insert($newMentors);
            echo "Akcija uspiješno provedena: </br>";
            echo "Ukupan broj premještaja: " . count($newMentors);
            if (!$error) {
                echo "</br> Matching postavljen na false </br>";
            } else {
                echo "</br> Greška prilikom postavljanja matchinga na false: </br>" . $error->getMessage();
            }
        } catch (Exception $e) {
            return $e;
        }
    }

    public function setEnvironmentValue($envKey, $envValue, $oldValue)
    {
        $envFile = app()->useEnvironmentPath(base_path('..'))->basePath() . "/.env";
        $str = file_get_contents($envFile);

        //$oldValue = strtok($str, "{$envKey}=");

        $str = str_replace("{$envKey}={$oldValue}", "{$envKey}={$envValue}", $str);

        $fp = fopen($envFile, 'w');
        fwrite($fp, $str);
        fclose($fp);

        $result = "";
        $error = "";
        if($envValue){
            $students = Student::where('mentor_id', null)->get();
            foreach($students as $s) {
                $bro = $s->assignBigBro(true);
                if($bro != null) {
                    $same = $s->user->study_id == $bro->study_id;
                    $result .= "</br>". ($same?"Y":"N").($bro->mentor->visible?"Y":"N") . " " . $s->user->name . ": " . $s->user->email . " -> " . $bro->name . ": " . $bro->email;
                }
                else {
                    $error .= '</br> Error occurred matching: ' . $s->name;
                }
            }
        }
        return [$result,$error];
    }

    public function truncateStudentsTable()
    {
        try {
            DB::table('students')->truncate();
            echo "Akcija uspiješno provedena";
        } catch (Exception $e) {
            print_r($e);
        }
    }

    public function setMentorsAsInactive()
    {
        try {
            DB::table('mentors')
                ->update(['visible' => 0]);
            echo "Akcija uspiješno provedena";
        } catch (Exception $e) {
            print_r($e);
        }
    }

    public function resetStudentCount()
    {
        try {
            DB::table('mentors')
                ->update(['student_count' => 0]);
            echo "Akcija uspiješno provedena";
        } catch (Exception $e) {
            print_r($e);
        }
    }

    public function sendEmailsToMentors()
    {
        $mentors = Mentor::all();
        $sentEmailsNum = 0;
        $sentEmails = "";
        $notSentEmail = "";
        foreach ($mentors as $m) {
            $user = $m->user;
            if ($user->email != null) {
                try {
                    Mail::send('email.masterbutton',
                        [
                            'header' => 'Pomozi sljedećoj generaciji brucoša!',
                            'paragraphs' => [
                                'Pozdrav ' . explode(' ', $user->name)[0] . ',<br>' .
                                'nadam se da još uvijek uživaš u punom sjaju ljeta, no dopusti mi da ti ukradem minutu života kako bi i ove godine pomogli stotinama studenata pri snalaženju u prvim mjesecima studiranja!',
                                'Kako nam se nova akademska godina približava, to znači da ćemo opet viđati puno novih i zbunjenih lica po faksu. Upravo zbog toga bih te zamolio da uzmeš 30 sekundi svoga vremena i ponovo se uključiš u Buraz program kao Veliki Buraz. <a href="https://www.facebook.com/foi.rocks/photos/pcb.459977257538862/459977174205537/?type=3&theater">Feedback od prošle godine govori da je biti Veliki Buraz jako jednostavno.</a> A s druge strane, <a href="https://www.facebook.com/foi.rocks/photos/?tab=album&album_id=460922757444312">iznimno korisno</a>. Upravo zbog toga zaista nema razloga da se ne uključiš i olakšaš studiranje novoj generaciji. :)',
                                'Svi tvoji podaci od prošle godine ostali su zabilježeni (iako si bio/bila Mali Buraz). Sve što trebaš učiniti je ulogirati se jednim klikom miša na linku ispod, otvoriti svoj profil i uključiti svoju vidljivost kako bi nam dao/dala doznanja da želiš da ti se dodijeli Mali Buraz.',
                                '<a class="button" href="http://buraz.foi.rocks/mentor/login">Prijavi se</a>',
                                'Ugodan ostatak ljeta i puno sreće na nadolazećem ispitnom roku :D,<br>Igor Rinkovec.'
                            ]
                        ],
                        function ($message) use ($user) {
                            $message->from('noreply@foi.rocks', 'FOI Buraz');
                            $message->to($user->email, $user->ime);
                            $message->subject(' 🌍 Na mladima svijet ostaje!');
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

        echo "Ukupno poslano emailova: " . $sentEmailsNum . "</br> Mailovi poslani: " . $sentEmails . "</br> Mailovi nisu poslani: " . $notSentEmail;
    }
}