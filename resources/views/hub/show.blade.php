<?php
$sidebar = true;
?>

@extends('layouts.app')

@section('main-content')
  <div class="row">
    <div class="col-md-12">
      <h2>
        <span>{{ $hub->title }}</span>
        <span class="pull-right">
          @if(!Auth::guest())
            @if(Auth::user()->can('delete-hubs'))
              <form method="POST" action="">
                {!! csrf_field() !!}
                {!! method_field('DELETE') !!}
                <button class="btn btn-danger" type="submit">Delete</button>
              </form>
            @endif
            @if(Auth::user()->can('edit-hubs'))
              <a href="{{ route('hub-edit', ['hub' => $hub]) }}" class="btn btn-warning">Edit</a>
            @endif
          @endif
        </span>
      </h2>
      <img src="{{ $hub->getImageUrl() }}" alt="" title="" style="max-width: 50%;" />
      <hr />
      <div>
        Server: {{ $hub->server_ip }}
        <br />
        Do Hub Things
        <br />
        <h2><span>Events</span></h2>
        @foreach($hub->events as $event)
          <div class="row">
            <div class="col-md-1">
              <h4>
                <img src="{{ $event->getImageUrl() }}" style="max-height: 50px;" />
              </h4>
            </div>
            <div class="col-md-11">
              <h4><a href="{{ $event->getUrl() }}">{{ $event->title }}</a> <span class="text-muted small">by {{ $event->user->name }} {{ $event->created_at->diffForHumans() }}</span></h4>
              <p>starting <strong>{{ $event->start_time->diffForHumans() }}</strong> ending after <strong>{{ $event->length }} minutes</strong></p>
            </div>
          </div>
          @unless($event->id == $hub->events->last()->id)
            <hr />
          @endunless
        @endforeach
        @unless(count($hub->events))
          <p>No Events exist for this Hub</p>
        @endunless
        <br>
        <h2><span>Articles</span></h2>
        @foreach($hub->articles as $article)
          <div class="row">
            <div class="col-md-1">
              <h4>
                <img src="{{ $article->getImageUrl() }}" style="max-height: 50px;" />
              </h4>
            </div>
            <div class="col-md-11">
              <h4><a href="{{ $article->getUrl() }}">{{ $article->title }}</a> <span class="text-muted small">by {{ $article->user->name }} {{ $article->created_at->diffForHumans() }}</span></h4>
              <p>{{ $article->plainContents(97) }}</p>
            </div>
          </div>
          @unless($article->id == $hub->articles->last()->id)
            <hr />
          @endunless
        @endforeach
        @unless(count($hub->articles))
          <p>No Articles exist for this Hub</p>
        @endunless
      </div>
    </div>
  </div>
@endsection