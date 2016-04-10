@extends('layouts.app')

@section('main-content')
  <div class="row">
    <div class="col-md-12">
      <h2>
        <span>Forums</span>
        <span class="pull-right">
          @if(!Auth::guest())
            @if(Auth::user()->can('create-forum-categories'))
              <a href="{{ route('forum-category-create') }}" class="btn btn-success"><i class="fa fa-plus fa-fw"></i> Category</a>
            @endif
          @endif
        </span>
      </h2>
      <hr />
      <div class="content-padding">
        <?php $category_count = 0; ?>
        @foreach($categories as $category)
          @if($category->public || (!Auth::guest() && Auth::user()->can('view-category-'.$category->id)) || (!Auth::guest() && Auth::user()->hasRole('admin')))
            <div class="row">
              <div class="col-md-12">
                <div class="row">
                  <div class="col-md-6">
                    <h2 style="margin-top: 0;">{{ $category->title }}</h2>
                  </div>
                  <div class="col-md-6 text-right">
                    @if(!Auth::guest())
                      @if(Auth::user()->can('create-forum-forums') || Auth::user()->can('edit-forum-categories') || Auth::user()->can('delete-forum-categories'))
                        <div class="btn-group">
                          <button type="button" class="btn btn-default dropdown-toggle btn-xs" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                            <i class="fa fa-chevron-down fa-fw"></i>
                          </button>
                          <ul class="dropdown-menu">
                            @if(Auth::user()->can('create-forum-forums'))
                              <li><a href="{{ route('forum-forum-create', ['category' => $category]) }}"><i class="fa fa-plus fa-fw text-success"></i> Forum</a></li>
                            @endif
                            @if(Auth::user()->can('edit-forum-categories'))
                              <li><a href="{{ route('forum-category-edit', ['category' => $category]) }}"><i class="fa fa-pencil fa-fw text-warning"></i> Edit</a></li>
                            @endif
                            @if(Auth::user()->can('delete-forum-categories'))
                              <li>
                                <form method="POST" action="{{ route('forum-category-destroy', ['category' => $category]) }}">
                                  {!! csrf_field() !!}
                                  {!! method_field('DELETE') !!}
                                  <button class="btn btn-xs" style="width: 100%;" type="submit"><i class="fa fa-trash fa-square fa-fw text-danger"></i> Delete</button>
                                </form>
                              </li>
                            @endif
                          </ul>
                        </div>
                      @endif
                    @endif
                  </div>
                </div>
                <div class="row">
                  <?php $forum_count = 0; ?>
                  @foreach($category->forums as $forum)
                    @if($forum->public || (!Auth::guest() && Auth::user()->can('view-forum-'.$forum->id)) || (!Auth::guest() && Auth::user()->hasRole('admin')))
                      <div class="col-md-12">
                        <h4><span class="fa fa-forumbee fa-fw"></span> <a href="{{ $forum->getUrl() }}">{{ $forum->title }}</a></h4>
                      </div>
                      @unless($forum->id == $category->forums->last()->id)
                        <hr />
                      @endunless
                      <?php $forum_count++; ?>
                    @endif
                  @endforeach
                  @unless($forum_count > 0)
                    <h4>No Forums exist for this Category</h4>
                  @endunless
                </div>
              </div>
            </div>
            @unless($category->id == $categories->last()->id)
              <hr />
            @endunless
            <?php $category_count++; ?>
          @endif
        @endforeach
        @unless($category_count > 0)
          <h4>No Forum Categories exist</h4>
        @endunless
      </div>
    </div>
  </div>
@endsection