<?php
Auth::routes();

Route::redirect('/home', '/');
Route::redirect('/listeCourse', '/listes');

Route::get('/', 'UserController@showhome')->name('user.showHome');
Route::get('/debug', 'UserController@showDebug')->name('user.showDebug');
Route::post('/settings/background', 'UserController@changeBackground')->name('user.changeBackground');
Route::post('/settings/color', 'UserController@changeColor')->name('user.changeColor');
Route::post('/settings/pincode', 'UserController@changePincode')->name('user.changePincode');

Route::get('/pincode', 'LappdlaviController@showPincode')->name('pincode.showPincode');
Route::post('/pincode', 'LappdlaviController@authUser')->name('pincode.authUser');

Route::get('/listes', 'ListeCourseController@showHome')->name('listes.showHome');
Route::get('/listes/{LC_List}', 'ListeCourseController@showList')->name('listes.showList');

Route::get('/listes/lists/public', 'ListeCourseController@getPublicLists')->name('listes.getPublicLists');
Route::get('/listes/lists/private', 'ListeCourseController@getPrivateLists')->name('listes.getPrivateLists');
Route::get('/listes/lists/user', 'ListeCourseController@getUserLists')->name('listes.getUserLists');
Route::get('/listes/list/{LC_List}', 'ListeCourseController@getList')->name('listes.getList');
Route::post('/listes/list/create', 'ListeCourseController@createList')->name('listes.createList');
Route::post('/listes/list/delete/{LC_List}', 'ListeCourseController@deleteList')->name('listes.deleteList');
Route::post('/listes/list/togglePrivacy/{LC_List}', 'ListeCourseController@toggleListPrivacy')->name('listes.toggleListPrivacy');
Route::post('/listes/list/{LC_List}/createArticle', 'ListeCourseController@createArticle')->name('listes.createArticle');
Route::post('/listes/article/delete/{LC_Article}', 'ListeCourseController@deleteArticle')->name('listes.deleteArticle');
Route::post('/listes/article/toggleState/{LC_Article}', 'ListeCourseController@toggleArticleState')->name('listes.toggleArticleState');


Route::get('/tricount', 'TricountController@showHome')->name('tricount.showHome');
Route::get('/tricount/new', 'TricountController@showCompteCreation')->name('tricount.showCompteCreation');
Route::get('/tricount/{TcCompte}', 'TricountController@showCompte')->name('tricount.showCompte');
Route::get('/tricount/{TcCompte}/stats', 'TricountController@showStats')->name('tricount.showStats');
Route::get('/tricount/{TcCompte}/new', 'TricountController@showPartageCreation')->name('tricount.showPartageCreation');
Route::get('/tricount/{TcCompte}/{TcPartage}', 'TricountController@showPartage')->name('tricount.showPartage');
Route::post('/tricount', 'TricountController@createCompte')->name('tricount.createCompte');
Route::post('/tricount/{TcCompte}', 'TricountController@createPartage')->name('tricount.createPartage');
Route::delete('/tricount/{TcCompte}', 'TricountController@deleteCompte')->name('tricount.deleteCompte');
Route::delete('/tricount/{TcCompte}/{TcPartage}', 'TricountController@deletePartage')->name('tricount.deletePartage');
