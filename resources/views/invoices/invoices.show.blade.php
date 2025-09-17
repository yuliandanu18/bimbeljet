<x-layouts.app :title="'Invoice #'.$invoice->id">
  {{-- Header invoice --}}
  <x-card class="space-y-2">
    <div class="font-semibold">Invoice #{{ $invoice->id }}</div>
    <div>Jatuh tempo: {{ $invoice->due_date->format('d M Y') }}</div>
    <div>Status: {{ strtoupper($invoice->status) }}</div>
    <div>Jumlah: Rp{{ number_format($invoice->amount,0,',','.') }}</div>
  </x-card>

  {{-- Notifikasi sukses / error --}}
  @if(session('ok'))
    <x-card class="mt-3 bg-emerald-50 border-emerald-200">✅ {{ session('ok') }}</x-card>
  @endif
  @if ($errors->any())
    <x-card class="mt-3 bg-rose-50 border-rose-200">
      <div class="font-medium mb-1">Perbaiki input:</div>
      <ul class="list-disc pl-6 text-sm">
        @foreach ($errors->all() as $error)
          <li>{{ $error }}</li>
        @endforeach
      </ul>
    </x-card>
  @endif

  {{-- Form pembayaran (single, lengkap) --}}
  <x-card class="mt-4">
    <form method="post"
          action="{{ route('invoices.pay',$invoice) }}"
          enctype="multipart/form-data"
          class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-3 items-end">
      @csrf

      <div>
        <label class="block text-sm">Metode</label>
        <select name="method" class="mt-1 w-full rounded-xl border-gray-300">
          <option value="cash">cash</option>
          <option value="transfer">transfer</option>
          <option value="gateway">gateway</option>
        </select>
      </div>

      <div>
        <label class="block text-sm">Jumlah (Rp)</label>
        <input name="amount" type="number" min="1" step="1"
               class="mt-1 w-full rounded-xl border-gray-300" required />
      </div>

      <div>
        <label class="block text-sm">Bank</label>
        <input name="bank_name" class="mt-1 w-full rounded-xl border-gray-300"
               placeholder="BCA/BRI/BNI/Mandiri" />
      </div>

      <div>
        <label class="block text-sm">Ref/berita</label>
        <input name="bank_ref" class="mt-1 w-full rounded-xl border-gray-300"
               placeholder="INV-{{ $invoice->id }} / no. referensi" />
      </div>

      <div>
        <label class="block text-sm">Bukti (jpg/png/pdf)</label>
        <input name="proof" type="file" accept=".jpg,.jpeg,.png,.pdf"
               class="mt-1 w-full rounded-xl border-gray-300" />
      </div>

      <div>
        <label class="block text-sm">Catatan internal</label>
        <input name="ref" class="mt-1 w-full rounded-xl border-gray-300"
               placeholder="Catatan internal" />
      </div>

      <div class="sm:col-span-2 lg:col-span-3 flex justify-end">
        <button class="px-3 py-2 rounded-xl bg-black text-white">Kirim</button>
      </div>
    </form>
  </x-card>

  {{-- Link panel verifikasi (untuk owner/admin yang login) --}}
  @auth
    <div class="mt-3 text-sm">
      <a href="{{ route('payments.review.index') }}" class="underline">Panel Verifikasi Pembayaran</a>
    </div>
  @endauth
</x-layouts.app>
