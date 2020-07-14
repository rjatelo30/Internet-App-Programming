<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Car;

class CarController extends Controller
{
    public function getForm(){
        return view('carform');
    }

    public function newCar(Request $request){

        request()->validate([
            'make' => 'required',
            'model' => 'required',
            'image' => 'nullable',
        ]);

        $car = new Car();
        $car->make = $request->make;
        $car->model = $request->model;
        $car->produced_on = $request->Produced_on;
        $car->image = $request->file('image')->store('storage');
        $car->save();

        return "Your record has been stored successsfully";
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
