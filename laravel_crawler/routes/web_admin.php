<?php


// Login admin
Route::group(['prefix' => 'admin-auth','namespace' => 'Admin\Auth'], function() {
    Route::get('login','AdminLoginController@getLoginAdmin')->name('get.login.admin');
    Route::post('login','AdminLoginController@postLoginAdmin');

    Route::get('logout','AdminLoginController@getLogoutAdmin')->name('get.logout.admin');
});

Route::group(['prefix' => 'laravel-filemanager','middleware' => 'checkLoginAdmin'], function () {
    \UniSharp\LaravelFilemanager\Lfm::routes();
});

Route::group(['prefix' => 'admin', 'namespace' => 'Admin','middleware' => 'checkLoginAdmin'], function () {
    Route::get('','AdminController@index')->name('get_admin.admin');
    Route::group(['prefix' => 'story'], function () {
        Route::get('','AdminStoryController@index')->name('get_admin.story.index');
        Route::get('create','AdminStoryController@create')->name('get_admin.story.create');
        Route::post('create','AdminStoryController@store');
        Route::get('delete/{id}','AdminStoryController@delete')->name('get_admin.story.delete');
        Route::get('hot/{id}','AdminStoryController@hot')->name('get_admin.story.hot');
        Route::get('update/{id}','AdminStoryController@edit')->name('get_admin.story.update');
        Route::post('update/{id}','AdminStoryController@update');

        Route::get('{storyId}/chapters','AdminChapterController@index')->name('get_admin.chapter.index');
        Route::get('{storyId}/chapters/create','AdminChapterController@create')->name('get_admin.chapter.create');
        Route::post('{storyId}/chapters/create','AdminChapterController@store');
        Route::get('{storyId}/chapters/edit/{id}','AdminChapterController@edit')->name('get_admin.chapter.update');
        Route::post('{storyId}/chapters/edit/{id}','AdminChapterController@update');
        Route::get('{storyId}/chapters/delete/{id}','AdminChapterController@index')->name('get_admin.chapter.delete');
    });

    Route::group(['prefix' => 'category'], function () {
        Route::get('/','AdminCategoryController@index')->name('get_admin.category.index');
        Route::get('create','AdminCategoryController@create')->name('get_admin.category.create');
        Route::post('create','AdminCategoryController@store');

        Route::get('update/{id}','AdminCategoryController@edit')->name('get_admin.category.update');
        Route::post('update/{id}','AdminCategoryController@update');
        Route::get('delete/{id}','AdminCategoryController@delete')->name('get_admin.category.delete');
        Route::get('accept/{id}','AdminCategoryController@accept')->name('get_admin.category.accept');
        Route::get('crawler/{id}','AdminCategoryController@crawler')->name('get_admin.category.crawler');
    });

    Route::group(['prefix' => 'author'], function () {
        Route::get('/','AdminAuthorController@index')->name('get_admin.author.index');
        Route::get('create','AdminAuthorController@create')->name('get_admin.author.create');
        Route::post('create','AdminAuthorController@store');

        Route::get('update/{id}','AdminAuthorController@edit')->name('get_admin.author.update');
        Route::post('update/{id}','AdminAuthorController@update');
        Route::get('delete/{id}','AdminAuthorController@delete')->name('get_admin.author.delete');
    });
    Route::group(['prefix' => 'type'], function () {
        Route::get('','AdminTypeController@index')->name('get_admin.type.index');
    });

    Route::group(['prefix' => 'article'], function () {
        Route::get('','AdminArticleController@index')->name('get_admin.article.index');
        Route::get('create','AdminArticleController@create')->name('get_admin.article.create');
        Route::post('create','AdminArticleController@store');

        Route::get('update/{id}','AdminArticleController@edit')->name('get_admin.article.update');
        Route::post('update/{id}','AdminArticleController@update');

        Route::get('delete/{id}','AdminArticleController@delete')->name('get_admin.article.delete');

        Route::get('update/{id}','AdminArticleController@edit')->name('get_admin.article.update');
        Route::post('update/{id}','AdminArticleController@update');
    });

    Route::group(['prefix' => 'tag'], function () {
        Route::get('','AdminTagController@index')->name('get_admin.tag.index');
        Route::get('create','AdminTagController@create')->name('get_admin.tag.create');
        Route::post('create','AdminTagController@store');

        Route::get('update/{id}','AdminTagController@edit')->name('get_admin.tag.update');
        Route::post('update/{id}','AdminTagController@update');

        Route::get('delete/{id}','AdminTagController@delete')->name('get_admin.tag.delete');

        Route::get('update/{id}','AdminTagController@edit')->name('get_admin.tag.update');
        Route::post('update/{id}','AdminTagController@update');
    });

    Route::group(['prefix' => 'menu'], function () {
        Route::get('','AdminMenuController@index')->name('get_admin.menu.index');
        Route::get('create','AdminMenuController@create')->name('get_admin.menu.create');
        Route::post('create','AdminMenuController@store');

        Route::get('update/{id}','AdminMenuController@edit')->name('get_admin.menu.update');
        Route::post('update/{id}','AdminMenuController@update');

        Route::get('delete/{id}','AdminMenuController@delete')->name('get_admin.menu.delete');

        Route::get('update/{id}','AdminMenuController@edit')->name('get_admin.menu.update');
        Route::post('update/{id}','AdminMenuController@update');
    });
});
