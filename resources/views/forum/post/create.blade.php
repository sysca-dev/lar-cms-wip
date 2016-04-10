@extends('layouts.app')

@section('main-content')
  <div class="row">
    <div class="col-md-12">
      <h2><span>Reply to {{ $topic->title }}</span></h2>
      <div class="content-padding">
        <form role="form" method="POST" action="{{ route('forum-post-create', ['forum' => $topic->forum, 'topic' => $topic]) }}" enctype="multipart/form-data">
          {!! csrf_field() !!}
          <div class="form-group{{ $errors->has('contents') ? ' has-error' : '' }}">
            <label class="control-label">Contents</label>
            <textarea class="form-control" name="contents" rows="10">{{ old('contents') }}</textarea>

            @if ($errors->has('contents'))
              <span class="help-block">
                <strong>{{ $errors->first('contents') }}</strong>
              </span>
            @endif
          </div>
          <div class="form-group">
            <button type="submit" class="btn btn-primary">
              <i class="fa fa-btn fa-user"></i> Reply
            </button>
          </div>
        </form>
      </div>
    </div>
  </div>
@endsection