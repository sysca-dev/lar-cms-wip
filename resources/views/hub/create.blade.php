@extends('layouts.app')

@section('main-content')
  <div class="row">
    <div class="col-md-12">
      <h2><span>Create a Hub</span></h2>
      <div class="content-padding">
        <form role="form" method="POST" action="{{ route('hub-create') }}" enctype="multipart/form-data">
          {!! csrf_field() !!}
          <div class="form-group{{ $errors->has('title') ? ' has-error' : '' }}">
            <label class="control-label">Title</label>
            <input type="text" class="form-control" name="title" value="{{ old('title') }}">

            @if ($errors->has('title'))
              <span class="help-block">
                <strong>{{ $errors->first('title') }}</strong>
              </span>
            @endif
          </div>
          <div class="form-group{{ $errors->has('image') ? 'has-error' : '' }}">
            <label class="control-label">Image</label>
            <input type="file" class="form-control" name="image" value="{{ old('image') }}">

            @if($errors->has('image'))
              <span class="help-block">
                <strong>{{ $errors->first('image') }}</strong>
              </span>
            @endif
          </div>
          <div class="form-group{{ $errors->has('server_ip') ? 'has-error' : '' }}">
            <label class="control-label">Server IP</label>
            <input type="text" class="form-control" name="server_ip" value="{{ old('server_ip') }}">
            @if($errors->has('server_ip'))
              <span class="help-block">
                <strong>{{ $errors->first('server_ip') }}</strong>
              </span>
            @endif
          </div>
          <div class="form-group">
            <button type="submit" class="btn btn-primary">
              <i class="fa fa-btn fa-user"></i> Create
            </button>
          </div>
        </form>
      </div>
    </div>
  </div>
@endsection