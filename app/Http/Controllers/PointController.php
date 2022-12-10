<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Point;

class PointController extends Controller
{

  public function index()
  {

    $points = Point::all();

    return view('index', compact('points'));
  }

}
