@extends('layouts.app')

@section('main-content')
  {!! $profiles->render() !!}
  <div class="row">
    <div class="col-md-12">
      <h2><span>User List</span></h2>
      @foreach($profiles as $profile)
        <div>
          <h4 style="margin-bottom: 0;"><a href="{{ $profile->user->getUrl() }}">{{ $profile->user->name }}</a></h4>
          @foreach($profile->user->roles as $role)
            {{ $role->display_name }}@unless($profile->user->roles->last()->id == $role->id),@endunless
          @endforeach
        </div>
        @unless($profile->id == $profiles->last()->id)
          <hr />
        @endunless
      @endforeach
    </div>
  </div>
@endsection