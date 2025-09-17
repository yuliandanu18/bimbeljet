<x-layouts.app :title="'Lead: '.$lead->name">
  <x-card class="space-y-2">
    <div class="font-medium">{{ $lead->name }} · {{ $lead->phone }}</div>
    <div class="text-xs text-gray-500">Status: {{ ucfirst($lead->status) }}</div>
    <div class="text-sm">{{ $lead->notes }}</div>
  </x-card>

  <div class="grid md:grid-cols-2 gap-4 mt-4">
    <x-card>
      <h2 class="font-semibold mb-2">Tambah Follow-up</h2>
      <form method="post" action="{{ route('leads.followups.store',$lead) }}" class="space-y-2">
        @csrf
        <textarea name="note" class="w-full rounded-xl border-gray-300" placeholder="Catatan"></textarea>
        <select name="outcome" class="w-full rounded-xl border-gray-300" required>
          <option value="scheduled_trial">Jadwalkan Trial</option>
          <option value="callback">Callback</option>
          <option value="no_answer">Tidak Terjawab</option>
          <option value="won">Deal</option>
          <option value="lost">Gagal</option>
        </select>
        <button class="px-3 py-2 rounded-xl bg-black text-white">Simpan</button>
      </form>
    </x-card>

    <x-card>
      <h2 class="font-semibold mb-2">Konversi ke Enrollment</h2>
      <form method="post" action="{{ route('leads.convert',$lead) }}" class="space-y-2">
        @csrf
        <select name="class_id" class="w-full rounded-xl border-gray-300" required>
          @foreach($classes as $c)
            <option value="{{ $c->id }}">{{ $c->code }} — {{ $c->name }}</option>
          @endforeach
        </select>
        <select name="package_id" class="w-full rounded-xl border-gray-300" required>
          @foreach($packages as $p)
            <option value="{{ $p->id }}">{{ $p->name }} (Rp{{ number_format($p->price,0,',','.') }})</option>
          @endforeach
        </select>
        <button class="px-3 py-2 rounded-xl bg-emerald-600 text-white">Konversi</button>
      </form>
    </x-card>
  </div>
</x-layouts.app>
