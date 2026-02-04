<?php

use Illuminate\Support\Facades\Route;
use Modules\ACL\Http\Controllers\Frontend\RoleController;
use Modules\ACL\Http\Controllers\Frontend\PermissionController;

Route::middleware(['auth:sanctum'])->prefix('v1')->group(function () {
    Route::apiResource('roles', RoleController::class)->names('role');
    Route::apiResource('permissions', PermissionController::class)->names('permission');
});
