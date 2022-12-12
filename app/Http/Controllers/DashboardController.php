<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class DashboardController extends Controller
{
    function index()
    {
        $teachers = DB::table('users')
                    ->where('type', '=', 'Teacher')
                    ->get();
        $teacher_count = count($teachers);
        
        $students = DB::table('users')
                    ->where('type', '=', 'Student')
                    ->get();
        $student_count = count($students);

        $courses = DB::table('courses')
                    ->get();
        $course_count = count($courses);
        
        $subjects = DB::table('courses')
                    ->select('subject')
                    ->get();
        $subject_list = explode("/ ",$subjects);
        dd($subjects);
        $subject_count = count($subject_list);


        $provinces = DB::table('provinces')
                    ->get();
        $province_count = count($provinces);



        $data = DB::table('users')
                ->where('type', '=', 'Teacher')
                ->select(
                    DB::raw('province as province'),
                    DB::raw('count(*) as number'))
                ->groupBy('province')
                ->get();
        $teacherarray[] = ['TeacherProvince', 'Number'];
        foreach($data as $key => $value)
        {
            $teacherarray[++$key] = [$value->province, $value->number];
        }

        $data = DB::table('users')
                ->where('type', '=', 'Student')
                ->select(
                    DB::raw('province as province'),
                    DB::raw('count(*) as number'))
                ->groupBy('province')
                ->get();
        $studentarray[] = ['StudentProvince', 'Number'];
        foreach($data as $key => $value)
        {
            $studentarray[++$key] = [$value->province, $value->number];
        }
        return view('components.dashboard.dash')
                ->with('teacherprovince', json_encode($teacherarray))
                ->with('studentprovince', json_encode($studentarray))
                ->with('teacher_count', $teacher_count)
                ->with('student_count', $student_count)
                ->with('course_count', $course_count)
                ->with('province_count', $province_count);
    }
}
