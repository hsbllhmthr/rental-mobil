<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Models\Rental;
use Carbon\Carbon;

class CancelExpiredRentals extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'rentals:cancel-expired';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Find and cancel rental bookings that have passed their payment deadline.';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        $this->info('Mencari rental yang kedaluwarsa...');

        $now = Carbon::now();

        $expiredRentals = Rental::where('status', 'menunggu_pembayaran')
                                ->where('payment_deadline', '<', $now)
                                ->get();

        if ($expiredRentals->isEmpty()) {
            $this->info('Tidak ada rental yang kedaluwarsa ditemukan.');
            return;
        }

        foreach ($expiredRentals as $rental) {
            $rental->status = 'dibatalkan';
            $rental->save();
            $this->info("Rental #{$rental->id} telah dibatalkan.");
        }

        $this->info("Selesai. Total {$expiredRentals->count()} rental telah dibatalkan.");
    }
}
