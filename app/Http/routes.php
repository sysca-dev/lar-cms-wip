<?php

/*
|--------------------------------------------------------------------------
| Routes File
|--------------------------------------------------------------------------
|
| Here is where you will register all of the routes in an application.
| It's a breeze. Simply tell Laravel the URIs it should respond to
| and give it the controller to call when that URI is requested.
|
*/

/*
|--------------------------------------------------------------------------
| Application Routes
|--------------------------------------------------------------------------
|
| This route group applies the "web" middleware group to every route
| it contains. The "web" middleware group is defined in your HTTP
| kernel and includes session state, CSRF protection, and more.
|
*/
/* @todo Authentication with the Permissions system for required routes */

Route::group(['middleware' => ['web']], function () {
  Route::group(['middleware' => ['auth']], function () {
    /* User */
    Route::get('/user/settings', 'ProfileController@edit')->name('user-settings');
    Route::patch('/user/settings', 'ProfileController@update')->name('user-settings-update');

    /* Messages */
    Route::get('/user/messages', 'MessageController@index')->name('user-messages');

    /* Articles */
    Route::group(['middleware' => ['permission:create-articles']], function(){
      Route::get('/article/create', 'ArticleController@create')->name('article-create');
      Route::post('/article/create', 'ArticleController@store')->name('article-store');
    });
    Route::group(['middleware' => ['permission:edit-articles']], function(){
      Route::get('/article/{article}/edit', 'ArticleController@edit')->name('article-edit');
      Route::patch('/article/{article}/edit', 'ArticleController@update')->name('article-update');
    });
    Route::group(['middleware' => ['permission:delete-articles']], function(){
      Route::delete('/article/{article}', 'ArticleController@destroy')->name('article-destroy');
    });

    /* Events */
    Route::group(['middleware' => ['permission:create-events']], function(){
      Route::get('/event/create', 'EventController@create')->name('event-create');
      Route::post('/event/create', 'EventController@store')->name('event-store');
    });
    Route::group(['middleware' => ['permission:edit-events']], function(){
      Route::get('/event/{event}/edit', 'EventController@edit')->name('event-edit');
      Route::patch('/event/{event}/edit', 'EventController@update')->name('event-update');
    });
    Route::group(['middleware' => ['permission:delete-events']], function(){
      Route::delete('/event/{event}', 'EventController@destroy')->name('event-destroy');
    });

    /* Hubs */
    Route::group(['middleware' => ['permission:create-hubs']], function(){
      Route::get('/hub/create', 'HubController@create')->name('hub-create');
      Route::post('/hub/create', 'HubController@store')->name('hub-store');
    });
    Route::group(['middleware' => ['permission:edit-hubs']], function(){
      Route::get('/hub/{hub}/edit', 'HubController@edit')->name('hub-edit');
      Route::patch('/hub/{hub}/edit', 'HubController@update')->name('hub-update');
    });
    Route::group(['middleware' => ['permission:delete-hubs']], function(){
      Route::delete('/hub/{hub}', 'HubController@destroy')->name('hub-update');
    });
    
    /* Forum Categories */
    Route::group(['middleware' => ['permission:create-forum-categories']], function(){
      Route::get('/forum/category/create', 'Forum\CategoryController@create')->name('forum-category-create');
      Route::post('/forum/category/create', 'Forum\CategoryController@store')->name('forum-category-store');
    });
    Route::group(['middleware' => ['permission:edit-forum-categories']], function(){
      Route::get('/forum/category/{category}/edit', 'Forum\CategoryController@edit')->name('forum-category-edit');
      Route::patch('/forum/category/{category}/edit', 'Forum\CategoryController@update')->name('forum-category-update');
    });
    Route::group(['middleware' => ['permission:delete-forum-categories']], function(){
      Route::delete('/forum/category/{category}', 'Forum\CategoryController@destroy')->name('forum-category-destroy');
    });

    /* Forum Forums */
    Route::group(['middleware' => ['permission:create-forum-forums']], function(){
      Route::get('/forum/{category}/forum/create', 'Forum\ForumController@create')->name('forum-forum-create');
      Route::post('/forum/{category}/forum/create', 'Forum\ForumController@store')->name('forum-forum-store');
    });
    Route::group(['middleware' => ['permission:edit-forum-forums']], function(){
      Route::get('/forum/{forum}/edit', 'Forum\ForumController@edit')->name('forum-forum-edit');
      Route::patch('/forum/{forum}/edit', 'Forum\ForumController@update')->name('forum-forum-update');
    });
    Route::group(['middleware' => ['permission:delete-forum-forums']], function(){
      Route::delete('/forum/{forum}', 'Forum\ForumController@destroy')->name('forum-forum-destroy');
    });

    /* Forum Topics */
    Route::group(['middleware' => ['permission:create-forum-topics']], function(){
      Route::get('/forum/{forum}/topic/create', 'Forum\TopicController@create')->name('forum-topic-create');
      Route::post('/forum/{forum}/topic/create', 'Forum\TopicController@store')->name('forum-topic-store');
    });
    Route::group(['middleware' => ['permission:edit-forum-topics']], function(){
      Route::get('/forum/{forum}/{topic}/edit', 'Forum\TopicController@edit')->name('forum-topic-edit');
      Route::patch('/forum/{forum}/{topic}/edit', 'Forum\TopicController@update')->name('forum-topic-update');
    });
    Route::group(['middleware' => ['permission:delete-forum-topics']], function(){
      Route::delete('/forum/{forum}/{topic}', 'Forum\TopicController@destroy')->name('forum-topic-destroy');
    });

    /* Forum Posts */
    Route::group(['middleware' => ['permission:create-forum-posts']], function(){
      Route::get('/forum/{forum}/{topic}/reply', 'Forum\PostController@create')->name('forum-post-create');
      Route::post('/forum/{forum}/{topic}/reply', 'Forum\PostController@store')->name('forum-post-store');
    });
    Route::group(['middleware' => ['permission:edit-forum-posts']], function(){
      Route::get('/forum/{forum}/{topic}/{post}/edit', 'Forum\PostController@edit')->name('forum-post-edit');
      Route::patch('/forum/{forum}/{topic}/{post}/edit', 'Forum\PostController@update')->name('forum-post-update');
    });
    Route::group(['middleware' => ['permission:delete-forum-posts']], function(){
      Route::delete('/forum/{forum}/{topic}/{post}', 'Forum\PostController@destroy')->name('forum-post-destroy');
    });

    Route::group(['middleware' => ['role:admin']], function(){
      Route::get('/admin', 'Admin\HomeController@show')->name('admin');

      /* Admin Users */
      Route::get('/admin/users', 'Admin\UserController@index')->name('admin-user-index');
      Route::get('/admin/user/create', 'Admin\UserController@create')->name('admin-user-create');
      Route::post('/admin/user/create', 'Admin\UserController@store');
      Route::get('/admin/user/{user}/edit', 'Admin\UserController@edit')->name('admin-user-edit');
      Route::patch('/admin/user/{user}/edit', 'Admin\UserController@update');
      Route::delete('/admin/user/{user}', 'Admin\UserController@destroy')->name('admin-user-destroy');

      /* Admin Roles */
      Route::get('/admin/roles', 'Admin\RoleController@index')->name('admin-role-index');
      Route::get('/admin/role/create', 'Admin\RoleController@create')->name('admin-role-create');
      Route::post('/admin/role/create', 'Admin\RoleController@store');
      Route::get('/admin/role/{role}/edit', 'Admin\RoleController@edit')->name('admin-role-edit');
      Route::patch('/admin/role/{role}/edit', 'Admin\RoleController@update');
      Route::delete('/admin/role/{role}', 'Admin\RoleController@destroy')->name('admin-role-destroy');
    });
  });
  Route::auth();
  /* Normal Pages */
  Route::get('/', 'HomeController@show')->name('home');

  /* Users */
  Route::get('/users', 'ProfileController@index')->name('users');
  Route::get('/user/{user}', 'ProfileController@show')->name('user-show');
  Route::get('/user/{user}/articles', 'ArticleController@indexForUser')->name('user-articles');

  /* Articles */
  Route::get('/articles', 'ArticleController@index')->name('articles');
  Route::get('/article/{article}', 'ArticleController@show')->name('article-show');

  /* Events */
  Route::get('/events', 'EventController@index')->name('events');
  Route::get('/event/{event}', 'EventController@show')->name('event-show');

  /* Hubs */
  Route::get('/hubs', 'HubController@index')->name('hubs');
  Route::get('/hub/{hub}', 'HubController@show')->name('hub-show');

  /* Forum */
  Route::get('/forum', 'Forum\CategoryController@index')->name('forum-category-index');
  Route::get('/forum/{forum}', 'Forum\ForumController@show')->name('forum-forum-show');
  Route::get('/forum/{forum}/{topic}', 'Forum\TopicController@show')->name('forum-topic-show');
  Route::get('/forum/single/{post}', 'Forum\PostController@show')->name('forum-post-show');
});
