<?php

//The OpenAI API provides powerful tools for developers to integrate advanced AI capabilities, such as natural language processing and text generation, into their applications. With its user-friendly interface and extensive documentation, it allows for seamless innovation across various industries.

use App\AI\Chat;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Route;


Route::get('/', function () {
    $chat = new Chat();
    $poem = $chat
        ->systemMessage("You are a poetic assistant, skilled in explaining complex programming concepts with creative flair")
        ->send("Compose a poem that explains the concept of recursion in programming");
    $sillyPoem = $chat->reply("Cool, Can you make it much, much sillier?");
    return view('welcome', data: ['poem' => $poem]);
});
