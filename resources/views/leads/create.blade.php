<x-layouts.app title="Tambah Lead">
  <form method="post" action="{{ route('leads.store') }}" class="space-y-3 max-w-md">
    @csrf
    <x-card class="space-y-3">
      <div>
        <label class="block text-sm">Nama</label>
        <input name="name" class="mt-1 w-full rounded-xl border-gray-300" required/>
      </div>
      <div>
        <label class="block text-sm">Telepon</label>
        <input name="phone" class="mt-1 w-full rounded-xl border-gray-300" required/>
      </div>
      <div>
        <label class="block text-sm">Sumber</label>
        <input name="source" class="mt-1 w-full rounded-xl border-gray-300"/>
      </div>
      <div>
        <label class="block text-sm">Catatan</label>
        <textarea name="notes" class="mt-1 w-full rounded-xl border-gray-300"></textarea>
      </div>
      <div class="flex justify-end">
        <button class="px-3 py-2 rounded-xl bg-black text-white">Simpan</button>
      </div>
    </x-card>
  </form>
</x-layouts.app>
