<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Mentor extends Model
{
    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'mentors';

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

    static public $validation = [
        'phone' => 'required',
        'visibility' => 'in:0,1',
    ];

    // Relationships
    public function user() {
        return $this->belongsTo('App\User');
    }

    public function littleBros() {
        return Student::where('mentor_id', $this->id)->get();
    }

    public function sendLittleBroNotificationEmail($student, $force = false) {
        if(Config::get('app.matching') || $force) {
            if ($student != null) {
                $studentUser = $student->user;
                $account = $this->user;

                // Send e-mail to student
                Mail::send('email.master', [
                    'header' => 'Dodijeljen ti je Mali Buraz!',
                    'paragraphs' => [
                        'Nasumičnim odabirom ti je dodjeljen Mali Buraz. Ispod možeš pronaći njegove/njezine kontakt podatke. Prošle godine čak trećina Malih Buraza nije kontaktiralo svog mentora. Bilo bi odlično kada bi mu/joj se predstavio/la i upitao ga/ju ima li već sad kakvih pitanja kako mu/joj ne bi bilo neugodno!',
                        'Ime: ' . $studentUser->name,
                        'E-mail: ' . $studentUser->email,
                        '< href="https://www.facebook.com/' . $studentUser->fbid . '">Facebook Profil</a>'
                    ]
                ], function ($message) use ($account) {
                    $message->from('noreply@foi.rocks', 'FOI Buraz');
                    $message->to($account->email, $account->name);
                    $message->subject('?Dodjeljen ti je Mali Buraz!');
                });

                $this->save();
            }
        }
    }
}
