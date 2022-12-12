<?php

namespace App\Http\Controllers;

use App\Models\Course;
use Illuminate\Http\Request;
use Yajra\DataTables\Facades\DataTables;

class CourseController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index()
    {
        return view('components.course.course');
    }

    public function fetch_all(Request $request)
    {
        if($request->ajax())
        {
            $data = Course::latest()->get();
            return DataTables::of($data)
                    ->addIndexColumn()
                    ->addColumn('action', function($row){
                        return '<a href="/course/edit/'.$row->id.'" class="btn btn-primary btn-sm">Edit</a>&nbsp;
                                <button type="button" class="btn btn-danger btn-sm delete" data-id="'.$row->id.'">Delete</button>';
                    })
                    ->rawColumns(['action'])
                    ->make(true);
        }
    }

    function add()
    {
        return view('components.course.add_course');
    }

    public function add_validation(Request $request)
    {
        $request->validate([
            'course_name'   => 'required',
            'subject'       => 'required'
        ]);

        $data = $request->all();

        $form_data = array(
            'course_name'   => $data['course_name'],
            'subject'       => implode("/ ",$data['subject'])
        );

        $query = Course::create($form_data);

        return redirect('course')->with('success', 'New Course Added');
    }

    public function edit($id)
    {
        $data = Course::findOrFail($id);
        return view('components.course.edit_course', compact('data'));
    }
    
    public function edit_validation(Request $request)
    {
        $request->validate([
            'course_name'   => 'required',
            'subject'       => 'required'
        ]);

        $data = $request->all();

        $form_data = array(
            'course_name'   => $data['course_name'],
            'subject'       => implode("/ ",$data['subject'])
        );

        Course::whereId($data['hidden_id'])->update($form_data);

        return redirect('course')->with('success', 'Course Data Updated');
    }

    function delete($id)
    {
        $data = Course::findOrFail($id);
        $data->delete();
        return redirect('course')->with('success', 'Course Data Removed');
    }
}
