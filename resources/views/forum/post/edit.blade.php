@extends('layouts.app')

@section('main-content')
  <div class="row">
    <div class="col-md-12">
      <h2><span>Edit {{ $post->title }}</span></h2>
      <div class="content-padding">
        @if($post->user->id !== Auth::user()->id)
          <h4>You don't have permission to edit this post.</h4>
        @else
          <form role="form" method="POST" action="" enctype="multipart/form-data">
            {!! csrf_field() !!}
            {!! method_field('patch') !!}
            <div class="form-group{{ $errors->has('contents') ? ' has-error' : '' }}">
              <label class="control-label">Contents</label>
              <textarea class="form-control" name="contents" rows="10">{{ old('contents') ? old('contents') : $post->contents }}</textarea>

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
        @endif
      </div>
    </div>
  </div>
@endsection