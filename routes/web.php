<?php

//The OpenAI API provides powerful tools for developers to integrate advanced AI capabilities, such as natural language processing and text generation, into their applications. With its user-friendly interface and extensive documentation, it allows for seamless innovation across various industries.

use App\AI\Assistant;
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
            function ($attribute, $value, $fail) {
                $response = OpenAI::chat()->create([
                    'model' => 'gpt-4o-mini',
                    'messages' => [
                        ['role' => 'system', 'content' => 'You are a froum moderator who always responds using JSON.'],
                        [
                            'role' => 'user',
                            'content' => <<<EOT
                                        Please inspect the following text and determine if it is spam

                                        {$value}

                                        Expected Response Example:

                                        {"is_spam" : true|false}
                                    EOT
                        ]
                    ],
                    'response_format' => ['type' => 'json_object']
                ])->choices[0]->message->content;

                $response = json_decode($response);

                if ($response->is_spam) {
                    $fail('Spam was detected');
                }
            }

        ]
    ]);

        return 'Redirect wherever is needed. Post is valid!';
    //return $response->is_spam ? 'THIS IS SPAM!' : 'VALID POST';
});

Route::get('/destroy', function () {

    session()->flush();
    return redirect('/')->with('message', 'Session destroyed');
});
