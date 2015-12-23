<?php

namespace App\Console\Commands;

use App\Mentor;
use App\Student;
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

        $this->info("=== Sending e-mail to mentors:");
        // Mentor feedback
        $mentors = Mentor::where('student_count', '>', 0)->get();
        foreach($mentors as $m) {
            $user = $m->user;
            Mail::send('email.masterbutton',
                [
                    'header' => 'Pomozi sljedećoj generaciji brucoša!',
                    'paragraphs' => [
                        'Pozdrav ' . explode(' ', $user->name)[0] . ',<br>' .
                        'semestar nam se bliži kraju, brucoši su se već privikli na studentski život pa to nekako i privodi ovaj cijeli projekt kraju ovoakademskogodišnje sezone. Ovo je prva godina izvođenja Buraz projekta, što upravo tebe čini pokusnim kunićem. S odazivom od 250+ ljudi očito je da postoji interes za ovakvim projektom s strane brucoša, ali i još veći s strane mentora što mi je iznimno drago. Upravo zbog toga bitan mi je tvoj feedback (ipak je poanta pokusnih kunića da iz njih izvučeš neke zaključke) kako bi druge godine mogli ovaj projekt učiniti još popularnijim i kvalitetnijim.',
                        'Napravio sam ovu anketu upravo za tebe kako bi mi mogao/la prosljediti te ključne informacije za daljnji razvoj projekta. Neće ti trebati dulje od 2 minute, samo stisni na gumbić ispod i pomozi sljedećoj generaciji brucoša.',
                        '<a class="button" href="http://buraz.foi.rocks/anketa/veliki-buraz">Riješi anketu</a>',
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
    }
}
