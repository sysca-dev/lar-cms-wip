<?php
  $sidebar = true;
?>

@extends('layouts.app')

@section('main-content')
  <div class="row">
    <div class="col-md-12">
      <h2>
        <span>{{ $article->title }}</span>
        <span class="pull-right">
          @if(!Auth::guest())
            @if(Auth::user()->can('delete-articles'))
              <form method="POST" action="">
                {!! csrf_field() !!}
                {!! method_field('DELETE') !!}
                <button class="btn btn-danger" type="submit">Delete</button>
              </form>
            @endif
            @if(Auth::user()->can('edit-articles'))
              <a href="{{ route('article-edit', ['article' => $article]) }}" class="btn btn-warning">Edit</a>
            @endif
          @endif
        </span>
      </h2>
      <img src="{{ $article->getImageUrl() }}" alt="" title="" style="max-width: 50%;" />
      <div>
        by <a href="{{ $article->user->getUrl() }}">{{ $article->user->name }}</a> {{ $article->created_at->diffForHumans() }}
      </div>
      <hr />
      <div>
        {!! $article->contents !!}
      </div>
    </div>
  </div>
@endsection