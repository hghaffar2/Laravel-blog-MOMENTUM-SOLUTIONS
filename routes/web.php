<?php




Route::group(['middleware' => ['role:admin|author']], function () {
    Route::post('/new/post','PostsController@create_post')->name('new_post');
    Route::post('/edit/post','PostsController@edit_post')->name('edit_post');
    Route::match(['get', 'post'],'/edit/post','PostsController@edit_post')->name('edit_post');
});


Route::group(['middleware' => ['role:admin']], function () {
    Route::get('/dashboard', 'AdminController@index')->name('admin');
    Route::post('/new-role', 'AdminController@add_new_role')->name('add_role');
    Route::post('/add-or-remove-role', 'AdminController@add_or_remove_role')->name('add_or_remove_role');
    Route::post('/remove-roles', 'AdminController@remove_roles')->name('remove_roles');
});

Route::get('/post','PostsController@index')->name('post');
Route::post('/new/comment','PostsController@create_comment')->name('new_Comment');


Route::post('/search', 'PostsController@search')->name('search');


Auth::routes();

