<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class MembersController extends Controller
{
    //
    public function addMembers()
    {
        return view('members.index');
    }
}
