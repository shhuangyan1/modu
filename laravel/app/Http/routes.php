<?php

/*
|--------------------------------------------------------------------------
| Application Routes
|--------------------------------------------------------------------------
|
| Here is where you can register all of the routes for an application.
| It's a breeze. Simply tell Laravel the URIs it should respond to
| and give it the controller to call when that URI is requested.
|
*/


Route::get('/', function () {
    return view('admin/login');
});
Route::any('admin/activity/activity_detail','Admin\ActivityController@activity_detail');
Route::any('admin/topic/topic_detail','Admin\TopicController@topic_detail');
Route::get('admin/activity/activity_format','Admin\ActivityController@activity_format');
Route::get('admin/activity/oldactivity_format','Admin\ActivityController@oldactivity_format');
Route::get('admin/topic/topic_format','Admin\TopicController@topic_format');
Route::get('admin/topic/oldtopic_format','Admin\TopicController@oldtopic_format');
Route::any('admin/article/article_detail','Admin\ArticleController@article_detail');
Route::any('admin/category/category_format','Admin\CategoryController@category_format');
Route::any('admin/article/ai_article','Admin\ArticleController@ai_article');
Route::any('admin/article/ai_publish','Admin\ArticleController@ai_publish');
Route::any('admin/article/article_format','Admin\ArticleController@article_format');
Route::any('/','Admin\LoginController@login');
Route::any('admin/login','Admin\LoginController@login');
Route::get('code','Admin\LoginController@code');
Route::get('jiekou','Admin\LoginController@jiekou');
Route::get('admin/confirm','Admin\ArticleController@confirm');
Route::any('admin/shenhe','Admin\ArticleController@shenhe');
Route::any('admin/article/preview','Admin\ArticleController@preview');

Route::group(['middleware' => ['web','admin.login'],'prefix'=>'admin','namespace'=>'Admin'], function () {

    Route::any('article','ArticleController@article');
    Route::get('index','IndexController@index');
    Route::get('info','IndexController@info');
    Route::get('logout','LoginController@logout');
    Route::resource('category','CategoryController');
    Route::resource('article','ArticleController');
    Route::resource('topic','TopicController');
    Route::resource('activity','ActivityController');
    Route::resource('manager','ManagerController');
    Route::any('upload','ActivityController@uploadvideo');
    //Route::any('stoptopic','TopicController@stoptopic');
    //Route::any('cancelactivity','ActivityController@cancelactivity');


});
