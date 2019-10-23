<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\CarType;

class CarTypeController extends Controller
{
  public function index()
  {
    $car_types = CarType::all();

    return response()->json([
      'success' => true,
      'message' => 'Found '.$car_types->count().' Car Types!',
      'cartypes' => $car_types,
    ]);
  }
}
