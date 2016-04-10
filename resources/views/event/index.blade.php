<?php
$sidebar = true;
?>

@extends('layouts.app')

@section('main-content')
  <div class="row">
    <div class="col-md-12">
      <h2>
        <span>Events</span>
        <span class="pull-right">
          @if(!Auth::guest())
            @if(Auth::user()->can('create-events'))
              <a href="{{ route('event-create') }}" class="btn btn-success">Create</a>
            @endif
          @endif
        </span>
      </h2>
      <hr />
      <div class="content-padding">
        @unless(count($events))
          <h4>No Events Exist</h4>
        @endunless
        @foreach($events as $event)
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
          @unless($event->id == $events->last()->id)
            <hr />
          @endunless
        @endforeach
      </div>
    </div>
  </div>
@endsection