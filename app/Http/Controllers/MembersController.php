<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class MembersController extends Controller
{
  
    public function join_us()
    {
        return view('pages.join_us');
    }
}
