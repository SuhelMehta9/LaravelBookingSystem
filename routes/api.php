<?php

Route::group(['prefix' => 'v1', 'as' => 'api.', 'namespace' => 'Api\V1\Admin', 'middleware' => ['auth:api']], function () {
    // Permissions
    Route::apiResource('permissions', 'PermissionsApiController');

    // Roles
    Route::apiResource('roles', 'RolesApiController');

    // Users
    Route::apiResource('users', 'UsersApiController');

    // Locations
    Route::apiResource('locations', 'LocationApiController');

    // Workinghours
    Route::apiResource('working-hours', 'WorkingHoursApiController');

    // Bookings
    Route::apiResource('bookings', 'BookingApiController');
});
