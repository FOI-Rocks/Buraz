<?php


namespace App\Http\Controllers\Admin;


use App\Http\Controllers\Controller;
use App\Mentor;
use App\Student;
use App\User;

class FacesController extends Controller
{

    public function getBigBrosFacesPage()
    {
        return view('admin.faces')
            ->with([
                'ipiStudents' =>
                    Mentor::join('users', 'mentors.user_id', '=', 'users.id')
                        ->where('users.study_id', 1)
                        ->where('mentors.visible', 1)
                        ->orderBy('users.created_at', 'DESC')
                        ->get(),
                'epStudents' =>
                    Mentor::join('users', 'mentors.user_id', '=', 'users.id')
                        ->where('users.study_id', 2)
                        ->where('mentors.visible', 1)
                        ->orderBy('users.created_at', 'DESC')
                        ->get(),
                'pitupStudents' =>
                    Mentor::join('users', 'mentors.user_id', '=', 'users.id')
                        ->where('users.study_id', 3)
                        ->where('mentors.visible', 1)
                        ->orderBy('users.created_at', 'DESC')
                        ->get()
            ]);
    }

    public function getLittleBrosFacesPage()
    {
        return view('admin.faces')
            ->with([
                'epStudents' =>
                    Student::join('users', 'students.user_id', '=', 'users.id')
                        ->where('users.study_id', 2)
                        ->orderBy('users.created_at', 'DESC')
                        ->get(),
                'ipiStudents' =>
                    Student::join('users', 'students.user_id', '=', 'users.id')
                        ->where('users.study_id', 1)
                        ->orderBy('users.created_at', 'DESC')
                        ->get(),
                'pitupStudents' =>
                    Student::join('users', 'students.user_id', '=', 'users.id')
                        ->where('users.study_id', 3)
                        ->orderBy('users.created_at', 'DESC')
                        ->get()
            ]);
    }

    public function getSingleFace($userId)
    {
        return view('admin.face')
            ->with(
                'face',
                User::where('id', $userId)
                    ->first()
            );
    }

}