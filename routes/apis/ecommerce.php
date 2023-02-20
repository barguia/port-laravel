<?php

use App\Http\Controllers\Ecommerce\CtlProcessController;
use App\Http\Controllers\Ecommerce\CtlProcessHierarchyController;
use App\Http\Controllers\Ecommerce\CtlProductController;
use App\Http\Controllers\Ecommerce\CtlTaskController;
use App\Http\Controllers\Ecommerce\PcoOrderController;
use App\Http\Controllers\Ecommerce\PcoTaskController;
use Illuminate\Support\Facades\Route;

Route::name('ecommerce.')->middleware(['auth:api'])->prefix('ecommerce/')->group(function () {
    Route::resource('/ctl-process-hierarchies', CtlProcessHierarchyController::class, [
        'parameters' => ['ctl-process-hierarchies' => 'hierarchy'],
        'name' => 'api.hierarchy'
    ])->except(['create', 'edit']);

    Route::resource('/ctl-process', CtlProcessController::class, [
        'parameters' => ['ctl-process' => 'process'],
        'name' => 'process'
    ])->except(['create', 'edit']);

    Route::resource('/pco-orders', PcoOrderController::class, [
        'parameters' => ['pco-orders' => 'order'],
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

    Route::get('/pco-tasks/{pco_task}/adopt', [PcoTaskController::class, 'adopt'])
        ->name('pco-task.adopt')
        ->middleware(['ecommerce.task.treatment']);

    Route::get('/pco-tasks/{pco_task}/transfer/{user}', [PcoTaskController::class, 'transfer'])
        ->name('pco-task.transfer')
        ->middleware(['ecommerce.task.treatment']);

    Route::resource('/ctl-products', CtlProductController::class, [
        'parameters' => ['ctl-products' => 'product'],
        'name' => 'product'
    ])->except(['create', 'edit']);
});
