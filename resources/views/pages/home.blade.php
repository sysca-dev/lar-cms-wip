@extends('layouts.app')

@section('main-content')
  <h2><span>Latest Articles</span></h2>
  <div class="content-padding">
    @unless(count($articles))
      <p>There are no Articles to display.</p>
    @endunless
    @foreach($articles as $article)
      <div class="row">
        <div class="col-md-1">
          <h4>
            <img src="{{ $article->getImageUrl() }}" style="max-height: 50px;" />
          </h4>
        </div>
        <div class="col-md-11">
          <h4><a href="{{ $article->getUrl() }}">{{ $article->title }}</a> <span class="text-muted small">by {{ $article->user->name }} {{ $article->created_at->diffForHumans() }}</span></h4>
          <p>{{ $article->plainContents(97) }}</p>
        </div>
      </div>
      @unless($article->id == $articles->last()->id)
        <hr />
      @endunless
    @endforeach
  </div>
  <h2><span>Latest Events</span></h2>
  <div class="content-padding">
    @unless(count($events))
      <p>There are no Events to display.</p>
    @endunless
    @foreach($events as $event)
      <div class="row">
        <div class="col-md-1">
          <h4>
            <img src="{{ $event->getImageUrl() }}" style="max-height: 50px;" />
          </h4>
        </div>
        <div class="col-md-11">
          <h4><a href="{{ $event->getUrl() }}">{{ $event->title }}</a> <span class="text-muted small">by {{ $event->user->name }} {{ $event->created_at->diffForHumans() }}</span></h4>
          <p>starting <strong>{{ $event->start_time->diffForHumans() }}</strong> ending after <strong>{{ $event->length }} minutes</strong></p>
        </div>
      </div>
      @unless($event->id == $events->last()->id)
        <hr />
      @endunless
    @endforeach
  </div>
  <h2><span>Latest Hubs</span></h2>
  <div class="content-padding">
    @unless(count($hubs))
      <p>There are no Hubs to display.</p>
    @endunless
    @foreach($hubs as $hub)
      <div class="row">
        <div class="col-md-1">
          <h4>
            <img src="{{ $hub->getImageUrl() }}" style="max-height: 50px;" />
          </h4>
        </div>
        <div class="col-md-11">
          <h4><a href="{{ $hub->getUrl() }}">{{ $hub->title }}</a></h4>
        </div>
      </div>
      @unless($hub->id == $hubs->last()->id)
        <hr />
      @endunless
    @endforeach
  </div>
@endsection
@if(isset($featured))
  @section('scripts')
    <script>
      var strike_featCount = <?php if(count($featured->images) > 4){ echo 4; } else { echo count($featured->images); }; ?>;
    </script>
  @endsection
@endif