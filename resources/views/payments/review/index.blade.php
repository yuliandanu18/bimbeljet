<x-layouts.app title="Verifikasi Pembayaran">
  <div class="flex items-center justify-between mb-3">
    <h1 class="text-lg font-semibold">Verifikasi Pembayaran</h1>
  </div>

  <div class="grid md:grid-cols-2 gap-4">
    <x-card>
      <div class="font-semibold mb-2">Menunggu Verifikasi</div>
      <div class="divide-y">
        @foreach($pending as $p)
          <a href="{{ route('payments.review.show',$p) }}" class="py-2 block">
            <div class="flex items-center justify-between">
              <div class="text-sm">Inv #{{ $p->invoice_id }} • Rp{{ number_format($p->amount,0,',','.') }}</div>
              <div class="text-xs rounded-full bg-yellow-100 px-2 py-0.5">PENDING</div>
            </div>
            <div class="text-xs text-gray-500">Metode: {{ strtoupper($p->method) }} {{ $p->bank_name ? '• '.$p->bank_name : '' }}</div>
          </a>
        @endforeach
      </div>
      <div class="mt-2">{{ $pending->links() }}</div>
    </x-card>

    <x-card>
      <div class="font-semibold mb-2">Terbaru</div>
      <div class="divide-y">
        @foreach($recent as $p)
          <div class="py-2">
            <div class="flex items-center justify-between">
              <div class="text-sm">Inv #{{ $p->invoice_id }} • Rp{{ number_format($p->amount,0,',','.') }}</div>
              <div class="text-xs rounded-full px-2 py-0.5
                  @if($p->status==='received') bg-emerald-100 @elseif($p->status==='rejected') bg-rose-100 @else bg-gray-100 @endif">
                {{ strtoupper($p->status) }}
              </div>
            </div>
          </div>
        @endforeach
      </div>
    </x-card>
  </div>
</x-layouts.app>
