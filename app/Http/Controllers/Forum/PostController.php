<?php

namespace App\Http\Controllers\Forum;

use App\Forum\Forum;
use App\Forum\Post;
use App\Forum\Topic;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Redirect;

class PostController extends Controller
{
  use SoftDeletes;

  /**
   * Show the form for creating a new resource.
   *
   * @param Forum $forum
   * @param Topic $topic
   * @return \Illuminate\Http\Response
   */
    public function create(Forum $forum, Topic $topic)
    {
      return view ('forum.post.create', ['forum' => $forum, 'topic' => $topic]);
    }

  /**
   * Store a newly created resource in storage.
   *
   * @param  \Illuminate\Http\Request $request
   * @param Forum $forum
   * @param  Topic $topic
   * @return \Illuminate\Http\Response
   */
    public function store(Request $request, Forum $forum, Topic $topic)
    {
      $this->validate($request, [
        'contents' => 'required|min:10'
      ]);

      $post = new Post();
      $post->user_id = $request->user()->id;
      $post->topic_id = $topic->id;
      $post->contents = $request->input('contents');

      if($post->save()){
        return redirect(route('forum-topic-show', ['forum' => $forum, 'topic' => $topic]));
      } else {
        return Redirect::back()->withErrors(['msg' => 'Could not create post. Please try again.']);
      }
    }

    /**
     * Display the specified resource.
     *
     * @param  Post $post
     * @return \Illuminate\Http\Response
     */
    public function show(Post $post)
    {
      return view('forum.post.show', ['post' => $post]);
    }

  /**
   * Show the form for editing the specified resource.
   *
   * @param Forum $forum
   * @param Topic $topic
   * @param  Post $post
   * @return \Illuminate\Http\Response
   */
    public function edit(Forum $forum, Topic $topic, Post $post)
    {
      return view('forum.post.edit', ['forum' => $forum, 'topic' => $topic, 'post' => $post]);
    }

  /**
   * Update the specified resource in storage.
   *
   * @param  \Illuminate\Http\Request $request
   * @param Forum $forum
   * @param Topic $topic
   * @param  Post $post
   * @return \Illuminate\Http\Response
   */
    public function update(Request $request, Forum $forum, Topic $topic, Post $post)
    {
      $this->validate($request, [
        'contents' => 'required|min:10'
      ]);

      $post->contents = $request->input('contents');

      if($post->save()){
        return redirect(route('forum-topic-show', ['forum' => $forum, 'topic' => $topic]));
      } else {
        return Redirect::back()->withErrors(['msg' => 'Could not update post. Please try again.']);
      }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  Post $post
     * @return \Illuminate\Http\Response
     */
    public function destroy(Forum $forum, Topic $topic, Post $post)
    {
      if($post->delete()){
        return redirect(route('forum-topic-show', ['forum' => $forum, 'topic' => $topic]));
      } else {
        return Redirect::back()->withErrors(['msg' => 'Could not delete post. Please try again.']);
      }
    }
}
