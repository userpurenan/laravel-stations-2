<?php
use App\Http\Controllers\ReservationController;
use App\Http\Controllers\ScheduleController;
use App\Http\Controllers\MovieController;
use App\Http\Controllers\ScreenController;
use App\Http\Controllers\UserController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\PracticeController;

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

// Route::get('URL', [Controllerの名前::class, 'Controller内のfunction名']);
Route::get('/practice', [PracticeController::class, 'sample']);
Route::get('/practice2', [PracticeController::class, 'sample2']);
Route::get('/practice3', [PracticeController::class, 'sample3']);
Route::get('/getPractice', [PracticeController::class, 'getPractice']);


    Route::middleware(['auth'])->group(function () //ログインユーザーしかアクセスできない
    {
        Route::get('/movies/{movie_id}/schedules/{schedule_id}/sheets', [ReservationController::class , 'get_sheet'])
                    ->name('movie.get_sheet');     //座席選択画面表示

        Route::get('/movies/{movie_id}/schedules/{schedule_id}/reservations/create', [ReservationController::class , 'reserve'])
                    ->name('create.reserve');     //予約画面表示
    });



// ↓これより下は映画一覧の処理

Route::get('/sheets', [MovieController::class, 'sheet'])->name('movies.sheet'); //座席一覧表示

Route::get('/user/movies', [MovieController::class, 'UserIndex'])->name('movies');   //映画検索一覧表示

Route::get('/admin/movies/genre', [MovieController::class, 'genreView'])->name('movies.genre');   //ジャンル一覧表示

Route::get('/admin/movies', [MovieController::class, 'AdminIndex'])->name('movies.index');   //映画一覧表示

Route::get('/admin/movies/create', [MovieController::class , 'create'])->name('admin.movies.create');   //登録画面表示

Route::post('/admin/movies/store', [MovieController::class , 'store'])->name('admin.movies.store');     //登録処理呼出し

Route::get('/admin/movies/{id}/edit', [MovieController::class , 'edit'])->name('movies.edit');   //編集用画面表示

Route::patch('/admin/movies/{id}/update', [MovieController::class , 'update'])->name('movies.update');  //更新処理呼出し

Route::delete('/admin/movies/{id}/destroy', [MovieController::class , 'delete'])->name('movies.delete'); //削除処理呼出し

Route::get('/search/movies', [MovieController::class, 'search'])->name('movies.search');       //検索処理呼出し


// ↓これより下はスケジュール処理
Route::get('/schedules', [ScheduleController::class, 'scheduleShow'])->name('movies.scheduleShow');       //スケジュール画面表示

Route::get('/movies/{id}', [ScheduleController::class, 'detail'])->name('movies.detail');       //詳細画面表示

Route::get('/user/movies/{id}', [ScheduleController::class, 'UserDetail'])->name('users.detail');       //ユーザー詳細画面表示

Route::get('/admin/movies/{movie_id}', [ScheduleController::class, 'detailer'])->name('movies.detailer');       //詳細管理画面表示

Route::get('/admin/schedules', [ScheduleController::class, 'schedule'])->name('movies.schedule');       //スケジュール画面表示

Route::get('/admin/movies/{movie_id}/schedules/create', [ScheduleController::class, 'CreateSchedule'])->name('movies.CreateSchedule');     //スケジュール作成画面表示

Route::post('/admin/movies/{movie_id}/schedules/store', [ScheduleController::class , 'Schedulestore'])->name('admin.schedules.store');     //スケジュール登録処理呼出し

Route::get('/admin/schedules/{scheduleId}/edit', [ScheduleController::class , 'ScheduleUpdateform'])->name('admin.schedulesUpdate.form');     //スケジュール更新画面表示

Route::patch('/admin/schedules/{scheduleId}/update', [ScheduleController::class , 'ScheduleUpdate'])->name('schedules.update');  //スケジュール更新処理呼出し

Route::get('/admin/schedules/{id}', [ScheduleController::class , 'ScheduleShow'])->name('admin.schedule.show');     //スケジュール一覧表示

Route::delete('/admin/schedules/{id}/destroy', [ScheduleController::class , 'deleteSchedule'])->name('schedules.delete'); //スケジュール削除処理呼出し


//　↓これより下は予約処理
Route::get('/reservations', [ReservationController::class , 'showreserver'])->name('reserver');     //ユーザー予約一覧画面表示

Route::post('/reservations/store', [ReservationController::class , 'reserve_store'])->name('reserve.store');     //予約登録処理呼出し

Route::get('/admin/reservations', [ReservationController::class , 'reserverShow'])->name('reservation');     //管理者予約一覧画面表示

Route::get('/admin/reservations/create', [ReservationController::class , 'CreateReserver'])->name('create.reservation');     //予約追加画面表示

Route::post('/admin/reservations/store', [ReservationController::class , 'StoreReserver'])->name('admin.reserve.store');     //予約追加処理呼出し

Route::get('/admin/reservations/{id}/edit', [ReservationController::class , 'EditReserver'])->name('admin.edit.reservation');     //予約編集画面表示

Route::patch('/admin/reservations/{id}', [ReservationController::class , 'UpdateReserver'])->name('admin.reserve.update');  //予約更新処理呼出し

Route::delete('/admin/reservations/{id}', [ReservationController::class , 'deleteReserver'])->name('reserver.delete'); //予約削除処理呼出し


// ↓これより下はスクリーン処理
Route::get('/screens', [ScreenController::class , 'ShowScreen'])->name('screen');     //現在公開中の映画表示


//↓これより下はユーザー登録処理
Route::get('/users/create', [UserController::class , 'create'])->name('register');     //ユーザー登録画面表示
Route::post('/users/store', [UserController::class, 'store'])->name('register.store');        //ユーザー登録処理

Route::get('/user/login', [UserController::class, 'CreateLogin'])->name('login');
Route::post('/user/login/store', [UserController::class, 'StoreLogin'])->name('login.store');

Route::get('/aaa' , [ScheduleController::class , 'ScheduleMovie'])->name('schedu'); //スケジュール削除処理呼出し)


Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth'])->name('dashboard');

require __DIR__.'/auth.php';
