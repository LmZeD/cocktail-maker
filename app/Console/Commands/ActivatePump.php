<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;

class ActivatePump extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'pump:activate {pumpId} {time}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Sends pump activate signal to arduino';

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Execute the console command.
     *
     * @return void
     */
    public function handle()
    {
        $pumpId = (int)$this->argument('pumpId');
        $time = (int)$this->argument('time');
        $this->output->writeln("Starting pump $pumpId for $time ms");
        exec(sprintf('python3 activate-pump.py %d %d', $pumpId, $time));

        $this->output->writeln('Finished');
    }
}
