<?php
Auth::routes();

Route::redirect('/', '/listes');
Route::redirect('/home', '/listes');
Route::redirect('/listeCourse', '/listes');
Route::redirect('/login', '/pincode');

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
