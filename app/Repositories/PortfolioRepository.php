<?php

namespace App\Repositories;

use App\Models\Wallet;
use Illuminate\Support\Arr;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\Http;

class PortfolioRepository
{
    public function getStockData(Collection $stocks)
    {
        $stocksString = '';
        foreach($stocks as $stock)
        {
            $stocksString .= $stock->name . ',';
        }

        $response = Http::get('https://brapi.dev/api/quote/' . $stocksString);

        $stocksMarketData = [];
        if($response->ok()) {
            $stocksMarketData = collect(
                $response['results']
            )->pluck('regularMarketPrice', 'symbol');
        }

        return $stocksMarketData;
    }

    public function getConsolidatedPortfolio(Wallet $wallet)
    {
        $stocks = $wallet->stocks;

        $labels = [];
        $data = [];

        $stocksMarketData = $this->getStockData($stocks);

        foreach($stocks as $stock)
        {
            $stockPrice = Arr::get($stocksMarketData, $stock->name, $stock->average_price);

            array_push($labels, $stock->name);
            array_push($data, ($stockPrice * $stock->quantity));
        }

        return $this->makeStruct('Carteira consolidada (ativo)', $labels, $data);
    }

    public function getSectorPortfolio(Wallet $wallet)
    {
        $stocks = $wallet->stocks;

        $labels = [];
        $data = [];

        $stocksMarketData = $this->getStockData($stocks);

        foreach($stocks as $stock)
        {
            $stockPrice = Arr::get($stocksMarketData, $stock->name, $stock->average_price);
            $sector = $stock->sector;

            $labels[$sector->id] = $sector->name;

            $value = ($stockPrice * $stock->quantity);

            if(! Arr::get($data, $sector->id)) {
                $data[$sector->id] = $value;

                continue;
            }

            $data[$sector->id] += $value;
        }

        $labels = collect($labels)->values()->toArray();
        $data = collect($data)->values()->toArray();

        return $this->makeStruct('Carteira consolidada (setor)', $labels, $data);
    }

    protected function makeStruct(string $title, array $labels, array $data)
    {
        return  [
            'chartOptions' => [
                'responsive' => true,
                'plugins' => [
                    'title' => [
                        'display' => true,
                        'text' => $title,
                    ],
                ],
            ],
            'chartData' => [
                'labels' => $labels,
                'datasets' => [[
                        'data' => $data,
                    ],
                ],
            ]
        ];
    }
}