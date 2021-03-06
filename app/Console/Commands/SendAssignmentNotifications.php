<?php

namespace App\Console\Commands;

use App\Mentor;
use App\Student;
use Illuminate\Console\Command;

class SendAssignmentNotifications extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'match:notify';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Sends all students mentor info emails.';

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
        $students = Student::where('notified', false)->get();
        foreach($students as $s) {
            if($s->mentor_id !== null) {
		if($s->user_id != 265) $s->sendBigBroNotificationEmail(true);
                $s->bigBro()->mentor->sendLittleBroNotificationEmail($s, true);
            }
        }

    }
}
