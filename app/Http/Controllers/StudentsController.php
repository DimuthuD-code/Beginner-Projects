<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Yajra\DataTables\Facades\DataTables;

class StudentsController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }
    public function index()
    {
        return view('components.student.students');
    }

    public function fetch_all(Request $request)
    {
        if($request->ajax())
        {
            if(Auth::user()->type == 'Admin')
            {
                $data = User::where('type', '=', 'Student')->get();
            }
            if(Auth::user()->type == 'Teacher')
            {
                $data = User::where('type', '=', 'Student')->where('teacher_name', '=', Auth::user()->name)->get();
            }
            return DataTables::of($data)
                    ->addIndexColumn()
                    ->addColumn('action', function($row){
                        return '<a href="/students/edit/'.$row->id.'" class="btn btn-primary btn-sm">Edit</a>&nbsp;
                        <button type="button" class="btn btn-danger btn-sm delete" data-id="'.$row->id.'">Delete</button>';
                    })
                    ->rawColumns(['action'])
                    ->make(true);
        }
    }

    function add()
    {
        $province_list = DB::table('provinces')
                        ->select('province_name')
                        ->get();
        $teacher_list = DB::table('users')
                        ->select('name')
                        ->where('type', '=', 'Teacher')
                        ->get();
        return view('components.student.add_students')->with('province_list', $province_list)->with('teacher_list', $teacher_list);
    }

    function getdistrict(Request $request)
    {
        $value  = $request->get('value');
        $data   = DB::table('provinces')
                ->select('district')
                ->where('province_name', $value)
                ->get();
        
        $output = '<option value="">Select District</option>';
        foreach($data as $row)
        {
            $district_list = explode("/ ", $row->district);
            foreach($district_list as $district)
            {
                $output .= '<option value="'.$district.'">'.$district.'</option>';
            }
        }
        echo $output;
    }   

    function add_validation(Request $request)
    {
        $request->validate([
            'name'          => 'required',
            'email'         => 'required|email|unique:users',
            'teacher_name'  => 'required',
            'province'      => 'required',
            'district'      => 'required',
            'password'      => 'required|min:6'
        ]);

        $data = $request->all();

        User::create([
            'name'          => $data['name'],
            'email'         => $data['email'],
            'teacher_name'  => $data['teacher_name'],
            'province'      => $data['province'],
            'district'      => $data['district'],
            'password'      => Hash::make($data['password']),
            'type'          => 'Student'
        ]);

        return redirect('students')->with('success', 'New Student Added');
    }

    public function edit($id)
    {
        $province_list = DB::table('provinces')
                        ->select('province_name')
                        ->get();
        $teacher_list = DB::table('users')
                        ->select('name')
                        ->where('type', '=', 'Teacher')
                        ->get();
        $data = User::findOrFail($id);
        return view('components.student.edit_student', compact('data'))->with('province_list', $province_list)->with('teacher_list', $teacher_list);
    }

    function edit_validation(Request $request)
    {
        $request->validate([
            'name'          => 'required',
            'email'         => 'required|email',
            'teacher_name'  => 'required',
            'province'      => 'required',
            'district'      => 'required'
        ]);

        $data = $request->all();

        if(!empty($data['password']))
        {
            $form_data = array(
                'name'          => $data['name'],
                'email'         => $data['email'],
                'teacher_name'  => $data['teacher_name'],
                'province'      => $data['province'],
                'district'      => $data['district'],
                'password'      => Hash::make($data['password'])
            );
        }
        else
        {
            $form_data = array(
                'name'          => $data['name'],
                'email'         => $data['email'],
                'teacher_name'  => $data['teacher_name'],
                'province'      => $data['province'],
                'district'      => $data['district']
            );
        }

        User::whereId($data['hidden_id'])->update($form_data);
        return redirect('students')->with('success', 'Student Data Updated');
    }

    function delete($id)
    {
        $data = User::findOrFail($id);
        $data->delete();
        return redirect('students')->with('success', 'Student Data Removed');
    }

}

