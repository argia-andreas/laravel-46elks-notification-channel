<?php

namespace Grafstorm\FortySixElksChannel\Commands;

use Illuminate\Console\Command;

class FortySixElksChannelCommand extends Command
{
    public $signature = 'laravel-46elks-notification-channel';

    public $description = 'My command';

    public function handle()
    {
        $this->comment('All done');
    }
}
