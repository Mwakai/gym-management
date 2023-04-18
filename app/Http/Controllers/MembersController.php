<?php

namespace App\Http\Controllers;

use App\Models\Member;
use Illuminate\Http\Request;
use Safaricom\Mpesa\Mpesa;
use Safaricom\Mpesa\Facade\Mpesa as FacadeMpesa;

class MembersController extends Controller
{
  

    public function index() {

        return view('admin.members');
    }



    public function join_us()
    {
        return view('pages.join_us');
    }

    //ADD MEMBER
    public function addMember(Request $request) {

        $request->validate([
            'name' => 'required',
            'email' => 'required',
            'phone' => 'required',

        ]);

        Member::create([
            'name' => $request->name,
            'email' => $request->email,
            'phone' => $request->phone,
        ]);

        return redirect()->back()->with('success', 'Member Added Successfully');

    }
}
