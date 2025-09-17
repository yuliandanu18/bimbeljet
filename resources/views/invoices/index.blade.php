<x-layouts.app title="Tagihan">
  <x-card>
    <table class="w-full text-sm">
      <thead>
        <tr>
          <th class="text-left">ID</th>
          <th>Jatuh Tempo</th>
          <th>Status</th>
          <th class="text-right">Jumlah</th>
        </tr>
      </thead>
      <tbody>
      @forelse($invoices as $inv)
        <tr class="border-t">
          <td class="py-2">
            <a href="{{ route('invoices.show',$inv) }}" class="underline">#{{ $inv->id }}</a>
          </td>
          <td class="text-center">{{ \Illuminate\Support\Carbon::parse($inv->due_date)->format('d M Y') }}</td>
          <td class="text-center">{{ strtoupper($inv->status) }}</td>
          <td class="text-right">Rp{{ number_format($inv->amount,0,',','.') }}</td>
        </tr>
      @empty
        <tr><td colspan="4" class="py-4 text-center text-gray-500">Belum ada invoice.</td></tr>
      @endforelse
      </tbody>
    </table>
  </x-card>
  <div class="mt-4">{{ $invoices->links() }}</div>
</x-layouts.app>
