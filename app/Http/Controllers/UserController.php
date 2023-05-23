<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class UserController extends Controller
{
    public function index(){
        return view('crud.index');
    }

    public function add(){
        return view('crud.add');
    }

    public function edit(){
        return view('crud.edit');
    }
}
