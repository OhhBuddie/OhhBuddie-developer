<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\Cache;
use Illuminate\Http\Request;
use App\Http\Controllers\WhatsAppController;

class SendDelayedWhatsAppMessage extends Command
{
    protected $signature = 'whatsapp:send-delayed';
    protected $description = 'Send WhatsApp messages scheduled in cache';

    public function handle()
    {
        $this->info('Checking for delayed WhatsApp messages...');

        // For demo, if you want to handle multiple messages, store their keys somewhere.
        // Here, I assume you know the keys or track them externally.
        // For simplicity, let's scan all cache keys starting with "delayed_whatsapp_message_"
        // Laravel file cache doesn't support scanning keys, so you can store keys in a separate cache key list or track externally.
        // To keep simple, let's assume you only have one message key:

        // Example of handling a single known key (adjust as needed):
        $keys = Cache::get('delayed_whatsapp_message_keys', []);  // store keys here when scheduling

        foreach ($keys as $cacheKey) {
            if (Cache::has($cacheKey)) {
                $data = Cache::get($cacheKey);

                $request = new Request($data);

                $controller = new WhatsAppController();
                $controller->sendMessage($request);

                Cache::forget($cacheKey);
                $this->info("WhatsApp message sent for key {$cacheKey}");

                // Remove key from keys list
                $keys = array_filter($keys, function ($k) use ($cacheKey) {
                    return $k !== $cacheKey;
                });                
                Cache::put('delayed_whatsapp_message_keys', $keys, now()->addMinutes(10));
            }
        }

        if (empty($keys)) {
            $this->info("No delayed WhatsApp messages found.");
        }
    }
}
