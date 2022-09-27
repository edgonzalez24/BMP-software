<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Events\SendPosition;


class PositionController extends Controller
{
    public function store(Request $request)
    {
        $lat = $request->input('lat');
        $long = $request->input('long');
        $location = ["lat" => $lat, "long" => $long];
        event(new SendPosition($location));

        return redirect()->back()->with('success', $location);
    }
}
