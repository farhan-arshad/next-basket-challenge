<?php

namespace App\Jobs;

use Illuminate\Bus\Queueable;
use Illuminate\Support\Facades\Log;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Facades\Storage;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;

class UserCreate implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    private $data;
    /**
     * Create a new job instance.
     *
     * @return void
     */
    public function __construct($data)
    {
        $this->data = $data;
    }

    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle()
    {
        $content = join(',', $this->data);
        $file_name = 'user_list.csv';
        $exists = Storage::disk('local')->exists($file_name);
        Log::debug('Exists: ' . $exists);
        if (! $exists) {
            Storage::disk('local')->put($file_name, $content . "\n");
            Log::debug('Doesn\'t exist. Creating');
        } else {
            Storage::disk('local')->append($file_name, $content . "\n");
            Log::debug('Exists. Appending');
        }
    }
}
