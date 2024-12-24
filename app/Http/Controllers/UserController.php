<?php

namespace App\Http\Controllers;
use App\Models\User;

use Illuminate\Http\Request;

class UserController extends Controller
{
  public function get() {
    $users=User::where('status','!=','Admin')->orderBy('id','desc')->get();
    return response()->json($users, 200);
  }
}
