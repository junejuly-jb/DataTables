<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Yajra\Datatables\Datatables;
use App\Student;

class DatatablesController extends Controller
{
    public function index(){
        return view('students.main')->with('home');
    }

    public function getUsers(){
        return Datatables::of(Student::query())->make(true);
    }
}
