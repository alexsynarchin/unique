<?php

namespace App\Console\Commands;

use App\Models\CheckUnique;
use Illuminate\Console\Command;

class deleteCheckUniques extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'delete:check-uniques';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Command description';

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
     * @return int
     */
    public function handle()
    {
        $count = 0;
        do {
            $deleted = CheckUnique::whereDate('created_at', '<', date('2022-12-30'))->limit(500)->delete();

            $this->line('Unique texts deleted: Итерация ' . ++$count);
            sleep(1);
        } while ($deleted > 0);
    }
}
