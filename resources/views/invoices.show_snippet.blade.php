{{-- Tambahkan di bawah form pembayaran untuk link review (khusus owner/admin) --}}
@auth
  <div class="mt-3 text-sm">
    <a href="{{ route('payments.review.index') }}" class="underline">Panel Verifikasi Pembayaran</a>
  </div>
@endauth
