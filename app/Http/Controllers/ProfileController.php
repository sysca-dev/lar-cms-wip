<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Profile;
use App\User;
use App\Http\Requests;

class ProfileController extends Controller
{
  public function index(){
    return view('profile.index', ['profiles' => Profile::paginate(20)]);
  }

  public function show($id){
    $profile = Profile::where('user_id', $id)->first();
    return view('profile.show', ['profile' => $profile]);
  }

  public function edit($id){
    $profile = Profile::where('user_id', $id)->first();
    return view('profile.edit', ['profile' => $profile]);
  }

  public function update(Request $request, $id){
    $profile = Profile::where('user_id', $id)->first();

    $this->validate($request, [
      'dob' => 'date',
      'first_name' => 'min:2|max:255',
      'last_name' => 'min:2|max:255',
      'location' => 'max:255'
    ]);

    $profile->update([
      'dob' => $request->input('dob'),
      'first_name' => $request->input('first_name'),
      'last_name' => $request->input('last_name'),
      'gender' => $request->input('gender'),
      'location' => $request->input('location')
    ]);

    return redirect(route('user-show', ['user' => User::where('id', $id)->first()]));
  }
}
