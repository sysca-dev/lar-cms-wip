<?php

namespace App\Http\Controllers;

use App\Hub;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Http\Request;
use App\Event;
use App\Http\Requests;
use Illuminate\Support\Facades\Redirect;

class EventController extends Controller
{
  use SoftDeletes;

  public function index(){
    $events = Event::all();

    return view('event.index', ['events' => $events]);
  }

  public function show(Event $event){
    return view('event.show', ['event' => $event]);
  }

  public function create(){
    $hubs = Hub::all();
    return view('event.create', ['hubs' => $hubs]);
  }

  public function edit(Event $event){
    $hubs = Hub::all();
    return view('event.edit', ['event' => $event, 'hubs' => $hubs]);
  }

  public function store(Request $request){
    $this->validate($request, [
      'title' => 'required|max:255|min:5',
      'start_time' => 'required|date',
      'length' => 'numeric',
      'description' => 'min:5',
      'twitch_url' => 'url',
      'hub_id' => 'integer',
      'image' => 'required|image'
    ]);

    $title = $request->input('title');
    $start = $request->input('start_time').':00';
    $length = $request->input('length');
    $description = $request->input('description');
    $twitch_url = $request->input('twitch_url');
    $hub = $request->input('hub');
    $fileName = time().rand(10000,99999).'.'.$request->file('image')->getClientOriginalExtension();
    if(!$request->file('image')->move(public_path().'/images/', $fileName)){
      return Redirect::back()->withErrors(['msg', 'Unable to Upload File']);
    }
    $request->user()->events()->create([
      'title' => $title,
      'start_time' => $start,
      'length' => $length,
      'description' => $description,
      'twitch_url' => $twitch_url,
      'hub_id' => $hub,
      'image' => $fileName
    ]);

    return redirect(route('events'));
  }

  public function update(Request $request, Event $event){
    $this->validate($request, [
      'title' => 'required|max:255|min:5',
      'start_time' => 'required|date',
      'length' => 'numeric',
      'description' => 'min:5',
      'twitch_url' => 'url',
      'hub_id' => 'integer',
      'image' => 'image'
    ]);
  
    $title = $request->input('title');
    $start = $request->input('start_time');
    $length = $request->input('length');
    $description = $request->input('description');
    $twitch_url = $request->input('twitch_url');
    $hub = $request->input('hub');
    
    if($request->hasFile('image')) {
      unlink(public_path() . '/images' . $event->image);
      $fileName = time() . rand(10000, 99999) . '.' . $request->file('image')->getClientOriginalExtension();
      if (!$request->file('image')->move(public_path() . '/images/', $fileName)) {
        return Redirect::back()->withErrors(['msg', 'Unable to Upload File']);
      }
    } else {
      $fileName = $event->image;
    }
    $event->update([
      'title' => $title,
      'start_time' => $start,
      'length' => $length,
      'description' => $description,
      'twitch_url' => $twitch_url,
      'hub_id' => $hub,
      'image' => $fileName
    ]);
    
    return redirect(route('event-show', ['event' => $event]));
  }

  public function destroy(Event $event){
    $event->delete();
    return redirect(route('events'));
  }
}
