@extends('layouts.app')

@section('main-content')
  <div class="row">
    <div class="col-md-12">
      <h2><span>Edit Hub {{ $hub->title }}</span></h2>
      <div class="content-padding">
        <form role="form" method="POST" action="" enctype="multipart/form-data">
          {!! csrf_field() !!}
          {!! method_field('patch') !!}
          <div class="form-group{{ $errors->has('title') ? ' has-error' : '' }}">
            <label class="control-label">Title</label>
            <input type="text" class="form-control" name="title" value="{{ old('title') ? old('title') : $hub->title }}">

            @if ($errors->has('title'))
              <span class="help-block">
                <strong>{{ $errors->first('title') }}</strong>
              </span>
            @endif
          </div>
          <div class="form-group{{ $errors->has('image') ? 'has-error' : '' }}">
            <label class="control-label">Change Image</label>
            <input type="file" class="form-control" name="image" value="{{ old('image') ? old('image') : $hub->image }}">

            @if($errors->has('image'))
              <span class="help-block">
                <strong>{{ $errors->first('image') }}</strong>
              </span>
            @endif
          </div>
          <div class="form-group{{ $errors->has('server_ip') ? 'has-error' : '' }}">
            <label class="control-label">Server IP</label>
            <input type="text" class="form-control" name="server_ip" value="{{ old('server_ip') ? old('server_ip') : $hub->server_ip }}">
            @if($errors->has('server_ip'))
              <span class="help-block">
                <strong>{{ $errors->first('server_ip') }}</strong>
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