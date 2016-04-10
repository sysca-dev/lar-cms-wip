<?php

namespace App\Http\Controllers\Forum;

use App\Forum\Category;
use App\Forum\Forum;
use App\Permission;
use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Redirect;

class ForumController extends Controller
{

  /**
   * Show the form for creating a new resource.
   *
   * @param Category $category
   * @return \Illuminate\Http\Response
   */
    public function create(Category $category)
    {
      return view('forum.forum.create', ['category' => $category]);
    }

  /**
   * Store a newly created resource in storage.
   *
   * @param  \Illuminate\Http\Request $request
   * @param Category $category
   * @return \Illuminate\Http\Response
   */
    public function store(Request $request, Category $category)
    {
      $this->validate($request, [
        'title' => 'required|min:2',
        'forum' => 'numeric',
        'description' => 'min:2'
      ]);

      $forum = new Forum();
      $forum->category_id = $category->id;
      $forum->title = $request->input('title');
      $forum->public = $request->input('public') ? 1 : 0;
      if($request->input('forum') && ($request->input('forum') !== 0)){
        $forum->forum = $request->input('forum');
      }
      $forum->description = $request->input('description');
      if($forum->save()){

        $perm = new Permission();
        $perm->name = 'view-forum-'.$forum->id;
        $perm->display_name = 'View Forum '.$forum->id;
        $perm->description = 'view forum '.$forum->id;
        $perm->save();

        $perm = new Permission();
        $perm->name = 'create-topics-in-forum-'.$forum->id;
        $perm->display_name = 'Create Topics in Forum '.$forum->id;
        $perm->description = 'create new topics in forum '.$forum->id;
        $perm->save();

        $perm = new Permission();
        $perm->name = 'edit-topics-in-forum-'.$forum->id;
        $perm->display_name = 'Edit Topics in Forum '.$forum->id;
        $perm->description = 'edit own topics in forum '.$forum->id;
        $perm->save();

        $perm = new Permission();
        $perm->name = 'edit-others-topics-in-forum-'.$forum->id;
        $perm->display_name = 'Edit Others Topics in Forum '.$forum->id;
        $perm->description = 'edit other peoples topics in forum '.$forum->id;
        $perm->save();

        $perm = new Permission();
        $perm->name = 'delete-topics-in-forum-'.$forum->id;
        $perm->display_name = 'Delete Topics in Forum '.$forum->id;
        $perm->description = 'delete own topics in forum '.$forum->id;
        $perm->save();

        $perm = new Permission();
        $perm->name = 'delete-others-topics-in-forum-'.$forum->id;
        $perm->display_name = 'Delete Others Topics in Forum '.$forum->id;
        $perm->description = 'delete other peoples topics in forum '.$forum->id;
        $perm->save();

        $perm = new Permission();
        $perm->name = 'create-posts-in-forum-'.$forum->id;
        $perm->display_name = 'Reply to Topics in Forum '.$forum->id;
        $perm->description = 'reply to topics in forum '.$forum->id;
        $perm->save();

        $perm = new Permission();
        $perm->name = 'edit-posts-in-forum-'.$forum->id;
        $perm->display_name = 'Edit Replies in Forum '.$forum->id;
        $perm->description = 'edit own replies in forum '.$forum->id;
        $perm->save();

        $perm = new Permission();
        $perm->name = 'edit-others-posts-in-forum-'.$forum->id;
        $perm->display_name = 'Edit Others Replies in Forum '.$forum->id;
        $perm->description = 'edit other peoples replies in forum '.$forum->id;
        $perm->save();

        $perm = new Permission();
        $perm->name = 'delete-posts-in-forum-'.$forum->id;
        $perm->display_name = 'Delete Replies in Forum '.$forum->id;
        $perm->description = 'delete own replies in forum '.$forum->id;
        $perm->save();

        $perm = new Permission();
        $perm->name = 'delete-others-posts-in-forum-'.$forum->id;
        $perm->display_name = 'Delete Others Replies in Forum '.$forum->id;
        $perm->description = 'delete other peoples replies in forum '.$forum->id;
        $perm->save();

        return redirect(route('forum-category-index'));
      } else {
        return Redirect::back()->withErrors(['msg' => 'Could not create forum.']);
      }
    }

  /**
   * Display the specified resource.
   *
   * @param Forum $forum
   * @return \Illuminate\Http\Response
   */
    public function show(Forum $forum)
    {
      return view('forum.forum.show', ['forum' => $forum]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  Forum $forum
     * @return \Illuminate\Http\Response
     */
    public function edit(Forum $forum)
    {
      return view('forum.forum.edit', ['forum' => $forum]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  Forum $forum
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Forum $forum)
    {
      $this->validate($request, [
        'title' => 'required|min:2',
        'forum' => 'numeric',
        'description' => 'min:2'
      ]);
      $forum->title = $request->input('title');
      if($request->input('forum')){
        $forum->forum = $request->input('forum');
      } else {
        $forum->forum = null;
      }
      $forum->description = $request->input('description');
      if($forum->save()){
        return redirect(route('forum-category-index'));
      } else {
        return Redirect::back()->withErrors(['msg' => 'Could not update forum.']);
      }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  Forum $forum
     * @return \Illuminate\Http\Response
     */
    public function destroy(Forum $forum)
    {
      if($forum->delete()){
        return redirect(route('forum-category-index'));
      } else {
        return Redirect::back()->withErrors(['msg' => 'Could not delete forum.']);
      }
    }
}
