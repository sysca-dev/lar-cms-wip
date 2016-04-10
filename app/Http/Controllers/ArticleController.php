<?php

namespace App\Http\Controllers;

use App\Hub;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Http\Request;
use App\Article;

use App\Http\Requests;

class ArticleController extends Controller
{
  use SoftDeletes;

  public function index(){
    $articles = Article::all();

    return view('article.index', ['articles' => $articles]);
  }

  public function show(Article $article){

    return view ('article.show', ['article' => $article]);
  }

  public function create()
  {
    $hubs = Hub::all();
    return view ('article.create', ['hubs' => $hubs]);
  }

  public function edit(Article $article)
  {
    $hubs = Hub::all();
    return view ('article.edit', ['article' => $article, 'hubs' => $hubs]);
  }

  public function store(Request $request)
  {
    $this->validate($request, [
      'title' => 'required|max:255|min:5',
      'contents' => 'required|min:10',
      'image' => 'required|image'
    ]);

    $title = $request->input('title');
    $contents = $request->input('contents');
    $hub = $request->input('hub');
    $fileName = time().rand(10000,99999).'.'.$request->file('image')->getClientOriginalExtension();
    if(!$request->file('image')->move(public_path().'/images/', $fileName)){
      error_log('Could not move file');
    }

    $request->user()->articles()->create([
      'title' => $title,
      'contents' => $contents,
      'image' => $fileName,
      'hub_id' => $hub
    ]);

    return redirect(route('articles'));
  }

  public function update(Request $request, Article $article)
  {

    $this->validate($request, [
      'title' => 'required|max:255|min:5',
      'contents' => 'required|min:10',
      'image' => 'image'
    ]);

    $title = $request->input('title');
    $contents = $request->input('contents');
    $hub = $request->input('hub_id');
    if($request->hasFile('image')) {
      unlink(public_path() . '/images/' . $article->image);
      $fileName = time().rand(10000,99999).'.'.$request->file('image')->getClientOriginalExtension();
      $request->file('image')->move(public_path() . '/images/', $fileName);
    } else {
      $fileName = $article->image;
    }

    $article->update([
      'title' => $title,
      'contents' => $contents,
      'image' => $fileName,
      'hub_id' => $hub
    ]);

    return redirect(route('article', $article));

  }

  public function destroy(Article $article)
  {

    $article->delete();
    return redirect(route('articles'));

  }
}
