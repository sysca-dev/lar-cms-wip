@extends('layouts.app')

@section('stylesheets')
  <link href="{{ url('css/bootstrap-datetimepicker.min.css') }}" rel="stylesheet" />
@endsection

@section('main-content')
  <div class="row">
    <div class="col-md-12">
      <h2><span>Edit Event {{ $event->title }}</span></h2>
      <div class="content-padding">
        <form role="form" method="POST" action="" enctype="multipart/form-data">
          {!! csrf_field() !!}
          {!! method_field('patch') !!}
          <div class="form-group{{ $errors->has('title') ? ' has-error' : '' }}">
            <label class="control-label">Title</label>
            <input type="text" class="form-control" name="title" value="{{ (old('title')) ? old('title') : $event->title }}">

            @if ($errors->has('title'))
              <span class="help-block">
                <strong>{{ $errors->first('title') }}</strong>
              </span>
            @endif
          </div>
          <div class="form-group{{ $errors->has('image') ? 'has-error' : '' }}">
            <label class="control-label">Change Image</label>
            <input type="file" class="form-control" name="image" value="{{ (old('image')) ? old('image') : $event->image }}">

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
                  <option value="{{ $hub->id }}" @if(old('hub') && ($hub->id == old('hub'))) selected @elseif($event->hub && ($event->hub->id == $hub->id)) selected @endif>{{ $hub->title }}</option>
                @endforeach
              @else
                <option value="" disabled>No Hubs Exist</option>
              @endif
            </select>
            <span class="help-block">
              @if($errors->has('hub'))
                <strong>{{ $errors->first('hub') }}</strong>
              @endif
              Optional
            </span>
          </div>
          <div class="form-group{{ $errors->has('start_time') ? 'has-error' : '' }}">
            <label class="control-label">Start Date &amp; Time</label>
            <input type="text" class="form-control" name="start_time" id="start_time" value="{{ (old('start_time')) ? old('start_time') : $event->start_time }}" readonly>
            @if($errors->has('start_time'))
              <span class="help-block">
                  <strong>{{ $errors->first('start_time') }}</strong>
              </span>
            @endif
          </div>
          <div class="form-group{{ $errors->has('length') ? 'has-error' : '' }}">
            <label class="control-label">Length</label>
            <input type="number" class="form-control" name="length" value="{{ (old('length')) ? old('length') : $event->length }}">
            <span class="help-block">
              @if($errors->has('length'))
                <strong>{{ $errors->first('length') }}</strong>
              @endif
              Enter a value in minutes
            </span>
          </div>
          <div class="form-group{{ $errors->has('twitch_url') ? 'has-error' : '' }}">
            <label class="control-label">Twitch URL</label>
            <input type="url" class="form-control" name="twitch_url" value="{{ (old('twitch_url')) ? old('twitch_url') : $event->twitch_url }}">
            <span class="help-block">
              @if($errors->has('twitch_url'))
                <strong>{{ $errors->first('twitch_url') }}</strong>
              @endif
              Must be a valid URL (Optional)
            </span>
          </div>
          <div class="form-group{{ $errors->has('description') ? ' has-error' : '' }}">
            <label class="control-label">Description</label>
            <textarea class="form-control" name="description" id="description" rows="10">{{ (old('description')) ? old('description') : $event->description }}</textarea>

            @if($errors->has('contents'))
              <span class="help-block">
                <strong>{{ $errors->first('description') }}</strong>
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

@section('scripts')
  <script src="//cdn.ckeditor.com/4.5.7/standard/ckeditor.js"></script>
  <script src="{{ url('js/bootstrap-datetimepicker.min.js') }}"></script>
  <script>
    CKEDITOR.replace('description');
  </script>
  <script>
    $('#start_time').datetimepicker({
      startDate: "{{ date('Y-m-d H:i:s') }}"
    });
  </script>
@endsection