@extends('layouts.app')

@section('main-content')
  @if($forum->public || (!Auth::guest() && Auth::user()->can('view-forum-'.$forum->id)) || (!Auth::guest() && Auth::user()->hasRole('admin')))
    <div class="row">
      <div class="col-md-12">
        <h2>
          <span><a href="{{ $forum->getUrl() }}"><i class="fa fa-chevron-left fa-fw"></i></a> {{ $topic->title }} <small>by {{ $topic->user->name }} {{ $topic->created_at->diffForHumans() }}</small></span>
          <span class="pull-right">
            @if(!Auth::guest())
              @if(Auth::user()->can('create-forum-posts'))
                <a href="{{ route('forum-post-create', ['forum' => $topic->forum, 'topic' => $topic]) }}" class="btn btn-success"><i class="fa fa-plus fa-fw"></i> Reply</a>
              @endif
              @if(Auth::user()->can('edit-forum-topics') || Auth::user()->can('delete-forum-topics'))
                <div class="btn-group">
                  <button type="button" class="btn btn-default dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                    <i class="fa fa-chevron-down fa-fw"></i>
                  </button>
                  <ul class="dropdown-menu">
                    @if(Auth::user()->can('edit-forum-topics'))
                      <li><a href="{{ route('forum-topic-edit', ['forum' => $forum, 'topic' => $topic]) }}"><i class="fa fa-pencil fa-fw text-warning"></i> Edit</a></li>
                    @endif
                    @if(Auth::user()->can('delete-forum-topics'))
                      <li>
                        <form method="POST" action="{{ route('forum-topic-destroy', ['forum' => $forum, 'topic' => $topic]) }}">
                          {!! csrf_field() !!}
                          {!! method_field('DELETE') !!}
                          <button class="btn btn-xs" style="width: 100%;" type="submit"><i class="fa fa-trash fa-square fa-fw text-danger"></i> Delete</button>
                        </form>
                      </li>
                    @endif
                  </ul>
                </div>
              @endif
            @endif
          </span>
        </h2>
        <hr />
        <p>{{ $topic->contents }}</p>
        <hr />
        <div class="content-padding">
          @if(count($topic->posts))
            <h2>Replies</h2>
            <hr />
          @else
            <h2>No Replies Exist</h2>
          @endif
          @foreach($topic->posts as $post)
            <div class="row">
              <div class="col-md-12">
                <div class="row">
                  <div class="col-md-6">
                    <small>by {{ $post->user->name }} {{ $post->created_at->diffForHumans() }}</small>
                  </div>
                  <div class="col-md-6 text-right">
                    @if(!Auth::guest())
                      @if(Auth::user()->can('edit-forum-posts') && ($post->user->id == Auth::user()->id))
                        <a href="{{ route('forum-post-edit', ['forum' => $topic->forum, 'topic' => $topic, 'post' => $post]) }}" class="btn btn-warning btn-xs"><i class="fa fa-pencil fa-fw"></i></a>
                      @endif
                      @if(Auth::user()->can('delete-forum-posts') && ($post->user->id == Auth::user()->id))
                        <form method="POST" action="{{ route('forum-post-destroy', ['forum' => $forum, 'topic' => $topic, 'post' => $post]) }}" style="display: inline;">
                          {!! csrf_field() !!}
                          {!! method_field('DELETE') !!}
                          <button class="btn btn-danger btn-xs" type="submit"><i class="fa fa-trash fa-fw"></i></button>
                        </form>
                      @endif
                    @endif
                  </div>
                </div>
                <div class="row">
                  <div class="col-md-12">
                    <p>{{ $post->contents }}</p>
                  </div>
                </div>
              </div>
            </div>
            @unless($post->id == $topic->posts->last()->id)
              <hr />
            @endunless
          @endforeach
        </div>
      </div>
    </div>
  @else
    <div class="row">
      <div class="col-md-12 text-center">
        <div style="position: relative;">
          <div style="position: fixed; top: 50%; left: 50%; transform: translate(-50%, -50%);">
            <h4>You don't have permissions to view this Forum</h4>
            <p>
              @if(Auth::guest())
                Please <a href="{{ url('/login') }}">login</a> and try again.
              @else
                <a href="#">Contact Us</a> if you believe this to be an error.
              @endif
            </p>
            <p>
              <a href="{{ route('forum-category-index') }}"><i class="fa fa-chevron-left fa-fw"></i> Back to Forum Index</a>
            </p>
          </div>
        </div>
      </div>
    </div>
  @endif
@endsection