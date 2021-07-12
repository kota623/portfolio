<?php

namespace App\Http\Controllers;

use App\Article;
use App\Tag;
use App\Http\Requests\ArticleRequest;
use Illuminate\Http\Request;
use phpDocumentor\Reflection\Types\Boolean;

class ArticleController extends Controller
{
  public function __construct()
  {
    $this->authorizeResource(Article::class, 'article');
  }
  public function index()
  {
    //公開用&のみ読み込むように変更
    $articles = Article::where('public', true)->get()->sortByDesc('created_at')->load(['user', 'likes', 'tags']);
    return view('articles.index', ['articles' => $articles]);
  }

  public function create()
  {
    $allTagNames = Tag::all()->map(function ($tag) {
      return ['text' => $tag->name];
    });

    $public = config('setting.非公開');

    return view('articles.create', [
      'allTagNames' => $allTagNames,
      'public' => $public,
    ]);
  }

  public function store(ArticleRequest $request, Article $article)
  {

    $article->fill($request->all());
    $article->user_id = $request->user()->id;
    $article->save();

    $request->tags->each(function ($tagName) use ($article) {
      $tag = Tag::firstOrCreate(['name' => $tagName]);
      $article->tags()->attach($tag);
    });

    return redirect()->route('articles.index');
  }

  public function edit(Article $article)
  {
    $tagNames = $article->tags->map(function ($tag) {
      return ['text' => $tag->name];
    });

    $allTagNames = Tag::all()->map(function ($tag) {
      return ['text' => $tag->name];
    });

    $public = $article->public;


    return view('articles.edit', [
      'article' => $article,
      'tagNames' => $tagNames,
      'allTagNames' => $allTagNames,
      'public' => $public,
    ]);
  }
  public function update(ArticleRequest $request, Article $article)
  {
    $article->fill($request->all())->save();

    $article->tags()->detach();
    $request->tags->each(function ($tagName) use ($article) {
      $tag = Tag::firstOrCreate(['name' => $tagName]);
      $article->tags()->attach($tag);
    });

    return redirect()->route('articles.index');
  }
  public function destroy(Article $article)
  {
    $article->delete();
    return redirect()->route('articles.index');
  }
  public function show(Article $article)
  {
    return view('articles.show', ['article' => $article]);
  }

  public function like(Request $request, Article $article)
  {
    $article->likes()->detach($request->user()->id);
    $article->likes()->attach($request->user()->id);

    return [
      'id' => $article->id,
      'countLikes' => $article->count_likes,
    ];
  }

  public function unlike(Request $request, Article $article)
  {
    $article->likes()->detach($request->user()->id);

    return [
      'id' => $article->id,
      'countLikes' => $article->count_likes,
    ];
  }
}
