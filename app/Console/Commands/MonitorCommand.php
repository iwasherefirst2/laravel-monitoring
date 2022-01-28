<?php

namespace App\Console\Commands;

use App\Models\ServerLogs;
use App\Services\Monitor;
use Illuminate\Console\Command;

class MonitorCommand extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'monitor:check';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Monitor if server is alive';

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
        $url = config('monitor.url');
        $this->info('Try to reach' . $url);

        $curlHandle = curl_init($url);
        curl_setopt($curlHandle, CURLOPT_RETURNTRANSFER,1);

        if(!curl_exec($curlHandle))
        {
            $this->error('Service not reachable');
            ServerLogs::create([
                'available' => false,
            ]);
            curl_close($curlHandle);
            return;
        }

        $this->info('Server responded at ' . date('Y-m-d H:i:s'));
        $info = curl_getinfo($curlHandle);
        ServerLogs::create([
            'available' => true,
            'http_code' => $info['http_code'],
            'duration_request' => $info['total_time'],
            'duration_dns' => $info['namelookup_time'],
        ]);

        curl_close($curlHandle);
        return 0;
    }
}
