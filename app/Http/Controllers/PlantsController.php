<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;
use App\Plant;

class PlantsController extends Controller
{
    public function index()
    {
        $plants = Plant::get();
        return view('plants.index')->with('plants', $plants);
    }

    public function getNewPlant()
    {
        return view('plants.new');
    }

    public function postNewPlant(Request $request)
    {
        $this->validate($request, [
            'name' => 'required',
            'description' => 'required',
            'image' => 'required|image',
        ]);

        $path = 'img/plants';
        $name = uniqid() .'.'. $request->file('image')->guessClientExtension();
        $image = $path .'/'. $name;

        $request->file('image')->move($path, $name);

        Plant::create([
            'name' => $request->input('name'),
            'description' => $request->input('description'),
            'image' => $image,
        ]);

        notify()->flash('Biljka uspješno dodana', 'success', [
            'timer' => 2000,
            'noConfirm' => true,
        ]);
        return redirect()->route('plants.index');
    }

    public function getEditPlant(Plant $plant)
    {
        return view('plants.edit')->with('plant', $plant);
    }

    public function postEditPlant(Request $request, Plant $plant)
    {
        $this->validate($request, [
            'name' => 'required',
            'description' => 'required',
            'image' => 'image',
        ]);

        if($request->hasFile('image')){
            if(file_exists(public_path($plant->image))) unlink(public_path($plant->image));
            $path = 'img/plants';
            $name = uniqid() .'.'. $request->file('image')->guessClientExtension();
            $image = $path .'/'. $name;
            $request->file('image')->move($path, $name);
        } else {
            $image = $plant->image;
        }

        $plant->update([
            'name' => $request->input('name'),
            'description' => $request->input('description'),
            'image' => $image,
        ]);

        notify()->flash('Biljka uspješno uređena', 'success', [
            'timer' => 2000,
            'noConfirm' => true,
        ]);
        return redirect()->route('plants.index');
    }

    public function getDeletePlant(Plant $plant)
    {
        if(file_exists(public_path($plant->image))) unlink(public_path($plant->image));
        $plant->delete();

        notify()->flash('Biljka uspješno obrisana', 'success', [
            'timer' => 2000,
            'noConfirm' => true,
        ]);
        return redirect()->route('plants.index');
    }
}
