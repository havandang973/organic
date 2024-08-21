<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Models\Order;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Log;

class CheckNewOrders extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'orders:check';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Command description';

    /**
     * Execute the console command.
     */

     public function __construct()
    {
        parent::__construct();
    }

    public function handle()
    {

        $newOrders = Order::where('created_at', '>', now()->subSecond(30))->count();

        if ($newOrders > 0) {
            $message = "Có {$newOrders} đơn hàng mới. Lúc: " . now()->toDateTimeString();
            $this->sendTelegramNotification($message);
        }
    }

    protected function sendTelegramNotification($message)
    {
        $url = 'https://api.telegram.org/bot7380108854:AAG-ROVgI872GE19rWLF8ht_LwWfHlkbytc/sendMessage';
        $params = [
            'chat_id' => '-4225862101',
            'text' => $message,
        ];

        Http::post($url, $params);
    }
}
