<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>URL-shortener</title>
</head>
<body>

<div>
    <form method="POST" action="{{ route('get-short-url') }}">
        @csrf
        <input type="text" name="original_url" placeholder="Enter original url..." required>
        <input type="text" name="short_url" placeholder="Enter your custom short link...">
        <input type="submit" value="Generate Short Link">
    </form>
</div>
<div>
    <table>
        <tr>
            <th>Original URL</th>
            <th>Shorted URL</th>
            <td>Count visits</td>
        </tr>

        @foreach($urls as $url)
            <tr>
                <td>$url->original_url</td>
                <td>$url->short_url</td>
                <td>$url->count_visits</td>
            </tr>
        @endforeach
    </table>

</div>
</body>
</html>
