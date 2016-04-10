@extends('layouts.app')

@section('main-content')
  <div class="row">
    <div class="col-md-12">
      <h2><span>Edit {{ $topic->title }}</span></h2>
      <div class="content-padding">
        <form role="form" method="POST" action="" enctype="multipart/form-data">
          {!! csrf_field() !!}
          {!! method_field('patch') !!}
          <div class="form-group{{ $errors->has('title') ? ' has-error' : '' }}">
            <label class="control-label">Title</label>
            <input type="text" class="form-control" name="title" value="{{ old('title') ? old('title') : $topic->title }}">

            @if ($errors->has('title'))
              <span class="help-block">
                <strong>{{ $errors->first('title') }}</strong>
              </span>
            @endif
          </div>
          <div class="form-group{{ $errors->has('contents') ? ' has-error' : '' }}">
            <label class="control-label">Contents</label>
            <textarea class="form-control" name="contents" rows="10">{{ old('contents') ? old('contents') : $topic->contents }}</textarea>

            @if ($errors->has('contents'))
              <span class="help-block">
                <strong>{{ $errors->first('contents') }}</strong>
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