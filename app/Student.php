<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Config;
use Illuminate\Support\Facades\Mail;

class Student extends Model
{
    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'students';

    /**
     * The attributes that are not mass assignable.
     *
     * @var array
     */
    protected $guarded = [];

    /**
     * The attributes excluded from the model's JSON form.
     *
     * @var array
     */
    protected $hidden = [];

    // Relationships
    public function user() {
        return $this->belongsTo('App\User');
    }

    // Matching
    public function bigBro() {
        $mentor = Mentor::where('id', $this->mentor_id)->first();
        if($mentor != null) {
            return User::where('id', $mentor->user_id)->first();
        }
        return null;
    }

    public function assignBigBro($force = false) {
        if($this->user->study_id != 0) {
            if(Config::get('app.matching') || $force) {
                // Get the best bro
                $studyId = $this->user->study_id;
                $minCount = Mentor::whereHas('user', function($query) use ($studyId) {
                    $query->where('study_id', $studyId);
                })
                    ->min('student_count');

                $mentor = User::whereHas('mentor', function($query) use ($minCount) {
                    $query->where('visible', true)
                        ->whereNotNull('phone')
                        ->where('student_count', $minCount);
                })
                    ->whereNotNull('email')
                    ->where('study_id', $studyId)
                    ->orderByRaw('RAND()')
                    ->with('mentor')
                    ->first();

                if($mentor == null)
                    return null;

                // Increment his little bros counter
                $mentorMentor = $mentor->mentor;
                $mentorMentor->student_count++;
                $mentorMentor->save();

                // Assign the big bro
                $this->mentor_id = $mentorMentor->id;
                $this->save();

                return $mentor;
            }
        }
        return null;
    }

    public function sendBigBroNotificationEmail($force = false) {
        if(Config::get('app.matching') || $force) {
            $bigBro = $this->bigBro();
            $account = $this->user;

            // Send e-mail to student
            Mail::send(
                'email.master',
                [
                    'header' => 'Dodjeljen ti je Veliki Buraz!',
                    'paragraphs' => [
                        'Nasumičnim odabirom ti je dodjeljen Veliki Buraz. Ispod možeš pronaći njegove/njezine kontakt podatke. Ukoliko imaš bilo kakvih pitanja ili ćeš ih imati kroz godinu, svog Velikog Buraza uvijek možeš pitati. :) Ako ti trenutno ništa ne pada na pamet, slobodno ga/ju pozdravi!',
                        'Ime: ' . $bigBro->name,
                        'E-mail: ' . $bigBro->email,
                        'Telefon: ' . $bigBro->mentor->phone,
                    ]
                ],
                function ($message) use ($account) {
                    $message->from('noreply@foi.rocks', 'FOI Buraz');
                    $message->to($account->email, $account->name);
                    $message->subject('👥git pDodijeljen ti je Veliki Buraz!');
                }
            );

            // Mark as sent
            $this->notified = true;
            $this->save();
        }
    }
}
