<?php

namespace App\Http\Controllers\Admin;

use App\User;
use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
      return view('admin.user.index', ['users' => User::all()]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
      return view('admin.user.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

  /**
   * Display the specified resource.
   *
   * @param User $user
   * @return \Illuminate\Http\Response
   */
    public function show(User $user)
    {
      return view('admin.user.show', ['user' => $user]);
    }

  /**
   * Show the form for editing the specified resource.
   *
   * @param User $user
   * @return \Illuminate\Http\Response
   */
    public function edit(User $user)
    {
      return view('admin.user.edit', ['user' => $user]);
    }

  /**
   * Update the specified resource in storage.
   *
   * @param  \Illuminate\Http\Request $request
   * @param User $user
   * @return \Illuminate\Http\Response
   */
    public function update(Request $request, User $user)
    {
        //
    }

  /**
   * Remove the specified resource from storage.
   *
   * @param User $user
   * @return \Illuminate\Http\Response
   */
    public function destroy(User $user)
    {
        //
    }
}
