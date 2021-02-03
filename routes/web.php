<?php

use Illuminate\Support\Facades\Route;

use App\Http\Controllers\ActionController;
use App\Http\Controllers\BlockController;
use App\Http\Controllers\EventController;
use App\Http\Controllers\MediaController;
use App\Http\Controllers\MembershipController;
use App\Http\Controllers\OrderController;
use App\Http\Controllers\PageController;
use App\Http\Controllers\PaymentController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\SubscriptionController;
use App\Http\Controllers\TagController;
use App\Http\Controllers\UserController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth'])->name('dashboard');


Route::prefix('admin')->middleware(['verified', 'auth.admin'])->group(function () {
    Route::get('pages/{page}/remove', [PageController::class, 'remove'])->name('pages.remove');
    Route::resource('pages', PageController::class);
    Route::get('blocks/{block}/remove', [BlockController::class, 'remove'])->name('blocks.remove');
    Route::any('blocks/{block}/tagging', [BlockController::class, 'tagging'])->name('blocks.tagging');
    Route::post('blocks/{block}/upload', [BlockController::class, 'upload'])->name('blocks.upload');
    Route::resource('pages.blocks', BlockController::class)->shallow();
    Route::resource('blocks.actions', ActionController::class)->shallow();
    Route::resource('media', MediaController::class)->except(['index', 'create', 'store']);

    Route::get('events/{event}/blocks/create', [EventController::class, 'createBlock'])->name('events.blocks.create');
    Route::get('events/{event}/remove', [EventController::class, 'remove'])->name('events.remove');
    Route::any('events/{event}/tagging', [EventController::class, 'tagging'])->name('events.tagging');
    Route::get('memberships/{membership}/remove', [MembershipController::class, 'remove'])->name('memberships.remove');
    Route::any('products/{product}/tagging', [ProductController::class, 'tagging'])->name('products.tagging');
    Route::get('products/{product}/remove', [ProductController::class, 'remove'])->name('products.remove');
    Route::get('users/{user}/remove', [UserController::class, 'remove'])->name('users.remove');
    Route::resources([
        'events' => EventController::class,
        'memberships' => MembershipController::class,
        'orders' => OrderController::class,
        'products' => ProductController::class,
        'tags' => TagController::class,
        'subscriptions' => SubscriptionController::class,
        'users' => UserController::class
    ]);
    Route::resource('orders.payments', PaymentController::class)->shallow();
});

require __DIR__.'/auth.php';
