<?php

namespace App\Http\Controllers\Forum;

use App\Forum\Forum;
use App\Forum\Topic;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Redirect;

class TopicController extends Controller
{
  use SoftDeletes;

  /**
   * Show the form for creating a new resource.
   *
   * @param Forum $forum
   * @return \Illuminate\Http\Response
   */
    public function create(Forum $forum)
    {
      return view('forum.topic.create', ['forum' => $forum]);
    }

  /**
   * Store a newly created resource in storage.
   *
   * @param  \Illuminate\Http\Request $request
   * @param  Forum $forum
   * @return \Illuminate\Http\Response
   */
    public function store(Request $request, Forum $forum)
    {
      $this->validate($request, [
        'title' => 'required|min:2',
        'contents' => 'required|min:10'
      ]);

      $topic = new Topic();
      $topic->title = $request->input('title');
      $topic->contents = $request->input('contents');
      $topic->user_id = $request->user()->id;
      $topic->forum_id = $forum->id;

      if($topic->save()){
        return redirect(route('forum-topic-show', ['topic' => $topic, 'forum' => $forum]));
      } else {
        return Redirect::back()->withErrors(['msg' => 'Could not create the topic. Please try again.']);
      }
    }

  /**
   * Display the specified resource.
   *
   * @param Forum $forum
   * @param  Topic $topic
   * @return \Illuminate\Http\Response
   */
    public function show(Forum $forum, Topic $topic)
    {
      return view('forum.topic.show', ['topic' => $topic, 'forum' => $forum]);
    }

  /**
   * Show the form for editing the specified resource.
   *
   * @param Forum $forum
   * @param  Topic $topic
   * @return \Illuminate\Http\Response
   */
    public function edit(Forum $forum, Topic $topic)
    {
      return view('forum.topic.edit', ['forum' => $forum, 'topic' => $topic]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  Topic $topic
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Topic $topic)
    {
      $this->validate($request, [
        'title' => 'required|min:2',
        'contents' => 'required|min:10'
      ]);

      $topic->title = $request->input('title');
      $topic->contents = $request->input('contents');

      if($topic->save()){
        return redirect(route('forum-topic-show', ['topic' => $topic, 'forum' => $topic->forum]));
      } else {
        return Redirect::back()->withErrors(['msg' => 'Could not update the topic. Please try again.']);
      }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  Topic $topic
     * @return \Illuminate\Http\Response
     */
    public function destroy(Topic $topic)
    {
      if(Auth::user()->id == $topic->user->id) {
        if ($topic->delete()) {
          return redirect(route('forum-forum-show', ['forum' => $topic->forum]));
        } else {
          return Redirect::back()->withErrors(['msg' => 'Could not delete the topic. Please try again']);
        }
      } else {
        return Redirect::back()->withErrors(['msg' => 'You don\'t have permission to delete this post']);
      }
    }
}
