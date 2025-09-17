<?php
namespace App\Domain\Notifications\Drivers;
use Illuminate\Support\Facades\Log;

interface NotificationDriver { public function send(string $to, string $message): void; }

class WhatsAppDriver implements NotificationDriver {
  public function send(string $to, string $message): void {
    Log::info('WA to '.$to.': '.$message);
  }
}
