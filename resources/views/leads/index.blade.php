<x-layouts.app title="Leads">
  <div class="flex items-center justify-between mb-3">
    <h1 class="text-lg font-semibold">Leads</h1>
    <a href="{{ route('leads.create') }}" class="px-3 py-2 rounded-xl bg-black text-white">Tambah</a>
  </div>
  <x-card class="divide-y">
    @foreach($leads as $l)
    <a href="{{ route('leads.show',$l) }}" class="flex items-center justify-between py-3">
      <div class="min-w-0">
        <div class="font-medium truncate">{{ $l->name }} · {{ $l->phone }}</div>
        <div class="text-xs text-gray-500 truncate">{{ ucfirst($l->status) }} • {{ $l->source }}</div>
      </div>
      <span class="text-xs px-2 py-1 rounded-full bg-gray-100">{{ optional($l->branch)->name }}</span>
    </a>
    @endforeach
  </x-card>
  <div class="mt-4">{{ $leads->links() }}</div>
</x-layouts.app>
