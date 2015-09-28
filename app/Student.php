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
        return User::where('id', $this->mentor_id)->first();
    }

    public function assignBigBro($force = false) {
        if(Config::get('app.matching') || $force) {
            // Get the best bro
            $studyId = $this->user->study_id;

            $minCount = Mentor::min('student_count');
            $bigBro = Mentor::with(['user' => function($query) use ($studyId) {
                $query->where('study_id', $studyId);
            }])
                ->where('visible', 1)
                ->where('student_count', $minCount)
                ->orderByRaw('RAND()')
                ->first();
            // Increment his little bros counter
            $bigBro->student_count++;
            $bigBro->save();

            // Assign the big bro
            $this->mentor_id = $bigBro->id;
            $this->save();

            return $bigBro;
        }
    }

    public function sendBigBroNotificationEmail($force = false) {
        if(Config::get('app.matching') || $force) {
            echo 'Test2';
            $bigBro = $this->bigBro();
            echo 'Test3';
            $account = $this->user;

            var_dump($bigBro);
            var_dump($account);

            // Send e-mail to student
            echo 'Test4';
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
                    $message->subject('🎈Dodijeljen ti je Veliki Buraz!');
                }
            );

            // Mark as sent
            echo 'Test5';
            $this->notified = true;
            $this->save();
        }
    }
}
