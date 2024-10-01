<?php

namespace App\Http\Controllers;

use App\Models\Contact;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class ContactController extends Controller
{
    public function index(){
        return view('contact');
    }
    public function contact(){
        $users = DB::table('users')->where('usertype', '=', '2')->get();
        return view('contact')->with('users', $users);
    }
}
