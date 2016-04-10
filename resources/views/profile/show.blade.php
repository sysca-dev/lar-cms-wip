@extends('layouts.app')

@section('main-content')
  <div class="row">
    <div class="col-md-12">
      <h4><span>{{ $profile->user->name }}</span></h4>
      Profile for user... do profile things.
    </div>
  </div>
@endsection