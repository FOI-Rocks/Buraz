<?php


namespace App\Http\Controllers\Admin;


use App\Http\Controllers\Controller;
use App\Mentor;
use App\Student;

class StatisticsController extends Controller
{

    public function getPage()
    {
        $ipiStudents = Student::join('users', 'students.user_id', '=', 'users.id')
            ->where('users.study_id', 1)
            ->count();
        $ipiMentors = Mentor::join('users', 'mentors.user_id', '=', 'users.id')
            ->where('users.study_id', 1)
            ->where('mentors.visible', 1)
            ->count();
        if($ipiMentors == 0){
            $ipiStats = "-";
        } else {
            $ipiStats = round($ipiStudents / $ipiMentors * 100);
        }

        $epStudents = Student::join('users', 'students.user_id', '=', 'users.id')
                ->where('users.study_id', 2)
                ->count();

        $epMentors = Mentor::join('users', 'mentors.user_id', '=', 'users.id')
                ->where('users.study_id', 2)
                ->where('mentors.visible', 1)
                ->count();
        if($epMentors == 0){
            $epStats = "-";
        } else {
            $epStats = round($epStudents / $epMentors * 100);
        }

        $pitupStudents = Student::join('users', 'students.user_id', '=', 'users.id')
                ->where('users.study_id', 3)
                ->count();
        $pitupMentors = 0;Mentor::join('users', 'mentors.user_id', '=', 'users.id')
            ->where('users.study_id', 3)
            ->where('mentors.visible', 1)
            ->count();
        if($pitupMentors == 0){
            $pitupStats = "-";
        } else {
            $pitupStats = round($pitupStudents / $pitupMentors * 100);
        }

        return view('admin.statistics')
            ->with([
                'ipiStudents' => $ipiStudents,
                'epStudents' => $epStudents,
                'pitupStudents' => $pitupStudents,
                'ipiMentors' => $ipiMentors,
                'epMentors' => $epMentors,
                'pitupMentors' => $pitupMentors,
                'ipiStats' => $ipiStats,
                'epStats' => $epStats,
                'pitupStats' => $pitupStats,
            ]);
    }

}