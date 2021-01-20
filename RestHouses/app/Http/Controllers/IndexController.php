<?php

namespace App\Http\Controllers;

use App\Models\House;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class IndexController extends Controller
{
    public function index() {
        //Get data from DB in here and pass it to the view
        $houses = House::with( 'type', 'location')->orderByDesc('created_at')->get();
        return view('index.index', [
            'houses' => $houses,
        'title' => 'Available Rest Houses']);
    }
}
