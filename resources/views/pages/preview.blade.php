<!DOCTYPE html>
<html lang="pl">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>{{ $page->title }}</title>
    
    @if(file_exists(public_path('build/manifest.json')))
        @vite(['resources/css/app.css', 'resources/js/app.js'])
    @else
        <script src="https://cdn.tailwindcss.com"></script>
    @endif
</head>
<body class="bg-white text-slate-900 antialiased">
    @foreach($page->content as $section)
        @includeIf('components.sections.' . ($section['type'] ?? ''), ['data' => $section['data'] ?? []])
    @endforeach
</body>
</html>