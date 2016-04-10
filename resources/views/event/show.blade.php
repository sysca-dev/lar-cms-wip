<?php
$sidebar = true;
?>

@extends('layouts.app')

@section('main-content')
  <div class="row">
    <div class="col-md-12">
      <h2>
        <span>{{ $event->title }}</span>
        <span class="pull-right">
          @if(!Auth::guest())
            @if(Auth::user()->can('delete-events'))
              <form method="POST" action="">
                {!! csrf_field() !!}
                {!! method_field('DELETE') !!}
                <button class="btn btn-danger" type="submit">Delete</button>
              </form>
            @endif
            @if(Auth::user()->can('edit-events'))
              <a href="{{ route('event-edit', ['event' => $event]) }}" class="btn btn-warning">Edit</a>
            @endif
          @endif
        </span>
      </h2>
      <img src="{{ $event->getImageUrl() }}" alt="" title="" style="max-width: 50%;" />
      <div>
        by <a href="{{ $event->user->getUrl() }}">{{ $event->user->name }}</a> {{ $event->created_at->diffForHumans() }}
        <br />
        Starting in {{ $event->start_time->diffForHumans() }} lasting for {{ $event->length }} minutes
        @if($event->hub)
          <br />
          Part of the {{ $event->hub->title }} hub
        @endif
      </div>
      <hr />
      <div>
        {!! $event->description !!}
      </div>
    </div>
  </div>
@endsection