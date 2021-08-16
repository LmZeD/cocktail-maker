<?php

namespace App\Jobs;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Facades\Artisan;

class SendCommandToPump implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    private $pumpId;
    private $time;

    /**
     * Create a new job instance.
     *
     * @return void
     */
    public function __construct(int $pumpId, float $time)
    {
        $this->pumpId = $pumpId;
        $this->time = $time;
    }

    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle()
    {
        Artisan::call('pump:activate', ['pumpId' => $this->pumpId, 'time' => (int)($this->time*1000)]);
    }
}
