<?php
$sidebar = true;
?>

@extends('layouts.app')

@section('main-content')
  <div class="row">
    <div class="col-md-12">
      <h2>
        <span>Hubs</span>
        <span class="pull-right">
          @if(!Auth::guest())
            @if(Auth::user()->can('create-hubs'))
              <a href="{{ route('hub-create') }}" class="btn btn-success">Create</a>
            @endif
          @endif
        </span>
      </h2>
      <hr />
      <div class="content-padding">
        @unless(count($hubs))
          <h4>No Hubs Exist</h4>
        @endunless
        @foreach($hubs as $hub)
          <div class="row">
            <div class="col-md-1">
              <h4>
                <img src="{{ $hub->getImageUrl() }}" style="max-height: 50px;" />
              </h4>
            </div>
            <div class="col-md-11">
              <h4><a href="{{ $hub->getUrl() }}">{{ $hub->title }}</a></h4>
            </div>
          </div>
          @unless($hub->id == $hubs->last()->id)
            <hr />
          @endunless
        @endforeach
      </div>
    </div>
  </div>
@endsection