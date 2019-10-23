<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Input;
use Illuminate\Http\Request;
use App\Booking;

use Validator;

class BookingController extends Controller
{

  public function index()
  {
    $bookings = Booking::select(
      'bookings.*',
      'car_types.type',
      'statuses.status',
      )
      ->join('car_types', 'car_types.id', '=', 'bookings.cartypeId')
      ->join('statuses', 'statuses.id', '=', 'bookings.statusId')
      ->get();

    return response()->json([
      'success' => true,
      'message' => 'Found '.$bookings->count().' Bookings!',
      'bookingLists' => $bookings,
    ]);
  }

  public function store(Request $request)
  {
    $validator =  Validator::make($request->all(), [
      'name' => 'required|max:100',
      'email' => 'required|email|max:100',
      'address' => 'required|max:100',
      'cartypeId' => 'required|exists:car_types,id'
    ]);

    if ($validator->fails()) {
      return response()->json([
        'success' => false,
        'message' => $validator->errors()->first(),
        'booking' => (object)[]
      ]);
    }

    $bookingReference = md5(uniqid($request->input('name'), true));

    $booking = new Booking();
    $booking->name = $request->input('name');
    $booking->email = $request->input('email');
    $booking->address = $request->input('address');
    $booking->cartypeId = $request->input('cartypeId');
    $booking->statusId = 1;
    $booking->bookingReference = $bookingReference;
    $booking->save();

    return response()->json([
      'success' => true,
      'message' => 'Booking Successfull!',
      'booking' => $booking,
      'bookingReference' => $bookingReference
    ]);
  }

  public function edit($bookingReference)
  {
    $booking = Booking::where('bookingReference', $bookingReference)->first();

    if($booking == null)
    {
      return response()->json([
        'success' => false,
        'message' => 'Booking not found.',
        'booking' => (object)[],
      ]);
    }

    return response()->json([
      'success' => true,
      'booking' => $booking
    ]);
  }

  public function update(Request $request, $bookingReference)
  {
    $validator = Validator::make($request->all(), [
      'statusId' => 'required|exists:statuses,id'
    ]);

    if ($validator->fails()) {
      return response()->json([
        'success' => false,
        'message' => $validator->errors()->first(),
        'booking' => (object)[]
      ]);
    }

    $booking = Booking::where('bookingReference', $bookingReference)->first();

    if($booking == null)
    {
      return response()->json([
        'success' => false,
        'message' => 'Booking not found.',
        'booking' => (object)[],
      ]);
    }
    
    $booking->statusId = $request->input('statusId');
    $booking->save();

    return response()->json([
      'success' => true,
      'message' => 'You got updated!',
      'booking' => $booking
    ]);
  }

}
