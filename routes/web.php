<?php

use App\Http\Controllers\ProfilesController;
use App\Models\Profile;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    $profiles = Profile::all();
    return view('welcome')
        ->with("profiles", $profiles);
});

Route::controller(ProfilesController::class)
    ->group(function(){
        Route::get("profiles", "index")->name("profiles.index");
        Route::get("profiles/create", "create")->name("profiles.create");
        Route::post("profiles/store", "store")->name("profiles.store");
        Route::get("profiles/{profile}", "getProfile")->name("profiles.show");
        Route::put("profiles/update/{profile}", "update")->name("profiles.update");

        // as intructed on document
        Route::get("profile/{profile}", "getProfile")->name("profile.show");
    });
