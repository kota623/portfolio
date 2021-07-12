<?php

namespace Tests\Feature;

use App\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;
// TestCaseクラスを継承したクラスでRefreshDatabaseトレイトを使用すると、データベースをリセットします。
class ArticleControllerTest extends TestCase
{
  use RefreshDatabase;

  //indexにアクセス
  public function testIndex()
  {
    $response = $this->get(route('articles.index'));
    //200であればテストに合格、200以外であればテストに不合格
    $response->assertStatus(200)
      ->assertViewIs('articles.index');
  }
  //未ログイン
  public function testGuestCreate()
  {
    $response = $this->get(route('articles.create'));
    //assertRedirectメソッドでは、引数として渡したURLにリダイレクトされたかどうかをテストします。
    $response->assertRedirect(route('login'));
  }

  public function testAuthCreate()
  {
    // テストに必要なUserモデルを「準備」
    //factory(User::class)->create()とすることで、ファクトリによって生成されたUserモデルがデータベースに保存されます。
    $user = factory(User::class)->create();
    //actingAsメソッドは、引数として渡したUserモデルにてログインした状態を作り出します。

    // ログインして記事投稿画面にアクセスすることを「実行」
    $response = $this->actingAs($user)
      //ログイン状態でarticles.createへアクセス
      ->get(route('articles.create'));

    // レスポンスを「検証」
    $response->assertStatus(200)
      ->assertViewIs('articles.create');
  }
}
