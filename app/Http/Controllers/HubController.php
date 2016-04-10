<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Hub;
use Illuminate\Support\Facades\Redirect;
use App\Http\Requests;

class HubController extends Controller
{
  public function index(){
    $hubs = Hub::all();

    return view('hub.index', ['hubs' => $hubs]);
  }

  public function show(Hub $hub){
    return view('hub.show', ['hub' => $hub]);
  }

  public function create(){
    return view('hub.create');
  }

  public function edit(Hub $hub){
    return view('hub.edit', ['hub' => $hub]);
  }

  public function store(Request $request){
    $this->validate($request, [
      'title' => 'required|max:255|min:2',
      'image' => 'required|image'
    ]);

    $title = $request->input('title');
    $server_ip = $request->input('server_ip');
    $fileName = time().rand(10000, 99999).'.'.$request->file('image')->getClientOriginalExtension();
    if(!$request->file('image')->move(public_path().'/images/', $fileName)){
      return Redirect::back()->withErrors(['msg', 'Unable to Upload File']);
    }
    $hub = new Hub();
    $hub->create([
      'title' => $title,
      'server_ip' => $server_ip,
      'image' => $fileName
    ]);

    return redirect(route('hubs'));
  }

  public function update(Request $request, Hub $hub){
    $this->validate($request, [
      'title' => 'required|max:255|min:2',
      'image' => 'required|image'
    ]);

    $title = $request->input('title');
    $server_ip = $request->input('server_ip');
    if($request->hasFile('image')){
      unlink(public_path().'/images'.$hub->image);
      $fileName = time().rand(10000,99999).'.'.$request->file('image')->getClientOriginalExtension();
      if(!$request->file('image')->move(public_path().'/images/', $fileName)){
        return Redirect::back()->withErrors(['msg', 'Unable to Upload File']);
      }
    } else {
      $fileName = $hub->image;
    }
    $hub->update([
      'title' => $title,
      'server_ip' => $server_ip,
      'image' => $fileName
    ]);
    return redirect(route('hub-show', ['hub' => $hub]));
  }

  public function destroy(Hub $hub){
    $hub->delete();
    return redirect(route('hubs'));
  }
}
