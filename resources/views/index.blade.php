<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>URL Shortener</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link href="https://cdn.jsdelivr.net/npm/flowbite@3.1.2/dist/flowbite.min.css" rel="stylesheet"/>
</head>
<body class="bg-gray-800 text-gray-200 font-sans p-10 justify-items-center">

<div class="mt-6">
    <form method="POST" action="/url/create" class="text-center space-y-4">
        @csrf
        <input type="url" name="original_url" placeholder="Enter original URL" required
               class="w-96 p-2 bg-gray-700 border border-gray-600 rounded-lg focus:outline-none focus:ring-2 focus:ring-gray-400 text-white"
               value=" {{ request()->old('original_url') }}">
        <x-form-error name="original_url"/>

        <input type="text" name="custom_short_url" placeholder="Enter custom short URL"
               class="p-2 bg-gray-700 border border-gray-600 rounded-lg focus:outline-none focus:ring-2 focus:ring-gray-400 text-white"
               value="{{ request()->old('custom_short_url') }}">
        <x-form-error name="custom_short_url"/>

        <div class="flex justify-center">
            <button type="submit"
                    class="bg-gray-700 hover:bg-gray-500 font-bold py-2 px-4 rounded-lg transition duration-300">
                Generate Short URL
            </button>
        </div>
    </form>
</div>
@if(filled($urls))
    <div class="mt-6">
        <table class="w-full text-left border-collapse text-gray-200">

            <thead class="bg-gray-800">
            <tr>
                <th class="p-3">Original URL</th>
                <th class="p-3">Shortened URL</th>
                <th class="p-3">Visits</th>
                <th class="text-center p-3">Action</th>
            </tr>
            </thead>

            <tbody>

            @foreach($urls as $url)
                <tr class="border-b border-gray-700 hover:bg-gray-700">
                    <td class="p-3 break-all">{{ $url->original_url }}</td>
                    <td class="p-3">
                        <a href="{{ $url->short_url }}" target="_blank" class="text-gray-300 hover:text-gray-100">
                            {{ $url->short_url }}
                        </a>
                    </td>
                    <td class="p-3 text-center">{{ $url->count_visits }}</td>
                    <td class="p-3 text-center">
                        <form method="POST" action="/url/{{ $url->id }}">
                            @csrf
                            @method('DELETE')
                            <button type="submit"
                                    class="bg-gray-600 hover:bg-gray-500 text-white font-bold py-1 px-3 rounded-lg transition duration-300">
                                Delete
                            </button>
                        </form>
                    </td>
                </tr>
            @endforeach
            </tbody>
        </table>
    </div>
@endif

</body>
</html>
