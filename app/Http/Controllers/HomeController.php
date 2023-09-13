<?php

namespace App\Http\Controllers;

use App\Models\Member;
use App\Models\Trainer;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        $query = Member::all();
        $total = count($query);
        $totalPayment = Member::sum('payment');

        $members = Member::latest()->paginate(5);

        $query = Trainer::all();
        $trainer = count($query);

        return view('home', compact('members', 'total', 'totalPayment', 'trainer'))->with('i', (request()->input('page', 1) - 1) * 5);
    }

    public function join_us()
    {
        return view('pages.join_us');
    }
}
