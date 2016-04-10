<?php

namespace App\Http\Controllers\Admin;

use App\Role;
use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;

class RoleController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
      return view('admin.role.index', ['roles' => Role::all()]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
      return view('admin.role.create');
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
   * @param Role $role
   * @return \Illuminate\Http\Response
   */
    public function show(Role $role)
    {
        //
    }

  /**
   * Show the form for editing the specified resource.
   *
   * @param Role $role
   * @return \Illuminate\Http\Response
   */
    public function edit(Role $role)
    {
      return view('admin.role.edit', ['role' => $role]);
    }

  /**
   * Update the specified resource in storage.
   *
   * @param  \Illuminate\Http\Request $request
   * @param Role $role
   * @return \Illuminate\Http\Response
   */
    public function update(Request $request, Role $role)
    {
        //
    }

  /**
   * Remove the specified resource from storage.
   *
   * @param Role $role
   * @return \Illuminate\Http\Response
   */
    public function destroy(Role $role)
    {
        //
    }
}
