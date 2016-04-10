@extends('layouts.app')

@section('main-content')
  <div class="row">
    <div class="col-md-12">
      <h2><span>Change Settings</span></h2>
      <div class="content-padding">
        <form role="form" method="POST" action="{{ route('settings-store') }}" enctype="multipart/form-data">
          {!! csrf_field() !!}
          <div class="form-group{{ $errors->has('facebook') ? ' has-error' : '' }}">
            <label class="control-label">Facebook URL</label>
            <input type="text" class="form-control" name="facebook" value="@if(old('facebook')) {{ old('facebook') }} @else {{ Setting::get('facebook') }} @endif">

            @if ($errors->has('facebook'))
              <span class="help-block">
            <strong>{{ $errors->first('facebook') }}</strong>
          </span>
            @endif
          </div>
          <div class="form-group{{ $errors->has('twitter') ? ' has-error' : '' }}">
            <label class="control-label">Twitter URL</label>
            <input type="text" class="form-control" name="facebook" value="@if(old('twitter')) {{ old('twitter') }} @else {{ Setting::get('twitter') }} @endif">

            @if ($errors->has('twitter'))
              <span class="help-block">
            <strong>{{ $errors->first('twitter') }}</strong>
          </span>
            @endif
          </div>
          <div class="form-group">
            <button type="submit" class="btn btn-primary">
              <i class="fa fa-btn fa-user"></i> Save
            </button>
          </div>
        </form>
      </div>
    </div>
  </div>
@endsection