<?php

namespace App\Http\Controllers;

use App\Models\Car;
use Illuminate\Http\Request;

class CarController extends Controller
{
    public function store(Request $request)
    {
        $this->validate($request, [
            "number" => "required|numeric|min:0|max:15"
        ]);
        $data = $request->number;
        $counter = 0;
        $car = Car::query()->first();
        for ($i = 0; $i < 4; $i++) {
            $car_number = "car_" . ($i + 1);
            if ($data & (1 << $i)) {
                $counter++;
                $car->update([
                    $car_number => 1
                ]);
            } else {
                $car->update([
                    $car_number => 0
                ]);
            }
        }

        $car->update([
            "car_counter" => $counter
        ]);

        return response()->json([
            "counter" => $counter,
            "car_1" => $car->car_1,
            "car_2" => $car->car_2,
            "car_3" => $car->car_3,
            "car_4" => $car->car_4,
            "binary" => decbin($request->number)
        ]);
    }

    public function getData()
    {
        $car = Car::query()->first();
        return response()->json([
            "counter" => $car->car_counter,
            "car_1" => $car->car_1,
            "car_2" => $car->car_2,
            "car_3" => $car->car_3,
            "car_4" => $car->car_4,
        ]);
    }
}
