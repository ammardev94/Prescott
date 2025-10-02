<?php

use Illuminate\Support\Facades\Route;

use App\Http\Controllers\Admin\TeamController;
use App\Http\Controllers\Admin\NewsController;
use App\Http\Controllers\Admin\AuthController;
use App\Http\Controllers\Admin\PageController;
use App\Http\Controllers\Admin\ServiceController;
use App\Http\Controllers\Admin\ProfileController;
use App\Http\Controllers\Admin\PartnerController;
use App\Http\Controllers\Admin\SeoPageController;
use App\Http\Controllers\Admin\PageMetaController;
use App\Http\Controllers\Admin\SeoScriptController;
use App\Http\Controllers\Admin\PortfolioController;
use App\Http\Controllers\Admin\DashboardController;
use App\Http\Controllers\Admin\NotificationController;

Route::group(['prefix' => 'admin'], function () {

    Route::get('/login', [AuthController::class, 'login'])->name('admin.login');
    Route::post('/login', [AuthController::class, 'login_attempt'])->name('admin.login.attempt');
    Route::get('/forgot-password', [AuthController::class, 'forgot_password'])->name('admin.forgot.password');
    Route::post('/forgot-password', [AuthController::class, 'forgot_password_attempt'])->name('admin.forgot.password.attempt');
    Route::get('/reset-password/{token}', [AuthController::class, 'reset_password'])->name('admin.reset.password');
    Route::post('/reset-password', [AuthController::class, 'reset_password_attempt'])->name('admin.reset.password.attempt'); 

    Route::group(['middleware'    => 'roleAuth:admin'], function () {

        Route::get('/', [DashboardController::class, 'index'])->name('admin.dashboard');
        Route::post('/logout', [AuthController::class, 'logout'])->name('admin.logout');

        Route::get('/profile', [ProfileController::class, 'index'])->name('admin.profile.index');
        Route::put('/profile', [ProfileController::class, 'update'])->name('admin.profile.update');
        
        Route::get('/notification', [NotificationController::class, 'index'])->name('admin.notification.index');
        Route::get('/notification/read-all', [NotificationController::class, 'markAllAsRead'])->name('admin.notification.mark-all-read');
        Route::get('/notification/delete-all', [NotificationController::class, 'deleteAll'])->name('admin.notification.delete-all');
        Route::get('/notification/{id}/delete', [NotificationController::class, 'delete'])->name('admin.notification.delete');


        Route::group(['prefix' => 'cms'], function () {

            Route::get('/pages', [PageController::class, 'index'])->name('cms.page.index');
            Route::get('/pages/create', [PageController::class, 'create'])->name('cms.page.create');
            Route::post('/pages/store', [PageController::class, 'store'])->name('cms.page.store');
            Route::get('/pages/{id}/edit', [PageController::class, 'edit'])->name('cms.page.edit');
            Route::put('/pages/{id}/update', [PageController::class, 'update'])->name('cms.page.update');
            Route::delete('/pages/{id}/delete', [PageController::class, 'destroy'])->name('cms.page.destroy');
            Route::get('/pages/{id}/meta', [PageController::class, 'pageMetas'])->name('cms.page.meta');
            Route::patch('/pages/{id}/meta', [PageController::class, 'pageMetasUpdate'])->name('cms.page.meta.update');
            
            Route::get('/page-metas', [PageMetaController::class, 'index'])->name('cms.page_meta.index');
            Route::get('/page-metas/create', [PageMetaController::class, 'create'])->name('cms.page_meta.create');
            Route::post('/page-metas/store', [PageMetaController::class, 'store'])->name('cms.page_meta.store');
            Route::get('/page-metas/{id}/edit', [PageMetaController::class, 'edit'])->name('cms.page_meta.edit');
            Route::put('/page-metas/{id}/update', [PageMetaController::class, 'update'])->name('cms.page_meta.update');
            Route::delete('/page-metas/{id}/delete', [PageMetaController::class, 'destroy'])->name('cms.page_meta.destroy');
        });

        Route::get('/teams', [TeamController::class, 'index'])->name('admin.teams.index');
        Route::get('/teams/create', [TeamController::class, 'create'])->name('admin.teams.create');
        Route::post('/teams/store', [TeamController::class, 'store'])->name('admin.teams.store');
        Route::get('/teams/{id}/edit', [TeamController::class, 'edit'])->name('admin.teams.edit');
        Route::put('/teams/{id}/update', [TeamController::class, 'update'])->name('admin.teams.update');
        Route::delete('/teams/{id}/delete', [TeamController::class, 'destroy'])->name('admin.teams.destroy');

        Route::get('/seo-scripts/{id}/edit', [SeoScriptController::class, 'edit'])->name('admin.seo-scripts.edit');
        Route::put('/seo-scripts/{id}/update', [SeoScriptController::class, 'update'])->name('admin.seo-scripts.update');

        Route::get('/seo-pages', [SeoPageController::class, 'index'])->name('admin.seo_pages.index');
        Route::get('/seo-pages/create', [SeoPageController::class, 'create'])->name('admin.seo_pages.create');
        Route::post('/seo-pages/store', [SeoPageController::class, 'store'])->name('admin.seo_pages.store');
        Route::get('/seo-pages/{id}/edit', [SeoPageController::class, 'edit'])->name('admin.seo_pages.edit');
        Route::put('/seo-pages/{id}/update', [SeoPageController::class, 'update'])->name('admin.seo_pages.update');
        Route::delete('/seo-pages/{id}/delete', [SeoPageController::class, 'destroy'])->name('admin.seo_pages.destroy');

    });
});
