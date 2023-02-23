<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\TasksController;

// デフォルトのコメント部分は省略

Route::get('/', [TasksController::class, 'index']);
Route::resource('tasks', TasksController::class);

/*
// CRUD
// メッセージの個別詳細ページ表示
Route::get('tasks/{id}', [TasksController::class, 'show']);
// メッセージの新規登録を処理（新規登録画面を表示するためのものではありません）
Route::post('tasks', [TasksController::class, 'store']);
// メッセージの更新処理（編集画面を表示するためのものではありません）
Route::put('tasks/{id}', [TasksController::class, 'update']);
// メッセージを削除
Route::delete('tasks/{id}', [TasksController::class, 'destroy']);

// index: showの補助ページ
Route::get('tasks', [TasksController::class, 'index'])->name('tasks.index');
// create: 新規作成用のフォームページ
Route::get('tasks/create', [TasksController::class, 'index'])->name('tasks.index');
// edit: 更新用のフォームページ
Route::get('tasks/{id}/edit', [TasksController::class, 'edit'])->name('tasks.edit');
*/
