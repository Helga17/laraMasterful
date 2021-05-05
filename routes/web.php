<?php

use Illuminate\Support\Facades\Route;

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

Route::get('test', function() {
    $masters = \App\Models\Master::get();

    // foreach($masters as $key => $master) {
    //     return $masters;
    // }

    $schedules = \App\Models\Schedule::get();

    foreach($schedules as $key => $schedule) {
        $schedule->update([
            'start_date' => \Carbon\Carbon::parse(sprintf("2021-0%d-13 15:00", $key + 6)),
            'start_end' => \Carbon\Carbon::parse(sprintf("2021-0%d-13 18:00", $key + 6)),
            'master_id' => $masters->random()->id
        ]);
    }
});

Route::get('masters', function () {
    dd(123);
    return \App\Models\Master::get();
});