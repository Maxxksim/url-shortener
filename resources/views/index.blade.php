<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>URL Shortener</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link href="https://cdn.jsdelivr.net/npm/flowbite@3.1.2/dist/flowbite.min.css" rel="stylesheet"/>
</head>
<body class="bg-gray-100 flex items-center justify-center min-h-screen">

<div class="w-full max-w-2xl bg-white shadow-lg rounded-lg p-6">
    <h1 class="text-2xl font-semibold text-center mb-4">Shorten Your URL</h1>

    <form method="POST" action="/url/create" class="space-y-4">
        @csrf
        <input type="text" name="original_url" placeholder="Enter original URL..." required
               class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500">
        <input type="text" name="short_url" placeholder="Enter custom short link..."
               class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500">
        <button type="submit" class="w-full bg-blue-500 text-white py-2 rounded-lg hover:bg-blue-600 transition">
            Generate Short Link
        </button>
    </form>

    <div class="mt-6">
        <h2 class="text-xl font-semibold text-center mb-2">Generated Links</h2>
        <table class="w-full border-collapse border border-gray-300 bg-white rounded-lg shadow-sm">
            <thead class="bg-gray-200">
            <tr>
                <th class="border border-gray-300 px-4 py-2 text-left">Original URL</th>
                <th class="border border-gray-300 px-4 py-2 text-left">Shortened URL</th>
                <th class="border border-gray-300 px-4 py-2 text-left">Visits</th>
                <th class="border border-gray-300 px-4 py-2 text-left">Action</th>
            </tr>
            </thead>
            <tbody>
            @foreach($urls as $url)

                <tr class="hover:bg-gray-100 transition">
                    <td class="border border-gray-300 px-4 py-2 truncate max-w-xs">{{ $url->original_url }}</td>
                    <td class="border border-gray-300 px-4 py-2 text-blue-500 underline truncate max-w-xs">{{ $url->short_url }}</td>
                    <td class="border border-gray-300 px-4 py-2 text-center">{{ $url->count_visits }}</td>
                    <td>
                        <button form="delete-form">Delete</button>
                    </td>
                </tr>

                <form method="POST" action="/url/{{ $url->id }}" class="hidden" id="delete-form">
                    @csrf
                    @method('DELETE')
                </form>
            @endforeach
            </tbody>
        </table>
    </div>
</div>


</body>
</html>
