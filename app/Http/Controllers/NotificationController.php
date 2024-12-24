<?php

namespace App\Http\Controllers;
use App\Models\notification;
use Illuminate\Http\Request;

class NotificationController extends Controller
{
  public function show(){
    $note=notification::get();
    return response()->json($note, 200);
  }
}
