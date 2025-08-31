<?php

//The OpenAI API provides powerful tools for developers to integrate advanced AI capabilities, such as natural language processing and text generation, into their applications. With its user-friendly interface and extensive documentation, it allows for seamless innovation across various industries.

use App\AI\Chat;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;


Route::get('/', function () {
    return view('roast');
});

Route::post('/roast', function (Request $request) {
    // shows a roast form
    $attributes = request()->validate([
        'topic' => [
            'required',
            'string',
            'min:2',
            'max:50'
        ]
    ]);

    //$prompt = "Please roast {$attributes['topic']} in a sarcastic tone only in 2 lines.";
    $prompt = "Please roast {$attributes['topic']} in a sarcastic tone.";

    $chat = new Chat();

    $mp3 = $chat->send(
        $prompt,
        true
    );

    $file = "/roasts/" . md5($mp3) . ".mp3";
    file_put_contents(public_path($file), $mp3);

    return redirect('/')->with([
        'file'=> $file,
        'flash' => 'Boom. Roasted.'
    ]);

})->middleware('throttle:10,1');
