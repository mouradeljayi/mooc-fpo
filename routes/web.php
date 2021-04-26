<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\ModuleController;
use App\Http\Controllers\ChapterController;
use App\Http\Controllers\WorkController;
use App\Http\Controllers\ExamController;
use App\Http\Controllers\ReponseController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\ProfessorController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\DiscussionController;
use App\Http\Controllers\ReplyController;
use App\Http\Controllers\FiliereController;

/* ****************************************** */


Route::get('/', [HomeController::class, 'welcome'])->name('welcome')->middleware(['guest', 'guest:professor', 'guest:admin']);
Route::get('/authentication', [HomeController::class, 'authentication'])->name('authentication')->middleware(['guest', 'guest:professor', 'guest:admin']);
Route::get('/studentHome', [HomeController::class, 'studentHome'])->name('studentHome')->middleware('auth');
Route::get('/profHome', [HomeController::class, 'profHome'])->name('profHome')->middleware('auth:professor');

Route::post('/student/login', [AuthController::class, 'studentLogin'])->name('studentLogin');
Route::get('/student/logout', [AuthController::class, 'studentLogout'])->middleware('auth')->name('studentLogout');

Route::post('/prof/login', [AuthController::class, 'profLogin'])->name('profLogin');
Route::get('/prof/logout', [AuthController::class, 'profLogout'])->middleware('auth:professor')->name('profLogout');

Route::resource('modules', ModuleController::class);
Route::resource('chapters', ChapterController::class);
Route::resource('works', WorkController::class);
Route::resource('exams', ExamController::class);
Route::resource('reponses', ReponseController::class);
Route::resource('professors', ProfessorController::class);
Route::resource('filieres', FiliereController::class);
Route::resource('discussions', DiscussionController::class);
Route::resource('discussions/{discussion}/replies', ReplyController::class);

Route::get('/notifications', [UserController::class, 'notifications'])->name('users.notifications');
Route::get('/user/profile', [UserController::class, 'profile'])->name('users.profile');
Route::post('/users/create', [UserController::class, 'create'])->name('users.create');
Route::get('/users/{user}/edit', [UserController::class, 'edit'])->name('users.edit');
Route::put('/users/{user}/update', [UserController::class, 'update'])->name('users.update');
Route::delete('/users/{user}/delete', [UserController::class, 'destroy'])->name('users.destroy');

Route::put('/user/profile/update', [UserController::class, 'updateProfile'])->name('users.updateProfile');
Route::get('/profs/notifications', [ProfessorController::class, 'notifications'])->name('profs.notifications');
Route::get('/prof/profile', [ProfessorController::class, 'profile'])->name('profs.profile');
Route::put('/prof/profile/update', [ProfessorController::class, 'updateProfile'])->name('profs.updateProfile');

// ADMINS ROUTES
Route::get('/admin', [AdminController::class, 'loginForm'])->name('admin.loginForm')->middleware(['guest', 'guest:admin', 'guest:professor']);
Route::get('/dashboard', [AdminController::class, 'dashboard'])->name('admin.dashboard');
Route::post('/admin/login', [AdminController::class, 'login'])->name('admin.login');
Route::get('/admin/logout', [AdminController::class, 'logout'])->name('admin.logout');

Route::get('/users', [AdminController::class, 'users'])->name('admin.users');
Route::get('/profs', [AdminController::class, 'profs'])->name('admin.profs');
Route::get('/filieres', [AdminController::class, 'filieres'])->name('admin.filieres');
Route::get('/modules', [AdminController::class, 'modules'])->name('admin.modules');

Route::get('/users/search', [AdminController::class, 'users'])->name('users.search');
Route::get('/module/search', [AdminController::class, 'modules'])->name('modules.search');
Route::get('/profs/search', [AdminController::class, 'profs'])->name('profs.search');
Route::get('/filiere/search', [AdminController::class, 'filieres'])->name('filieres.search');
