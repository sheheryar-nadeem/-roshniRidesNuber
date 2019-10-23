<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Status;

class StatusController extends Controller
{
  public function index()
  {
    $statuses = Status::where('id','!=', 3)->get();

    return response()->json([
      'success' => true,
      'message' => 'Found '.$statuses->count().' Statuses!',
      'statuses' => $statuses,
    ]);
  }
}
