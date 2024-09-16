<?php

namespace App\Services;

use GuzzleHttp\Client;
use Symfony\Component\DomCrawler\Crawler;

class WebScraperService
{
    protected $client;

    public function __construct()
    {
        $this->client = new Client();
    }

    public function scrapeData($url)
    {
        // Send a GET request to the specified URL
        //$response = $this->client->request('GET', $url);
        $response = $this->client->request('GET', $url, [
            'verify' => false, // Disable ssl for testing purposes
        ]);

        // Get the body content of the response
        $htmlContent = $response->getBody()->getContents();

        // Use DomCrawler to parse the HTML from the response
        $crawler = new Crawler($htmlContent);

        // Extract data using CSS selectors
        $data = $crawler->filter('.product-item')->each(function ($node) {
            return [ //make sure the elements/selectors below match your scrape target
                'title' => $node->filter('.product-title')->text(),
                'price' => $node->filter('.product-price')->text(),
                'link' => $node->filter('a')->attr('href'),
            ];
        });

        return $data;
    }
}
