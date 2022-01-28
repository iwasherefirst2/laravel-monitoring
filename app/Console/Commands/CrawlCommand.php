<?php

namespace App\Console\Commands;

use App\Services\Crawler;
use Illuminate\Console\Command;

class CrawlCommand extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'crawl:all';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Crawl domains';

    /**
     * @var Crawler
     */
    private $crawler;

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct(Crawler $crawler)
    {

        parent::__construct();
        $this->crawler = $crawler;
    }

    /**
     * Execute the console command.
     *
     * @return int
     */
    public function handle()
    {
        $this->crawler->crawl();
        return 0;
    }
}
