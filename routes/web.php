<?php

//The OpenAI API provides powerful tools for developers to integrate advanced AI capabilities, such as natural language processing and text generation, into their applications. With its user-friendly interface and extensive documentation, it allows for seamless innovation across various industries.

use App\AI\Assistant;
use App\Rules\SpamFree;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use Illuminate\Validation\ValidationException;
use OpenAI\Laravel\Facades\OpenAI;

Route::get('/', function () {
    return view('create-reply');
});

Route::post('/replies', function () {
    request()->validate([
        'body' => [
            'required',
            'string',
            new SpamFree()
        ]
    ]);

        return 'Redirect wherever is needed. Post is valid!';
    //return $response->is_spam ? 'THIS IS SPAM!' : 'VALID POST';
});

Route::get('/destroy', function () {

    session()->flush();
    return redirect('/')->with('message', 'Session destroyed');
});
