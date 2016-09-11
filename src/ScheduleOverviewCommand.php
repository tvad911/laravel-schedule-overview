<?php

namespace MicheleCurletta\LaravelScheduleOverview;

use Illuminate\Console\Command;
use Illuminate\Console\Scheduling\Schedule;
use Cron\CronExpression;

class ScheduleOverviewCommand extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'schedule:overview';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Shows a schedule overview';

     /**
     * @var Schedule
     */
    protected $schedule;

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct(Schedule $schedule)
    {
        parent::__construct();

        $this->schedule = $schedule;
    }

    /**
     * Execute the console command.
     *
     * @return mixed
     */
    public function handle()
    {   $events = array_map(function ($event) {
                return [
                    'cron' => $event->expression,
                    'command' => static::fixupCommand($event->command),
                    'previousRun' => CronExpression::factory($event->expression)->getPreviousRunDate()->format('Y-m-d H:i:s'),
                    'nextRun' => CronExpression::factory($event->expression)->getNextRunDate()->format('Y-m-d H:i:s'),
                    'timezone' => $event->timezone,
                    'withoutOverlapping' => $event->withoutOverlapping ? "\xe2\x9c\x85" : "\xe2\x9d\x8c",
                ];
            }, $this->schedule->events());

            $this->table(
                ['Cron', 'Artisan command', 'Previous Run', 'Next Run', 'Timezone', 'Without overlapping?'],
                $events
            );
           
    }

   /**
     * Delete command partials ("php artisan")
     *
     * @param $command
     * @return string
     */
    protected static function fixupCommand($command)
    {
        $parts = explode(' ', $command);
        if (count($parts) > 2 && $parts[1] === "'artisan'") {
            array_shift($parts);
            array_shift($parts);
        }

        return implode(' ', $parts);
    }
}