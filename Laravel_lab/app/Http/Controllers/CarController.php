<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use App\Car;
use Exception;

class CarController extends Controller
{
    public function getForm(){
        return view('carform');
    }

    public function newCar(Request $request){

        $request->validate([
            'make' => 'required|unique:cars,make|max:255',
            'model' => 'required|unique:cars,model|max:255',
            'produced_on' => 'required|date',
            'image' => 'required|unique:cars,image|mimes:jpg,png,jpeg,gif,svg,JPG|max:2048'

        ]);

            $car = new Car();
            $car->make = $request->make;
            $car->model = $request->model;
            $car->produced_on = $request->Produced_on;
            $car->image = $request->file('image')->store('/', 'public');
            $car->save();

            return redirect()
            ->back()
            ->with('success', 'Car data was uploaded successfully');


    }

    public function readCars(){
        $car = Car::all();
        return view('cars', ['car' => $car]);
    }

    public function particularCar($id){
        $car = Car::find($id);
        return view('cars', ['car' => $car]);
    }


}
