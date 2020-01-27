<?php
Auth::routes();

Route::redirect('/', '/listeCourse');
Route::redirect('/home', '/listeCourse');

Route::get('/listeCourse', 'ListeCourseController@showHome')->name('listeCourse.showHome');
Route::get('/listeCourse/{LC_List}', 'ListeCourseController@showList')->name('listeCourse.showList');

Route::get('/listeCourse/lists/public', 'ListeCourseController@getPublicLists')->name('listeCourse.getPublicLists');
Route::get('/listeCourse/lists/private', 'ListeCourseController@getPrivateLists')->name('listeCourse.getPrivateLists');
Route::get('/listeCourse/lists/user', 'ListeCourseController@getUserLists')->name('listeCourse.getUserLists');
Route::get('/listeCourse/list/{LC_List}', 'ListeCourseController@getList')->name('listeCourse.getList');
Route::post('/listeCourse/list/create', 'ListeCourseController@createList')->name('listeCourse.createList');
Route::post('/listeCourse/list/delete/{LC_List}', 'ListeCourseController@deleteList')->name('listeCourse.deleteList');
Route::post('/listeCourse/list/togglePrivacy/{LC_List}', 'ListeCourseController@toggleListPrivacy')->name('listeCourse.toggleListPrivacy');
Route::post('/listeCourse/list/{LC_List}/createArticle', 'ListeCourseController@createArticle')->name('listeCourse.createArticle');
Route::post('/listeCourse/article/delete/{LC_Article}', 'ListeCourseController@deleteArticle')->name('listeCourse.deleteArticle');
Route::post('/listeCourse/article/toggleState/{LC_Article}', 'ListeCourseController@toggleArticleState')->name('listeCourse.toggleArticleState');
