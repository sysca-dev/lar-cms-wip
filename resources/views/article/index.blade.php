<?php
$sidebar = true;
?>

@extends('layouts.app')

@section('main-content')
  <div class="row">
    <div class="col-md-12">
      <h2>
        <span>Articles</span>
        <span class="pull-right">
          @if(!Auth::guest())
            @if(Auth::user()->can('create-articles'))
              <a href="{{ route('article-create') }}" class="btn btn-success">Create</a>
            @endif
          @endif
        </span>
      </h2>
      <hr />
      <div class="content-padding">
        @unless(count($articles))
          <h4>No Articles Exist</h4>
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
    </div>
  </div>
@endsection