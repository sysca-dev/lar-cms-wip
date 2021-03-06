@extends('layouts.app')

@section('main-content')
  <div class="row">
    <div class="col-md-12">
      <h2><span>Create an Article</span></h2>
      <div class="content-padding">
        <form role="form" method="POST" action="{{ route('article-create') }}" enctype="multipart/form-data">
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
          <div class="form-group{{ $errors->has('hub') ? 'has-error' : '' }}">
            <label class="control-label">Link to Hub</label>
            <select class="form-control @if(count($hubs)) disabled @endif" name="hub">
              @if(count($hubs))
                <option value="">Select One</option>
                @foreach($hubs as $hub)
                  <option value="{{ $hub->id }}" @if($hub->id == old('hub')) selected @endif>{{ $hub->title }}</option>
                @endforeach
              @else
                <option value="" disabled>No Hubs Exist</option>
              @endif
            </select>
            <span class="help-block">
              @if($errors->has('hub'))
                <strong>{{ $errors->first('hub') }}</strong>
              @endif
              (Optional)
            </span>
          </div>
          <div class="form-group{{ $errors->has('contents') ? ' has-error' : '' }}">
            <label class="control-label">Contents</label>
            <textarea class="form-control" name="contents" id="contents" rows="10">{{ old('contents') }}</textarea>

            @if($errors->has('contents'))
              <span class="help-block">
                <strong>{{ $errors->first('contents') }}</strong>
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

@section('scripts')
  <script src="//cdn.ckeditor.com/4.5.7/standard/ckeditor.js"></script>
  <script>
    CKEDITOR.replace('contents');
  </script>
@endsection