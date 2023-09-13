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

    public function addTrainer(Request $request) {
        $request->validate([
            'name' => 'required'|'string'|'min:3'|'max:255',
            'email' => 'required'|'string'|'email',
            'phone' => 'required'|'string'|'min:10'|'max:10',
            'image' => 'required'|'image'|'mimes:jpeg,png,jpg,gif,svg',
        ]);

        $image=time().'.'.$request->image->extension();
        $request->image->move(public_path('images'), $image);

        Trainer::create([
            'name' => $request->name,
            'email' => $request->email,
            'phone' => $request->phone,
            'image' => $image
        ]);

        return redirect()->back()->with('success', 'Trainer added successfully');

    }

    public function updateTrainer(Request $request) {
        $request->validate([
            'name' => 'required',
            'email' => 'required',
            'phone' => 'required',
            'image' => 'required',
        ]);
        $id = $request->id;

        if(!empty($request->image)) {
            $request->validate([
                'image' => 'required'|'image'|'mimes:jpeg,png,jpg,gif,svg',
            ]);
            $imageName = time().'.'.$request->image->extension();
            $request->image->move(public_path('images'), $imageName);

            Trainer::where('id', $id)->update([
                'name' => $request->name,
                'email' => $request->email,
                'phone' => $request->phone,
                'image' => $imageName
            ]);
            return redirect()->back()->with('success', 'Trainer updated successfully');
        }else {
            Trainer::where('id', $id)->update([
                'name' => $request->name,
                'email' => $request->email,
                'phone' => $request->phone
            ]);
            return redirect()->back()->with('success', 'Trainer updated successfully');
        }

    }

    public function deleteTrainer(Request $request) {
        $id = $request->id;
        Trainer::where('id', $id)->delete();

        return redirect()->back()->with('success', 'Trainer deleted successfully');

    }
}
