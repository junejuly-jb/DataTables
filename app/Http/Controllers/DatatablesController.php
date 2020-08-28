<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Yajra\Datatables\Datatables;
use App\Student;
use RealRashid\SweetAlert\Facades\Alert;
use Haruncpi\LaravelIdGenerator\IdGenerator;


class DatatablesController extends Controller
{
    function generateID(){
        
    }

    public function index(){
        // if(session('success_message')){
        //     toast(session('success_message'),'success')->position('top')->width('450px');
        // }
        return view('students.main')->with('home');
    }

    public function getUsers(){
        $data = Student::all();
        return Datatables::of($data)
        ->addColumn('action', function($row){
            // $btn = '<a href="javascript:void(0)" class="edit btn btn-info btn-sm">View</a> ';
            $btn = '<a href="javascript:void(0)" data-id="'.$row->id.'" class="editbtn btn btn-primary btn-sm">Edit</a> ';
            $btn = $btn.'<a href="javascript:void(0)" data-id="'.$row->id.'" class="deletebtn btn btn-danger btn-sm">Delete</a>';

            return $btn;
        })
        ->make(true);
    }

    public function edit($id){
        $data = Student::find($id);
        return response()->json($data);
    }

    public function store(Request $request){

            if($request->ajax()){
                $config = [
                    'table' => 'students',
                    'prefix' => 'STDNT',
                    'length' => 8
                ];
                
                $id = IdGenerator::generate($config);
                $student = new Student([
                    'id' => $id,
                    'fname' => $request->get('fname'),
                    'lname' => $request->get('lname')
                ]);
                $student->save();
                return response()->json([
                    'success' => 'Student added!'
                ]);
            }
            else{
                return view('home');
            }

    }

    public function delete($id){
       
        Student::find($id)->delete();
        return response()->json([
            'success' => 'Data deleted!'
        ]);
        
    }

    public function update(Request $request, $id){

        if($request->ajax()){
            $student = Student::find($id);

            $student->id = $student->id;
            $student->fname = $request->fname;
            $student->lname = $request->lname;
    
            $student->save();
    
            return response()->json([
                'id' => $student,
                'success' => 'Data updated!'
            ]);
        }
    }
}
