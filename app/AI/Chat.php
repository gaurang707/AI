<?php

namespace App\AI;

use OpenAI\Laravel\Facades\OpenAI;

class Chat
{
    protected array $messages = [];

    public function systemMessage(string $message): static
    {
        $this->messages[] = [
            'role' => 'system',
            'content' => $message
        ];

        return $this;
    }

    public function send(string $messages)
    {
        $this->messages[] = [
            'role' => 'user',
            'content' => $messages
        ];
        
        $response = OpenAI::chat()->create([
            "model" => "gpt-4o-mini",  # or gpt-4o, gpt-4, gpt-3.5-turbo,
            'messages' => $this->messages,
        ])->choices[0]->message->content;

        if ($response) {
            $this->messages[] = [
                'role' => 'assistant',
                'content' => $response
            ];
        }        
        return $response;
    }

    public function reply(string $message): ?string
    {
        return $this->send($message);
    }
    public function messages()
    {
        return $this->messages;
    }
}

// $chat->send('Tell me a bedtime story.')