<!-- Tambahkan ke form pembayaran di resources/views/invoices.show.blade.php -->
<form method="post" action="{{ route('invoices.pay',$invoice) }}" enctype="multipart/form-data" class="flex flex-wrap gap-2 items-end">
  @csrf
  <div><label class="block text-sm">Metode</label>
    <select name="method" class="rounded-xl border-gray-300">
      <option>cash</option><option>transfer</option><option>gateway</option>
    </select>
  </div>
  <div><label class="block text-sm">Jumlah (Rp)</label>
    <input name="amount" type="number" class="rounded-xl border-gray-300" required />
  </div>
  <div><label class="block text-sm">Bank</label>
    <input name="bank_name" class="rounded-xl border-gray-300" placeholder="BCA/BRI/BNI/Mandiri"/>
  </div>
  <div><label class="block text-sm">Ref/berita</label>
    <input name="bank_ref" class="rounded-xl border-gray-300" placeholder="INV-123 / no. referensi"/>
  </div>
  <div><label class="block text-sm">Bukti (jpg/png/pdf)</label>
    <input name="proof" type="file" class="rounded-xl border-gray-300" />
  </div>
  <div><label class="block text-sm">Catatan</label>
    <input name="ref" class="rounded-xl border-gray-300" placeholder="Catatan internal"/>
  </div>
  <button class="px-3 py-2 rounded-xl bg-black text-white">Kirim</button>
</form>

@auth
  <div class="mt-3 text-sm">
    <a href="{{ route('payments.review.index') }}" class="underline">Panel Verifikasi Pembayaran</a>
  </div>
@endauth
