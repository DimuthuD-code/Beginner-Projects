<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class DashboardController extends Controller
{
    function index()
    {
        if(Auth::check())
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
            
            $subject_set = DB::table('courses')
                        ->select('subject')
                        ->get();
    
            $subjects = array();
            foreach($subject_set as $subject)
            {
                $subject_list = explode("/ ", $subject->subject);
                foreach($subject_list as $subject)
                {
                    $subjects[] = $subject;
                }
            }
            $subject_count = count($subjects);
    
    
            $provinces = DB::table('provinces')
                        ->get();
            $province_count = count($provinces);
    
    
            $district_set = DB::table('provinces')
                            ->select('district')
                            ->get();
    
            $districts = array();
            foreach($district_set as $district)
            {
                $district_list = explode("/ ", $district->district);
                foreach($district_list as $district)
                {
                    $districts[] = $district;
                }
            }
            $district_count = count($districts);
    
    
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
                    ->with('subject_count', $subject_count)
                    ->with('district_count', $district_count)
                    ->with('province_count', $province_count);
        }

        return redirect('login');
        
    }
}
