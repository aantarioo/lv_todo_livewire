<?php

use App\Livewire\Settings\Appearance;
use App\Livewire\Settings\Password;
use App\Livewire\Settings\Profile;
use App\Models\Task;
use Illuminate\Support\Facades\Route;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Auth;

Route::get('/', function () {
    return view('welcome');
})->name('home');


Route::get('dashboard', function (Request $request) {
    $tasks = Task::orderBy('created_at', 'desc')->where('user_id', $request->user()->id)->get();

		return view('/dashboard', [
			'tasks' => $tasks,
		]);
})->middleware(['auth', 'verified'])->name('dashboard');;

Route::view('newtask', 'newtask')
    ->middleware(['auth', 'verified'])
    ->name('newtask');

Route::post('newtask', function (Request $request) {
    $validator = Validator::make($request->all(), [
        'task_name' => 'required|max:255',
				'task_description' => 'required|max:255',
    ]);

		if ($validator->fails())
		{
			return redirect('/dashboard')->withInput()->withErrors($validator);
		}

		$task = new Task;
		$task->task_name = $request->task_name;
		$task->task_description = $request->task_description;

		Task::create([
				'task_name' => $request->task_name,
				'task_description' => $request->task_description,
				'user_id' => Auth::user()->id,
		]);

		$task->save();

		return redirect('/dashboard');

})->middleware(['auth', 'verified'])->name('newtask');;

Route::put('/dashboard/{id}', function(Request $request, $id) {
		$request->validate([
			'task_name' => 'required|max:255',
			'task_description' => 'required|max:255',
		]);

		$task = Task::findOrFail($id);
		$task->update($request->all());

		return redirect('/dashboard');
});

Route::delete('/dashboard/{id}', function($id) {
		Task::findOrFail($id)->delete();

		return redirect('/dashboard');
});

Route::view('about', 'about')
    ->middleware(['auth', 'verified'])
    ->name('about');

Route::middleware(['auth'])->group(function () {
    Route::redirect('settings', 'settings/profile');

    Route::get('settings/profile', Profile::class)->name('settings.profile');
    Route::get('settings/password', Password::class)->name('settings.password');
    Route::get('settings/appearance', Appearance::class)->name('settings.appearance');
});

require __DIR__.'/auth.php';
