<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Event;

class WelcomeController extends Controller
{
    public function __invoke()
    {
        $events = Event::with('country', 'tags')->where('start_date', '>=', today())->orderBy('created_at', 'desc')->get();
        $events = Event::with('country', 'tags')->orderBy('created_at', 'desc')->get();

        return view('welcome', compact('events'));
    }
}
