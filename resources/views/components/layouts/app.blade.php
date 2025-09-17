<!doctype html>
<html lang="id">
<head>
  <meta charset="utf-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1" />
  <title>{{ $title ?? 'BimbelJet' }}</title>
  @vite(['resources/css/app.css','resources/js/app.js'])
</head>
<body class="min-h-dvh bg-gray-50">
  <header class="sticky top-0 z-40 bg-white/80 backdrop-blur border-b">
    <div class="mx-auto max-w-7xl px-4 py-3 flex items-center justify-between">
      <a href="/" class="font-semibold">BimbelJet</a>
      <nav class="flex gap-3 text-sm">
        <a class="px-3 py-1 rounded-full hover:bg-gray-100" href="/leads">Leads</a>
        <a class="px-3 py-1 rounded-full hover:bg-gray-100" href="/calendar">Kalender</a>
        <a class="px-3 py-1 rounded-full hover:bg-gray-100" href="/invoices">Tagihan</a>
      </nav>
    </div>
  </header>
  <main class="mx-auto max-w-7xl p-4">
    {{ $slot }}
  </main>
</body>
</html>
