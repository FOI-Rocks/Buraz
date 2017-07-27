<?php


namespace App\Http\Controllers\Admin;


use App\Http\Controllers\Controller;
use App\Mentor;
use App\Student;

class StatisticsController extends Controller
{

    public function getPage()
    {
        return view('admin.statistics')
            ->with([
                'ipiStudents' =>
                    Student::join('users', 'students.user_id', '=', 'users.id')
                        ->where('users.study_id', 1)
                        ->count(),
                'epStudents' =>
                    Student::join('users', 'students.user_id', '=', 'users.id')
                        ->where('users.study_id', 2)
                        ->count(),
                'pitupStudents' =>
                    Student::join('users', 'students.user_id', '=', 'users.id')
                        ->where('users.study_id', 3)
                        ->count(),
                'ipiMentors' =>
                    Mentor::join('users', 'mentors.user_id', '=', 'users.id')
                        ->where('users.study_id', 1)
                        ->where('mentors.visible', 1)
                        ->count(),
                'epMentors' =>
                    Mentor::join('users', 'mentors.user_id', '=', 'users.id')
                        ->where('users.study_id', 2)
                        ->where('mentors.visible', 1)
                        ->count(),
                'pitupMentors' =>
                    Mentor::join('users', 'mentors.user_id', '=', 'users.id')
                        ->where('users.study_id', 3)
                        ->where('mentors.visible', 1)
                        ->count(),
            ]);
    }

}