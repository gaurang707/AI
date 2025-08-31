<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>{{ config('app.name', 'Laravel') }}</title>
    <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css" rel="stylesheet">
</head>

<body class="h-full grid place-items-center p-6 bg-gray-200">

    <div><a href="/destroy" class="rounded p-4 border bg-amber-200 text-red-400 text-right">Destroy Session Data</a></div>
    <div class="flex gap-6 mx-auto max-w-3xl bg-white py-6 px-10 rounded-xl">        
        <div>
            <h1 class="font-bold mb-4">Generate an Image</h1>
            <form method="POST" action="/image">
                @csrf

                <textarea name="description" id="description" cols="30" rows="5"
                    class="border border-gray-600 rounded text-xs p-2"
                    placeholder="A beagle barking at a squirrel in a tree..."></textarea>

                <p class="mt-2">
                    <button class="border border-black px-2 rounded hover:bg-blue-500 hover:text-white">Submit</button>
                </p>
            </form>
        </div>
        <div>
            @if (isset($messages) && count($messages))
                <div class="space-y-6">
                    @foreach(array_chunk($messages, 2) as $chunk)
                        <div>
                            <p class="font-bold text-sm mb-1">{{ $chunk[0]['content'] }}</p>
                            <img src="{{ $chunk[1]['content'] }}" alt="" style="max-width: 250px">
                        </div>
                    @endforeach
                </div>
            @else
                <p>No visualizations yet.</p>
            @endif
        </div>
    </div>

</body>

</html>