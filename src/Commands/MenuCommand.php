<?php

namespace Salahhusa9\Menu\Commands;

use Illuminate\Console\Command;

class MenuCommand extends Command
{
    public $signature = 'laravel-menu';

    public $description = 'My command';

    public function handle(): int
    {
        $this->comment('All done');

        return self::SUCCESS;
    }
}
