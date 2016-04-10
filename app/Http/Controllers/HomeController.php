<?php

namespace App\Http\Controllers;

use App\Article;
use App\Event;
use App\Hub;
use Illuminate\Http\Request;

use App\Http\Requests;
use Illuminate\View\View;

class HomeController extends Controller
{
  public function show()
  {
    $articles = Article::all()->take(5);
    $events = Event::all()->take(5);
    $hubs = Hub::all()->take(5);

    return view('pages.home', ['articles' => $articles, 'events' => $events, 'hubs' => $hubs]);
  }
}
