<?php

namespace App\Console\Commands;

use App\Student;
use Illuminate\Console\Command;

class AssignBros extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'match:assign';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Assigns all students to a mentor.';

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
        $students = Student::where('mentor_id', null)->get();
        foreach($students as $s) {
            $s->assignBigBro(true);
        }
    }
}
