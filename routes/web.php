<?php

//The OpenAI API provides powerful tools for developers to integrate advanced AI capabilities, such as natural language processing and text generation, into their applications. With its user-friendly interface and extensive documentation, it allows for seamless innovation across various industries.

use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Route;



Route::get('/', function () {

    $inputs = [
        [
            'role' => 'system',
            'content' => 'You are a helpful assistant.'
        ],
        [
            'role' => 'user',
            'content' => 'Compose a poem that explains the concept of recursion in programming.'
        ]
    ];

    $poem = Http::withToken(config('services.openai.secret'))->post(
        'https://api.openai.com/v1/responses',
        [
            "model" => "gpt-4o-mini",
            'input' => $inputs,
        ]
    )->json('output.0.content.0.text');

    $inputs[] = [
        "role" => "assistant",
        "content" => $poem
    ];

    $inputs[] = [
        "role" => "user",
        "content" => "Good, but can you make it much, much more silly?"
    ];

    $sillyPoem = Http::withToken(config('services.openai.secret'))->post(
        'https://api.openai.com/v1/responses',
        [
            "model" => "gpt-4o-mini",
            'input' => $inputs,
        ]
    )->json('output.0.content.0.text');

     $inputs[] = [
        "role" => "user",
        "content" => $sillyPoem
    ];

    return view('welcome', ['poem' => $sillyPoem]);
});
