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
Route::get('admin/topic/info','Admin\TopicController@info');
Route::any('admin/article/article_detail','Admin\ArticleController@article_detail');
Route::any('admin/category/category_format','Admin\CategoryController@category_format');
Route::any('admin/article/ai_article','Admin\ArticleController@ai_article');
Route::any('admin/article/cursor_img','Admin\ArticleController@cursor_img');
Route::any('admin/article/ai_publish','Admin\ArticleController@ai_publish');
Route::any('admin/article/addregular','Admin\ArticleController@addregular');
Route::any('admin/article/showregular','Admin\ArticleController@showregular');
Route::any('admin/article/modifyregular','Admin\ArticleController@modifyregular');
Route::any('admin/article/article_format','Admin\ArticleController@article_format');
Route::any('/','Admin\LoginController@login');
Route::any('admin/login','Admin\LoginController@login');
Route::get('code','Admin\LoginController@code');
Route::get('jiekou','Admin\LoginController@jiekou');
Route::get('admin/confirm','Admin\ArticleController@confirm');
Route::any('admin/shenhe','Admin\ArticleController@shenhe');
Route::any('admin/article/preview','Admin\ArticleController@preview');
Route::any('admin/article/rule','Admin\ArticleController@rule');
Route::any('admin/article/undercarriage_all','Admin\ArticleController@undercarriage_all');
Route::any('admin/article/topcarriage_all','Admin\ArticleController@topcarriage_all');
Route::any('admin/article/article_recover','Admin\ArticleController@article_recover');
Route::any('admin/article/confirm_release','Admin\ArticleController@confirm_release');
Route::any('admin/article/detail','Admin\ArticleController@detail');
Route::any('admin/article/wx_detail','Admin\ArticleController@wx_detail');
Route::any('admin/activity/joinactivity','Admin\ActivityController@joinactivity');
Route::any('admin/activity/act_commentreply','Admin\ActivityController@act_commentreply');
Route::any('admin/activity/act_infogather','Admin\ActivityController@act_infogather');
Route::any('admin/activity/info','Admin\ActivityController@info');
Route::any('admin/activity/act_id','Admin\ActivityController@act_id');
Route::any("admin/activity/curlGet","Admin\ActivityController@curlGet");
Route::any('admin/activity/act_ids','Admin\ActivityController@act_ids');
Route::get('admin/index/modify','Admin\IndexController@modify');
Route::get('admin/index/nums','Admin\IndexController@nums');
Route::get('admin/index/get_grant','Admin\IndexController@get_grant');
Route::get('admin/index/totalviews','Admin\IndexController@totalviews');
Route::get('admin/category/off_category','Admin\CategoryController@off_category');
Route::get('admin/category/recover_category','Admin\CategoryController@recover_category');
Route::get('admin/index/article_piechart','Admin\IndexController@article_piechart');


Route::any("admin/pingguo/index","Admin\PingguoController@index");
Route::any("admin/pingguo/apple_box","Admin\PingguoController@apple_box");
Route::any("admin/pingguo/water","Admin\PingguoController@water");
Route::any("admin/pingguo/helpindex","Admin\PingguoController@helpIndex");
Route::any("admin/pingguo/filladdress","Admin\PingguoController@fillAddress");
Route::any("admin/pingguo/showaddr","Admin\PingguoController@showAddr");
Route::any("admin/pingguo/showwaterlist","Admin\PingguoController@showwaterLIst");
Route::any("admin/pingguo/hehe","Admin\PingguoController@hehe");
Route::any("admin/pingguo/addresslist","Admin\PingguoController@addresslist");
Route::any("admin/pingguo/waterlist","Admin\PingguoController@waterlist");
Route::any("admin/pingguo/watersearch","Admin\PingguoController@water_search");



Route::any("admin/wx/getopenid","Admin\WxController@getopenid");
Route::any("admin/wx/get_accesstoken","Admin\WxController@get_accesstoken");
Route::any("admin/wx/collect","Admin\WxController@collect");
Route::any("admin/wx/showcollect","Admin\WxController@showcollect");
Route::any("admin/wx/getuserinfo","Admin\WxController@getuserinfo");
Route::any("admin/wx/collectdell","Admin\WxController@collectdell");
Route::any("admin/wx/topic_comment","Admin\WxController@topic_comment");
Route::any("admin/wx/article_comment","Admin\WxController@article_comment");
Route::any("admin/wx/topic_commentlist","Admin\WxController@topic_commentlist");
Route::any("admin/wx/article_commentlist","Admin\WxController@article_commentlist");
Route::any("admin/wx/back","Admin\WxController@back");
Route::any("admin/wx/thumb","Admin\WxController@thumb");
Route::any("admin/wx/act_comment","Admin\WxController@act_comment");
Route::any("admin/wx/act_commentlist","Admin\WxController@act_commentlist");
Route::any("admin/wx/my_activities","Admin\WxController@my_activities");
Route::any("admin/wx/usersave","Admin\WxController@usersave");
Route::any("admin/wx/pieces","Admin\WxController@pieces");
Route::any("admin/wx/pwd_modify","Admin\WxController@pwd_modify");
Route::any("admin/wx/original_article","Admin\WxController@original_article");
Route::any("admin/wx/update_message","Admin\WxController@update_message");



Route::any("admin/user/date","Admin\UserController@date");
Route::any("admin/user/pieces","Admin\UserController@pieces");
Route::any("admin/user/fill","Admin\UserController@fill");
Route::any("admin/user/user_piechart","Admin\UserController@user_piechart");
Route::any("admin/user/area_barchart","Admin\UserController@area_barchart");
Route::any("admin/user/run_chart","Admin\UserController@run_chart");

Route::any("admin/message/system_msg","Admin\MessageController@system_msg");
Route::any("admin/manager/menus","Admin\ManagerController@menus");
Route::any("admin/manager/add_pmenus","Admin\ManagerController@add_pmenus");
Route::any("admin/manager/add_cmenus","Admin\ManagerController@add_cmenus");
Route::any("admin/manager/showgrant","Admin\ManagerController@showgrant");
Route::any("admin/manager/editmenus","Admin\ManagerController@editmenus");
Route::any("admin/manager/grantlist","Admin\ManagerController@grantlist");

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
    Route::resource('message','MessageController');
    Route::resource('user','UserController');
    Route::any('upload','ActivityController@uploadvideo');
    //Route::any('stoptopic','TopicController@stoptopic');
    //Route::any('cancelactivity','ActivityController@cancelactivity');


});
