@extends('layouts.app')

@section('main-content')
  @if($forum->public || (!Auth::guest() && Auth::user()->can('view-forum-'.$forum->id)) || (!Auth::guest() && Auth::user()->hasRole('admin')))
    <div class="row">
      <div class="col-md-12">
        <h2>
          <span><a href="{{ route('forum-category-index') }}"><i class="fa fa-chevron-left fa-fw"></i></a> {{ $forum->title }}</span>
          <span class="pull-right">
            @if(!Auth::guest())
              @if(Auth::user()->can('create-forum-topics'))
                <a href="{{ route('forum-topic-create', ['forum' => $forum]) }}" class="btn btn-success"><i class="fa fa-plus fa-fw"></i> Topic</a>
              @endif
              @if(Auth::user()->can('edit-forum-forums') || Auth::user()->can('delete-forum-forums'))
                <div class="btn-group">
                  <button type="button" class="btn btn-default dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                    <i class="fa fa-chevron-down fa-fw"></i>
                  </button>
                  <ul class="dropdown-menu">
                    @if(Auth::user()->can('edit-forum-forums'))
                      <li><a href="{{ route('forum-forum-edit', ['forum' => $forum]) }}"><i class="fa fa-pencil fa-fw text-warning"></i> Edit</a></li>
                    @endif
                    @if(Auth::user()->can('delete-forum-forums'))
                      <li>
                        <form method="POST" action="{{ route('forum-forum-destroy', ['forum' => $forum]) }}">
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
        <div class="content-padding">
          @unless(count($forum->topics))
            <h4>No Topics Exist</h4>
          @endunless
          @foreach($forum->topics as $topic)
            <div class="row">
              <div class="col-md-12">
                <div class="row">
                  <div class="col-md-6">
                    <h4><a href="{{ $topic->getUrl() }}">{{ $topic->title }}</a></h4>
                    <p>by {{ $topic->user->name }} {{ $topic->created_at->diffForHumans() }}</p>
                  </div>
                </div>
              </div>
            </div>
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