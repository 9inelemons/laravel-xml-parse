<?php

namespace App\Console\Commands;

use App\Console\DTOs\MarkdownDTO;
use App\Console\DTOs\TradeInDTO;
use App\Services\XmlTradeInMarkdownImportService;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Storage;

class ParseTradeInXml extends Command
{
    const ENDPOINT_URL = 'https://api.iport.ru/files/xml/TradeIn_markdown.xml';

    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'parse:tradein';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Parse XML data and fill markdown and tradein products';
    private XmlTradeInMarkdownImportService $service;

    public function __construct(
        XmlTradeInMarkdownImportService $service
    )
    {
        $this->service = $service;

        parent::__construct();
    }

    /**
     * Execute the console command.
     *
     * @return int
     */
    public function handle(): int
    {
        /*$fileName = $this->argument('fileName');
        $fileData = Storage::disk('import')->get($fileName);*/

        $fileData = Http::get(self::ENDPOINT_URL)->body();
        $xmlObject = simplexml_load_string($fileData);
        $currentTime = now();

        foreach ($xmlObject->children() as $key=>$value)
        {
            foreach ($value->children() as $productValue)
            {
                switch ($key) {
                    case $this->service::TRADE_IN_PRODUCT:
                        $dto = new TradeInDTO($productValue);
                        $this->service->processTradeIn($dto, $currentTime);
                        break;
                    case $this->service::MARKDOWN_PRODUCT:
                        $dto = new MarkdownDTO($productValue);
                        $this->service->processMarkDown($dto, $currentTime);
                        break;
                    default:
                        break;
                }
            }
        }
        $this->service->deactivateProductsMissingInXml($currentTime);
        return 1;
    }
}
