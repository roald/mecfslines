<?php

use Illuminate\Support\Facades\Route;

use App\Http\Controllers\Auth\InvitedUserController;
use App\Http\Controllers\ActionController;
use App\Http\Controllers\BlockController;
use App\Http\Controllers\CommentController;
use App\Http\Controllers\EventController;
use App\Http\Controllers\FormController;
use App\Http\Controllers\MediaController;
use App\Http\Controllers\MembershipController;
use App\Http\Controllers\MultimediaController;
use App\Http\Controllers\OrderController;
use App\Http\Controllers\PageController;
use App\Http\Controllers\PaymentController;
use App\Http\Controllers\PersonController;
use App\Http\Controllers\PostController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\ProjectController;
use App\Http\Controllers\RosterController;
use App\Http\Controllers\SubscriptionController;
use App\Http\Controllers\TagController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\WebhookController;
use App\Http\Controllers\WebsiteController;

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

Route::get('/', [WebsiteController::class, 'homepage'])->name('web.home');
Route::get('page/{page:slug}', [WebsiteController::class, 'page'])->name('web.page');
Route::get('event/{event:slug}', [WebsiteController::class, 'event'])->name('web.event');
Route::get('person/{person:slug}', [WebsiteController::class, 'person'])->name('web.person');
Route::get('post/{post:slug}', [WebsiteController::class, 'post'])->name('web.post');
Route::get('product/{product:slug}', [WebsiteController::class, 'product'])->name('web.product');
Route::get('project/{project:slug}', [WebsiteController::class, 'project'])->name('web.project');
Route::get('tag/{tag:slug}', [WebsiteController::class, 'tag'])->name('web.tag');

Route::post('page/{page:slug}/contact', [FormController::class, 'contact'])->name('form.contact');

Route::prefix('my')->middleware(['auth'])->group(function () {
    Route::get('orders', [OrderController::class, 'mine'])->name('orders.mine');
    Route::get('orders/{order}', [OrderController::class, 'detail'])->name('orders.detail');
    Route::get('orders/{order}/pay', [OrderController::class, 'pay'])->name('orders.pay');
});

Route::prefix('admin')->middleware(['auth.admin', 'verified'])->group(function () {
    Route::redirect('/', '/admin/dashboard')->name('admin');
    Route::get('/dashboard', function () { return view('dashboard'); })->name('dashboard');

    Route::get('pages/{page}/remove', [PageController::class, 'remove'])->name('pages.remove');
    Route::resource('pages', PageController::class);
    Route::post('blocks/{block}/embed', [BlockController::class, 'embed'])->name('blocks.embed');
    Route::get('blocks/{block}/remove', [BlockController::class, 'remove'])->name('blocks.remove');
    Route::any('blocks/{block}/tagging', [BlockController::class, 'tagging'])->name('blocks.tagging');
    Route::post('blocks/{block}/upload', [BlockController::class, 'upload'])->name('blocks.upload');
    Route::resource('pages.blocks', BlockController::class)->shallow();
    Route::resource('blocks.actions', ActionController::class)->shallow();
    Route::get('comments/{comment}/remove', [CommentController::class, 'remove'])->name('comments.remove');
    Route::resource('posts.comments', CommentController::class)->shallow();
    Route::resource('media', MediaController::class)->except(['index', 'create', 'store']);

    Route::get('events/{event}/blocks/create', [EventController::class, 'createBlock'])->name('events.blocks.create');
    Route::get('events/{event}/remove', [EventController::class, 'remove'])->name('events.remove');
    Route::any('events/{event}/tagging', [EventController::class, 'tagging'])->name('events.tagging');
    Route::get('memberships/{membership}/remove', [MembershipController::class, 'remove'])->name('memberships.remove');
    Route::get('payments/{payment}/mollie', [PaymentController::class, 'mollie'])->name('payments.mollie');
    Route::get('products/{product}/blocks/create', [ProductController::class, 'createBlock'])->name('products.blocks.create');
    Route::any('products/{product}/tagging', [ProductController::class, 'tagging'])->name('products.tagging');
    Route::get('products/{product}/remove', [ProductController::class, 'remove'])->name('products.remove');
    Route::get('people/{person}/blocks/create', [PersonController::class, 'createBlock'])->name('people.blocks.create');
    Route::get('people/{person}/remove', [PersonController::class, 'remove'])->name('people.remove');
    Route::any('people/{person}/tagging', [PersonController::class, 'tagging'])->name('people.tagging');
    Route::get('posts/{post}/blocks/create', [PostController::class, 'createBlock'])->name('posts.blocks.create');
    Route::get('posts/{post}/remove', [PostController::class, 'remove'])->name('posts.remove');
    Route::any('posts/{post}/tagging', [PostController::class, 'tagging'])->name('posts.tagging');
    Route::get('projects/{project}/blocks/create', [ProjectController::class, 'createBlock'])->name('projects.blocks.create');
    Route::get('projects/{project}/remove', [ProjectController::class, 'remove'])->name('projects.remove');
    Route::any('projects/{project}/tagging', [ProjectController::class, 'tagging'])->name('projects.tagging');
    Route::get('rosters/{roster}/remove', [RosterController::class, 'remove'])->name('rosters.remove');
    Route::get('users/{user}/orders/create', [OrderController::class, 'create'])->name('users.orders.create');
    Route::post('users/{user}/orders', [OrderController::class, 'store'])->name('users.orders.store');
    Route::get('users/{user}/reinvite', [UserController::class, 'reinvite'])->name('users.reinvite');
    Route::get('users/{user}/remove', [UserController::class, 'remove'])->name('users.remove');
    Route::resources([
        'events' => EventController::class,
        'memberships' => MembershipController::class,
        'people' => PersonController::class,
        'posts' => PostController::class,
        'products' => ProductController::class,
        'projects' => ProjectController::class,
        'rosters' => RosterController::class,
        'tags' => TagController::class,
        'users' => UserController::class
    ]);
    Route::get('multimedia/{multimedia}/stream', [MultimediaController::class, 'stream'])->name('multimedia.stream');
    Route::resource('multimedia', MultimediaController::class)->except(['index', 'create', 'store']);
    Route::get('orders/{order}/calculate', [OrderController::class, 'calculate'])->name('orders.calculate');
    Route::get('orders/{order}/remove', [OrderController::class, 'remove'])->name('orders.remove');
    Route::resource('orders', OrderController::class)->except(['create']);
    Route::resource('subscriptions', SubscriptionController::class)->only(['show', 'edit', 'update']);
    Route::get('payments/{payment}/refresh', [PaymentController::class, 'refresh'])->name('payments.refresh');
    Route::resource('orders.payments', PaymentController::class)->shallow()->only(['index', 'show']);
});

Route::any('webhooks/mollie', [WebhookController::class, 'mollie'])->name('webhooks.mollie');

Route::get('/invitation/accept', [InvitedUserController::class, 'edit'])->middleware('guest', 'signed')->name('invitation.accept');
Route::post('/invitation/accept', [InvitedUserController::class, 'update'])->middleware('guest', 'signed');

require __DIR__.'/auth.php';
