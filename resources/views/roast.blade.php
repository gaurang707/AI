<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>{{ config('app.name', 'Laravel') }}</title>
    <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css" rel="stylesheet">
</head>

<body class="h-full grid place-items-center p-6">

    @if (session('file'))
        <div>
            <iframe src="https://giphy.com/embed/RdKjAkFTNZkWUGyRXF" width="480" height="256" frameBorder="0"
                class="giphy-embed" allowFullScreen></iframe>

            <a href="{{ asset(session('file')) }}" download
                class="block w-full text-center rounded p-2 bg-gray-200 hover:bg-blue-500 hover:text-white mt-3">Download
                Audio</a>
        </div>
    @else
        <form action="/roast" method="post" class="h-full lg:max-w-md lg:max-auto">
            @csrf
            <div class="flex gap-2">
                <input type="text" name="topic" required placeholder="What do you want to roast?"
                    class="border p-2 rounded flex-1 w-64">
                <button class="rounded p-2 bg-gray-200 hover:bg-blue-200 hover:text-white">Roast</button>
            </div>
        </form>
    @endif
</body>

</html>