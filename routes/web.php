<?php

//The OpenAI API provides powerful tools for developers to integrate advanced AI capabilities, such as natural language processing and text generation, into their applications. With its user-friendly interface and extensive documentation, it allows for seamless innovation across various industries.

use App\AI\Assistant;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('image', [
        'messages' => session('messages', [])
    ]);
});

Route::post('/image', function () {

    $attributes = request()->validate([
        'description' => ['required', 'string', 'min:3']
    ]);

    $assistant = new Assistant(session('messages', []));

    $assistant->visualize($attributes['description']);

    session(['messages' => $assistant->messages()]);

    return redirect('/');
});

Route::get('/destroy', function (){
    
    session()->flush();
    return redirect('/')->with('message', 'Session destroyed'); 
});
