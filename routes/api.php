<?php

use App\Models\Schedule;
use App\Models\Master;
use App\Models\Post;
use App\Models\Workshop;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\API\AuthController;
use Illuminate\Support\Facades\Auth;

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

Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
 });
 
Route::post('/register', [AuthController::class, 'register']);
Route::post('/login', [AuthController::class, 'login']);

Route::get('/schedules', function () {
    $schedules = Schedule::with(['users', 'master'])
    ->where('start_date', '>=', Carbon\Carbon::now())
    ->orderBy('start_date','ASC')
    ->get();

    $authUser = auth()->guard('api')->user();

    foreach ($schedules as $schedule) {
        if (!$authUser || !$schedule->users->count()) {
            $schedule['is_assigned'] = false;
        } else {
            foreach ($schedule->users as $user) {
                if ($user->id === $authUser->id) {
                    $schedule['is_assigned'] = true;
                }
            }
        }

        $schedule['current_count_members'] = $schedule->users->count();

        unset($schedule->users);
    }

    return $schedules;
});

Route::get('/user-schedules', function () {
    $authUser = auth()->guard('api')->user();

    if (!$authUser) {
        return response()->json();
    }

    $schedules = Schedule::with('master')
        ->join('user_schedule', 'schedule_id', '=', 'schedules.id')
        ->where('user_id', '=', $authUser->id)
        ->orderBy('start_date', 'asc')
        ->get();
        
    // return response()->json($authUser->schedules->values());
    return response()->json($schedules);
});

Route::get('/masters', function () {
    return Master::get();
});

Route::get('/workshops', function() {
    return Workshop::get();
});

Route::get('/posts', function() {
    return Post::orderBy('created_at','DESC')->get();
});

Route::delete('/post/{id}', function(int $id, Request $request){
    $post = Post::find($id);

    if ($post) {
        $post->delete();
    }

    return response()->json();
});


Route::delete('/master/{id}', function(int $id, Request $request){
    $master = Master::find($id);

    if ($master) {
        $master->delete();
    }

    return response()->json();
});

Route::delete('/schedule/{id}', function(int $id, Request $request){
    $schedule = Schedule::find($id);

    if ($schedule) {
        $schedule->delete();
    }

    return response()->json();
});


Route::post('/posts', function (Request $request) {
    $post = Post::create([
        'title' => $request->input('title'),
        'text' => $request->input('text'),
        'start_date' => Carbon\Carbon::parse($request->input('start_date')),
    ]);

    if ($request->hasFile('image')) {
        $path = $request->image->storeAs("images/posts/{$post->id}", Str::uuid() . '.' .$request->image->getClientOriginalExtension());

        $post->update([
            'image' => $path
        ]);
    }

    $data = [
        'success' => true,
        'post' => $post
    ];

    return response()->json($data);
});

Route::post('/schedules', function (Request $request) {
    $schedule = Schedule::create([
        'title' => $request->input('title'),
        'description' => $request->input('description'),
        'start_date' => Carbon\Carbon::parse($request->input('start_date')),
        'end_date' => Carbon\Carbon::parse($request->input('end_date')),
        'max_count_members' => $request->input('max_count_members'),
        'master_id' => $request->input('master_id'),
        'price' => $request->input('price'),
    ]);
});

Route::post('/masters', function (Request $request) {
    $master = Master::create([
        'name' => $request->input('name'),
        'profession' => $request->input('profession'),
    ]);

    if ($request->hasFile('image')) {
        $path = $request->image->storeAs("images/masters/{$master->id}", Str::uuid() . '.' .$request->image->getClientOriginalExtension());

        $master->update([
            'image' => $path
        ]);        
    }
    
    $data = [
        'success' => true,
        'master' => $master
    ];

    return response()->json($data);
});

Route::middleware('auth:api')->post('schedules/{id}/assign', function (int $id, Request $request) {
    $userId = $request->user()->id ?? null;

    $schedule = Schedule::findOrFail($id);

    $schedule->users()->attach($userId);

    return response()->json();
});

Route::middleware('auth:api')->post('schedules/{id}/unassign', function (int $id, Request $request) {
    $userId = $request->user()->id ?? null;

    $schedule = Schedule::findOrFail($id);

    $schedule->users()->detach($userId);

    return response()->json();
});