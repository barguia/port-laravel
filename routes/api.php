<?php

use App\Http\Controllers\Access\AclProfileController;
use App\Http\Controllers\Access\AuthController;
use App\Http\Controllers\Access\UserController;
use App\Http\Controllers\Workflow\CtlProcessController;
use App\Http\Controllers\Workflow\CtlProcessHierarchyController;
use App\Http\Controllers\Workflow\CtlTaskController;
use App\Http\Controllers\Workflow\PcoObjecjtController;
use App\Http\Controllers\Workflow\PcoTaskController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::post('/login', [AuthController::class, 'login'])->name('api.login');
Route::post('/register', [UserController::class, 'store'])->name('api.register');

Route::name('manager.')->prefix('adm/')->middleware(['auth:api'])->group(function () {
    Route::resource('/profiles', AclProfileController::class);
});


Route::middleware(['auth:api'])->group(function () {
    Route::get('/logout', [AuthController::class, 'logout'])->name('api.logout');
    Route::resource('/users', UserController::class);
});

Route::name('workflow.')->middleware(['auth:api'])->prefix('wf/')->group(function () {
    Route::resource('/ctl-process-hierarchies', CtlProcessHierarchyController::class, [
        'parameters' => ['ctl-process-hierarchies' => 'hierarchy'],
        'name' => 'api.hierarchy'
    ])->except(['create', 'edit']);

    Route::resource('/ctl-process', CtlProcessController::class, [
        'parameters' => ['ctl-process' => 'process'],
        'name' => 'process'
    ])->except(['create', 'edit']);

    Route::resource('/pco-objects', PcoObjecjtController::class, [
        'parameters' => ['pco-objects' => 'object'],
        'name' => 'object'
    ])->except(['create', 'edit', 'destroy']);

    Route::resource('/ctl-tasks', CtlTaskController::class, [
        'parameters' => ['ctl-tasks' => 'task'],
        'name' => 'ctrl-task'
    ]);

    Route::resource('/pco-tasks', PcoTaskController::class, [
        'parameters' => ['pco-tasks' => 'task'],
        'name' => 'pco-task'
    ]);

    Route::get('/pco-tasks/{pco_task_id}/adopt', [PcoTaskController::class, 'adopt'])
        ->name('pco-task.adopt');

    Route::get('/pco-tasks/{pco_task_id}/transfer/{user_id}', [PcoTaskController::class, 'transfer'])
        ->name('pco-task.transfer');
});
