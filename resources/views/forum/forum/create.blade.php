@extends('layouts.app')

@section('main-content')
  <div class="row">
    <div class="col-md-12">
      <h2><span>Create a Forum in <strong>{{ $category->title }}</strong></span></h2>
      <div class="content-padding">
        <form role="form" method="POST" action="{{ route('forum-forum-store', ['category' => $category]) }}" enctype="multipart/form-data">
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
          <div class="form-group{{ $errors->has('description') ? ' has-error' : '' }}">
            <label class="control-label">Description</label>
            <input type="text" class="form-control" name="description" value="{{ old('description') }}">

            @if ($errors->has('description'))
              <span class="help-block">
                <strong>{{ $errors->first('description') }}</strong>
              </span>
            @endif
          </div>
          <div class="form-group{{ $errors->has('forum') ? ' has-error' : '' }}">
            <label class="control-label">Sub Forum of (optional)</label>
            <select class="form-control" name="forum">
              <option value="0">No Sub Forum</option>
              @foreach($category->forums as $cforum)
                <option value="{{ $cforum->id }}">{{ $cforum->title }}</option>
              @endforeach
            </select>
          </div>
          <div class="form-group{{ $errors->has('public') ? ' has-error' : '' }}">
            <label class="control-label">Viewable to Public</label>
            <select name="public" class="form-control">
              <option value="true" {{ (old('public') == 'true') ? 'selected' : '' }}>Yes</option>
              <option value="false" {{ (old('public') == 'false') ? 'selected' : '' }}>No</option>
            </select>

            @if ($errors->has('public'))
              <span class="help-block">
                <strong>{{ $errors->first('public') }}</strong>
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