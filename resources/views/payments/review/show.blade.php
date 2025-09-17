<x-layouts.app :title="'Pembayaran #'.$payment->id">
  <x-card class="space-y-2">
    <div class="flex items-center justify-between">
      <div class="text-lg font-semibold">Pembayaran #{{ $payment->id }}</div>
      <div class="text-xs px-2 py-1 rounded-full bg-gray-100">{{ strtoupper($payment->status) }}</div>
    </div>
    <div class="grid sm:grid-cols-2 gap-2 text-sm">
      <div>Invoice: #{{ $payment->invoice_id }}</div>
      <div>Jumlah: Rp{{ number_format($payment->amount,0,',','.') }}</div>
      <div>Metode: {{ strtoupper($payment->method) }}</div>
      <div>Tgl Bayar: {{ optional($payment->paid_at)->format('d M Y H:i') }}</div>
      <div>Bank: {{ $payment->bank_name ?? '-' }}</div>
      <div>Ref: {{ $payment->bank_ref ?? $payment->ref ?? '-' }}</div>
    </div>
    @if($payment->proof_path)
      <div class="mt-2">
        <a href="{{ Storage::url($payment->proof_path) }}" class="underline text-sm" target="_blank">Lihat bukti transfer</a>
      </div>
    @endif
  </x-card>

  <x-card class="mt-4">
    <form method="post" action="{{ route('payments.review.status',$payment) }}" class="flex flex-wrap items-end gap-2">
      @csrf
      <div>
        <label class="block text-sm">Catatan</label>
        <input name="notes" class="rounded-xl border-gray-300"/>
      </div>
      <button name="action" value="received" class="px-3 py-2 rounded-xl bg-emerald-600 text-white">Tandai Masuk</button>
      <button name="action" value="pending" class="px-3 py-2 rounded-xl bg-yellow-600 text-white">Pending</button>
      <button name="action" value="rejected" class="px-3 py-2 rounded-xl bg-rose-600 text-white">Tolak</button>
      <button name="action" value="cancelled" class="px-3 py-2 rounded-xl bg-gray-700 text-white">Batalkan</button>
    </form>
  </x-card>
</x-layouts.app>
