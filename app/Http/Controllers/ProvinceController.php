<?php

namespace App\Http\Controllers;

use App\Models\Province;
use Illuminate\Http\Request;
use Yajra\DataTables\Facades\DataTables;

class ProvinceController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index()
    {
        return view('components.province.province');
    }

    public function fetchall(Request $request)
    {
        if($request->ajax())
        {
            $data = Province::latest()->get();
            return DataTables::of($data)
                    ->addIndexColumn()
                    ->addColumn('action', function($row){
                        return '<a href="/province/edit/'.$row->id.'" class="btn btn-primary btn-sm">Edit</a>&nbsp;
                        <button type="button" class="btn btn-danger btn-sm delete" data-id="'.$row->id.'">Delete</button>';
                    })
                    ->rawColumns(['action'])
                    ->make(true);
        }
    }

    function add()
    {
        return view('components.province.add_province');
    }

    public function add_validation(Request $request)
    {
        $request->validate([
            'province_name' => 'required',
            'district'      => 'required'
        ]);

        $data = $request->all();

        Province::create([
            'province_name' => $data['province_name'],
            'district'      => implode("/ ", $data['district'])
        ]);

        return redirect('province')->with('success', 'New Province Added');
    }

    public function edit($id)
    {
        $data = Province::findOrFail($id);
        return view('components.province.edit_province', compact('data'));
    }

    public function edit_validation(Request $request)
    {
        $request->validate([
            'province_name' => 'required',
            'district'      => 'required'
        ]);

        $data = $request->all();

        $form_data = array(
            'province_name' => $data['province_name'],
            'district'      => implode("/ ",$data['district'])
        );

        Province::whereId($data['hidden_id'])->update($form_data);
        return redirect('province')->with('success', 'Province Data Updated');
    }

    function delete($id)
    {
        $data = Province::findOrFail($id);
        $data->delete();
        return redirect('province')->with('success', 'Province Data Removed');
    }

}
