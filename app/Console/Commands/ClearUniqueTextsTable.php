<?php

namespace App\Console\Commands;

use App\Models\UniqueText;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\DB;

class ClearUniqueTextsTable extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'delete:unique-texts';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Delete unique-texts records';

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
            $deleted = UniqueText::whereDate('created_at', '<', date('2024-05-07'))->limit(500)->delete();

            $this->line('Unique texts deleted: Итерация ' . ++$count);
            sleep(1);
        } while ($deleted > 0);
    }
}
