<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>{{ config('app.name', 'Laravel') }}</title>
    <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css" rel="stylesheet">
</head>

<body class="h-full bg-gray-200 grid items-center">
    <div class="grid items-center py-4 mx-auto my-6">
        <form action="/replies" method="post">
            @csrf
            <h3 class="font-bold text-lg text-gray-800">Create Reply</h3>
            <span class="text-sm">This comment will be displayed publicly so be careful what you share.</span>
            <h1 class="font-bold text-lg text-gray-800 pt-6 pb-1">Body</h1>
            <textarea name="body" cols="55" rows="5" class="border-sky-100 hover:border-sky-400"></textarea>

            <div class="flex justify-end space-x-3 mt-4">
                <a href="/" class="px-4 py-2 rounded-lg border border-gray-300 text-gray-600 
                hover:bg-gray-100">
                    Cancel
                </a>
                <button class="px-4 py-2 rounded-lg bg-blue-600 text-white hover:bg-blue-700" type="submit">
                    Submit
                </button>
            </div>

            @if ($errors->any())
                <ul class="mt-2">
                    @foreach ($errors->all() as $error)
                        <li class="text-sm text-red-500">{{ $error }}</li>
                    @endforeach
                </ul>
            @endif
        </form>
    </div>
</body>
</html>