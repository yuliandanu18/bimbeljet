<x-layouts.app title="Check-in Berhasil">
  <x-card class="space-y-2">
    <div class="text-lg font-semibold">Check-in berhasil 🎉</div>
    <div>Enrollment ID: {{ $enrollment->id }}</div>
    <div>Tanggal: {{ $attendance->class_date->format('d M Y') }}</div>
    <div>Status: {{ strtoupper($attendance->status) }}</div>
  </x-card>
</x-layouts.app>
