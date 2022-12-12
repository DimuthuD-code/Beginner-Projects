<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Yajra\DataTables\Facades\DataTables;

class SelectCourseController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index()
    {
        return view('components.select_course.select_course');
    }

    public function fetch_all(Request $request)
    {
        if($request->ajax())
        {
            $data   = User::where('type', '=', 'Student')
                            ->where('name', '=', Auth::user()->name)
                            ->get();
            return DataTables::of($data)
                            ->addIndexColumn()
                            ->addColumn('action', function($row){
                                return '<a href="/select_course/view/'.$row->id.'" class="btn btn-info btn-sm">View</a>&nbsp;
                                <a href="/select_course/edit/'.$row->id.'" class="btn btn-primary btn-sm">Edit</a>&nbsp';
                            })
                            ->rawColumns(['action'])
                            ->make(true);
        }
    }

    public function add()
    {
        $course_list = DB::table('courses')
                        ->select('course_name')
                        ->get();
        return view('components.select_course.add_select_course')->with('course_list', $course_list);
    }

    function getsubject(Request $request)
    {
        $value  = $request->get('value');
        $selectsubject1 = $request->get('selectsubject1');
        $selectsubject2 = $request->get('selectsubject2');
        $data   = DB::table('courses')
                ->select('subject')
                ->where('course_name', $value)
                ->get();
        
        $output = '<option value="">Select Subject</option>';
        foreach($data as $row)
        {
            $subject_list = explode("/ ", $row->subject);
            foreach($subject_list as $subject)
            {
                if($subject != $selectsubject1 && $subject != $selectsubject2)
                {
                    $output .= '<option value="'.$subject.'">'.$subject.'</option>';
                }
            }
        }
        echo $output;
    } 

    public function add_validation(Request $request)
    {
        $request->validate([
            'course'    => 'required',
            'subject'   => 'required'
        ]);

        $data = $request->all();

        User::whereId(Auth::user()->id)->update([
            'course'    => $data['course'],
            'subjects'  => implode("/ ",$data['subject'])
        ]);

        return redirect('select_course')->with('success', 'Course Selected');
    }

    public function edit($id)
    {
        $course_list = DB::table('courses')
                        ->select('course_name')
                        ->get();
        $data = User::findOrFail($id);
        return view('components.select_course.edit_select_course', compact('data'))->with('course_list', $course_list);
    }

    public function edit_validation(Request $request)
    {
        $request->validate([
            'course'    => 'required',
            'subject'   => 'required'
        ]);

        $data = $request->all();

        User::whereId(Auth::user()->id)->update([
            'course'    => $data['course'],
            'subjects'  => implode("/ ",$data['subject'])
        ]);

        return redirect('select_course')->with('success', 'Course Updated');
    }
}
