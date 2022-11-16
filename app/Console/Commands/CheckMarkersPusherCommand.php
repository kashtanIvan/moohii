<?php

namespace App\Console\Commands;

use App\Events\UpdateCoordinatesEvent;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\Log;

class CheckMarkersPusherCommand extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'command:sent_count_markers';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Sent count markers on map';

    /**
     * Execute the console command.
     *
     * @return int
     */
    public function handle()
    {
        event(new UpdateCoordinatesEvent());
        return Command::SUCCESS;
    }
}
