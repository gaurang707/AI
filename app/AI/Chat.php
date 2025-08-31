<?php

namespace App\AI;

use Illuminate\Support\Facades\Log;
use OpenAI\Laravel\Facades\OpenAI;
use OpenAI\Exceptions\RateLimitException;

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

    public function send(string $messages, bool $speech = false)
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


        return $speech ? $this->speech($response) : $response;
    }

    public function speech(string $message)
    {
        return $this->completionsWithBackoff([
            'model' => 'tts-1',
            'input' => $message,
            'voice' => 'alloy'
        ]);
    }

    public function completionsWithBackoff(array $params)
    {
        $attempts = 0;
        $maxAttempts = 5;
        $waitSeconds = 1;

        while ($attempts < $maxAttempts) {
            try {
                return OpenAI::audio()->speech($params);
            } catch (RateLimitException $e) {
                $attempts++;
                if ($attempts >= $maxAttempts) {
                    throw $e; // give up after max attempts
                }

                sleep($waitSeconds);
                $waitSeconds *= 2; // exponential backoff
            }
        }
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