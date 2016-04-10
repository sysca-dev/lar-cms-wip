<?php

namespace App\Http\Controllers\Forum;

use App\Forum\Category;
use Illuminate\Http\Request;
use App\Role;
use App\User;
use App\Permission;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Redirect;

class CategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
      return view('forum.category.index', ['categories' => Category::orderBy('order', 'DESC')->get()]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
      return view('forum.category.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
      $this->validate($request, [
        'title' => 'required|min:2'
      ]);

      $category = new Category();
      $category->title = $request->input('title');
      $category->public = $request->input('public') ? 1 : 0;
      if($category->save()){

        $perm = new Permission();
        $perm->name = 'view-category-'.$category->id;
        $perm->display_name = 'View Category '.$category->id;
        $perm->description = 'view category '.$category->id;
        $perm->save();

        $admin = Role::where('name', '=', 'admin')->first();
        $admin->attachPermission($perm);

        return redirect(route('forum-category-index'));
      } else {
        return Redirect::back()->withErrors(['msg', 'Unable to create category.']);
      }
    }

  /**
   * Display the specified resource.
   *
   * @param Category $category
   * @return \Illuminate\Http\Response
   */
    public function show(Category $category)
    {
      return view('forum.category.view', ['category' => $category]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  Category $category
     * @return \Illuminate\Http\Response
     */
    public function edit(Category $category)
    {
      return view ('forum.category.edit', ['category' => $category]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  Category  $category
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Category $category)
    {
      $this->validate($request, [
        'title' => 'required|min:2'
      ]);
      
      $category->title = $request->input('title');
      if($category->save()){
        return redirect(route('forum-category-index'));
      } else {
        return Redirect::back()->withErrors(['msg', 'Unable to update category.']);
      }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  Category  $category
     * @return \Illuminate\Http\Response
     */
    public function destroy(Category $category)
    {
      if($category->delete()){
        return redirect(route('forum-category-index'));
      } else {
        return Redirect::back()->withErrors(['msg', 'Unable to delete category.']);
      }
    }
}
