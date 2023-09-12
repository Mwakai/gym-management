<?php

namespace App\Http\Controllers;

use App\Models\Trainer;
use Illuminate\Http\Request;

class TrainersController extends Controller
{
    //

    public function index() {
        return view('admin.trainers');
    }

    public function addTrainer() {

    }

    public function updateTrainer() {

    }

    public function deleteTrainer(Request $request) {
        $id = $request->id;
        Trainer::where('id', $id)->delete();

        return redirect()->back()->with('success', 'Trainer deleted successfully');

    }
}
