<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Services\WebScraperService;
use App\Models\Product;

class ScrapeWebsite extends Command
{
    protected $signature = 'scrape:website {url}';
    protected $description = 'Scrapes a website and stores the data in the database';

    protected $scraper;

    public function __construct(WebScraperService $scraper)
    {
        parent::__construct();
        $this->scraper = $scraper;
    }

    public function handle()
    {
        $url = $this->argument('url');
        $this->info('Scraping data from: ' . $url);

        $data = $this->scraper->scrapeData($url);

        foreach ($data as $item) {
            Product::updateOrCreate(
                ['link' => $item['link']],
                ['title' => $item['title'], 'price' => $item['price']]
            );
        }

        $this->info('Scraping completed and data saved to the database.');
    }
}
