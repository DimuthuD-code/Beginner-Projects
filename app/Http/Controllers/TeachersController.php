<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Yajra\DataTables\Facades\DataTables;

class TeachersController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }
    public function index()
    {
        return view('components.teacher.teachers');
    }

    public function fetch_all(Request $request)
    {
        if($request->ajax())
        {
            $data = User::where('type', '=', 'Teacher')->get();
            return DataTables::of($data)
                    ->addIndexColumn()
                    ->addColumn('action', function($row){
                        return '<a href="/teachers/edit/'.$row->id.'" class="btn btn-primary btn-sm">Edit</a>&nbsp;
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
        return view('components.teacher.add_teachers')->with('province_list', $province_list);
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
            'name'      => 'required',
            'email'     => 'required|email|unique:users',
            'province'  => 'required',
            'district'  => 'required',
            'password'  => 'required|min:6'
        ]);

        $data = $request->all();

        User::create([
            'name'      => $data['name'],
            'email'     => $data['email'],
            'province'  => $data['province'],
            'district'  => $data['district'],
            'password'  => Hash::make($data['password']),
            'type'      => 'Teacher'
        ]);

        return redirect('teachers')->with('success', 'New Teacher Added');
    }

    public function edit($id)
    {
        $province_list = DB::table('provinces')
                        ->select('province_name')
                        ->get();
        $data = User::findOrFail($id);
        return view('components.teacher.edit_teacher', compact('data'))->with('province_list', $province_list);
    }

    function edit_validation(Request $request)
    {
        $request->validate([
            'name'      => 'required',
            'email'     => 'required|email',
            'province'  => 'required',
            'district'  => 'required'
        ]);

        $data = $request->all();

        if(!empty($data['password']))
        {
            $form_data = array(
                'name'      => $data['name'],
                'email'     => $data['email'],
                'province'  => $data['province'],
                'district'  => $data['district'],
                'password'  => Hash::make($data['password'])
            );
        }
        else
        {
            $form_data = array(
                'name'      => $data['name'],
                'email'     => $data['email'],
                'province'  => $data['province'],
                'district'  => $data['district']
            );
        }

        User::whereId($data['hidden_id'])->update($form_data);
        return redirect('teachers')->with('success', 'Teacher Data Updated');
    }

    function delete($id)
    {
        $data = User::findOrFail($id);
        $data->delete();
        return redirect('teachers')->with('success', 'Teacher Data Removed');
    }

}

