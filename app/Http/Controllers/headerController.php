<?php

namespace App\Http\Controllers;

use App\Http\Controllers\RecievePlanningController;
use Illuminate\Routing\Controller;
use Illuminate\Support\Facades\Auth;




 class headerController extends Controller
{
     public function about()
    {
      /*  if(Auth::id()) 
        {
            if(Auth::user()->typeUser=='1') 
            {*/
                return view('user.about');
/*
            } 
            else
            {

                $room = room::all();

                return view('user.home', compact('room'));

            }
        }
        else
        {
                            $room = room::all();

                return view('user.home', compact('room'));

        }
*/
    }

public function home()
    {
   return view('user.home');
    }

public function planning()
    {

 if (Auth::check()) {
        $user = Auth::user(); 
        $calendar_link = $user->calendar_link;
    } else {
        // default calendar link
        $calendar_link = "https://calendar.google.com/calendar/u/0/embed?src=9ecbb3026111b91a9ce21bfed88d67b95783a5a418c6d82aaa220776eb70f5d3@group.calendar.google.com&ctz=Europe/Brussels";
    }

    return view('user.planning', ['calendar_link' => $calendar_link]);

    }


public function contact()
    {
   return view('user.contact');
    }

public function events()
    {

// Activate the planning RabbitMQ consumer
    $consumer = new RecievePlanningController();
    $consumer->consume();

     $event = event::all();
   return view('user.event', compact('events'));
    }



public function registration()
    {
   return view('auth.role-register');
    }

public function show_events()
    {
   return view('user.event-create');
    }
}
