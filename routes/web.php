<?php

use App\Http\Controllers\AttendingEventController;
use App\Http\Controllers\AttendingSystemController;
use App\Http\Controllers\DeleteCommentController;
use App\Http\Controllers\EventController;
use App\Http\Controllers\EventIndexController;
use App\Http\Controllers\GalleryController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\WelcomeController;
use App\Http\Controllers\EventShowController;
use App\Http\Controllers\GalleryIndexController;
use App\Http\Controllers\LikedEventController;
use App\Http\Controllers\LikeSystemController;
use App\Http\Controllers\LikeSystmeController;
use App\Http\Controllers\PermissionController;
use App\Http\Controllers\RoleController;
use App\Http\Controllers\SavedEventController;
use App\Http\Controllers\SavedEventSystemController;
use App\Http\Controllers\StoreCommentController;
use App\Models\Country;
use Illuminate\Support\Facades\Route;

Route::get('/', WelcomeController::class)->name('welcome');
Route::get('/e', EventIndexController::class)->name('eventIndex');
Route::get('/e/{id}', EventShowController::class)->name('eventShow');
Route::get('/gallery', GalleryIndexController::class)->name('galleryIndex');

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');

    Route::resource('/events', EventController::class);
    Route::resource('/galleries', GalleryController::class);

    Route::get('/liked-events', LikedEventController::class)->name('likedEvents');
    Route::get('/saved-events', SavedEventController::class)->name('savedEvents');
    Route::get('/attendind-events', AttendingEventController::class)->name('attendingEvents');

    Route::get('/permissions/create', [PermissionController::class, 'create'])->name('permissions.create');

    Route::post(
        '/events-like/{id}',
        LikeSystemController::class
    )->name('events.like');
    Route::post(
        '/events-saved/{id}',
        SavedEventSystemController::class
    )->name('events.saved');
    Route::post('/events-attending/{id}', AttendingSystemController::class)->name('events.attending');

    Route::post('/events/{id}/comments', StoreCommentController::class)->name('events.comments');
    Route::delete('/events/{id}/comments/{comment}', DeleteCommentController::class)->name('events.comments.destroy');
    Route::get('/countries/{country}', function (Country $country) {
        return response()->json($country->cities);
    });

    // permissions routes
    Route::get('/permissions',[PermissionController::class,'index'])->name('permission.index');
    Route::get('/permissions/create',[PermissionController::class,'create'])->name('permission.create');
    Route::post('/permissions',[PermissionController::class,'store'])->name('permission.store');
    Route::get('/permissions/{id}/edit',[PermissionController::class,'edit'])->name('permission.edit');
    Route::post('/permissions/{id}',[PermissionController::class,'update'])->name('permission.update');
    Route::delete('/permissions',[PermissionController::class,'destroy'])->name('permission.destroy');


    // roles routes
    Route::get('/roles',[RoleController::class,'index'])->name('role.index');
    Route::get('/roles/create',[RoleController::class,'create'])->name('role.create');
    Route::post('/roles',[RoleController::class,'store'])->name('role.store');
});

require __DIR__.'/auth.php';
