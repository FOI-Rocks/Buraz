<?php

namespace App\Console\Commands;

use App\Mentor;
use App\Student;
use App\User;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\Mail;

class SendEmail extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'email:send';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Sends all users an email.';

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Execute the console command.
     *
     * @return mixed
     */
    public function handle()
    {
        /*
        $this->info("=== Sending e-mail to students:");
        // Student feedback
        $students = Student::where('mentor_id', '<>', false)->get();
        foreach($students as $s) {
            $user = $s->user;
            Mail::send('email.masterbutton',
                [
                    'header' => 'Pomozi sljedećoj generaciji brucoša!',
                    'paragraphs' => [
                        'Pozdrav ' . explode(' ', $user->name)[0] . ',<br>' .
                        'semestar nam se bliži kraju, već ste se privikli na studentski život pa to nekako i privodi ovaj cijeli projekt kraju ovoakademskogodišnje sezone. Ovo je prva godina izvođenja Buraz projekta, što upravo tebe čini pokusnim kunićem. S odazivom od 250+ ljudi očito je da postoji interes za ovakvim projektom s strane brucoša, ali i s strane mentora. Upravo zbog toga bitan mi je tvoj feedback (ipak je poanta pokusnih kunića da iz njih izvučeš neke zaključke) kako bi druge godine mogli ovaj projekt učiniti još popularnijim i kvalitetnijim.',
                        'Napravio sam ovu anketu upravo za tebe kako bi mi mogao/la prosljediti te ključne informacije za daljnji razvoj projekta. Neće ti trebati dulje od 2 minute, samo stisni na gumbić ispod i pomozi sljedećoj generaciji brucoša.',
                        '<a class="button" href="http://buraz.foi.rocks/anketa/mali-buraz">Riješi anketu</a>',
                        'Ugodni blagdani i sretna ti cijela nova godina,<br>Igor Rinkovec.'
                    ]
                ],
                function ($message) use($user) {
                    $message->from('noreply@foi.rocks', 'FOI Buraz');
                    $message->to($user->email, $user->ime);
                    $message->subject('👥Ej buraz, kak\' ti je buraz!');
                }
            );
            $this->info($user->name . " => SENT");
        }
        */

        $this->info("=== Sending e-mail to mentors:");
        // Mentor feedback
        $mentors = Mentor::all();
        foreach($mentors as $m) {
            $user = $m->user;
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
                function ($message) use($user) {
                    $message->from('noreply@foi.rocks', 'FOI Buraz');
                    $message->to($user->email, $user->ime);
                    $message->subject(' 🌍 Na mladima svijet ostaje!');
                }
            );
            $this->info($user->name . " => SENT");
        }
    }
}
