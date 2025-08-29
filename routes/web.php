<?php

//The OpenAI API provides powerful tools for developers to integrate advanced AI capabilities, such as natural language processing and text generation, into their applications. With its user-friendly interface and extensive documentation, it allows for seamless innovation across various industries.

use App\AI\Chat;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Route;


Route::get('/', function () {

    $url = 'https://api.openai.com/v1/chat/completions';
    //$url = 'https://api.openai.com/v1/responses';

    //$modal = 'gpt-3.5-turbo';
    $modal = 'gpt-4o-mini';
    

    $inputs = [
        [
            'role' => 'system',
            'content' => 'You are a helpful assistant.'
        ],
        [
            'role' => 'user',
            'content' => 'Compose a 4 line of poem that explains the concept of recursion in programming.'
        ]
    ];

    $poem = Http::withToken(config('services.openai.secret'))->post(
        $url,
        [
            "model" => $modal,            
            'messages' => $inputs,
        ]
    )->json('choices.0.message.content');

    
    $inputs[] = [
        "role" => "assistant",
        "content" => $poem
    ];

    $inputs[] = [
        "role" => "user",
        "content" => "Good, but can you make it much, much more silly?"
    ];

    $sillyPoem = Http::withToken(config('services.openai.secret'))->post(
        $url,
        [
            "model" => $modal,
            //'input' => $inputs,
            'messages' => $inputs,
        ]
    )->json('choices.0.message.content');
    
    //->json('choices.0.message.content');

     $inputs[] = [
        "role" => "user",
        "content" => $sillyPoem
    ];

    $chat = new Chat();
    

    return view('welcome', ['poem' => $sillyPoem]);
});
