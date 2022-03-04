<?php
namespace App\Services;

use Illuminate\Support\Facades\Http;



class currencyConveterApi{
 
    protected $apiKey ;
    protected $host='https://free.currconv.com' ;

    public function __construct($apiKey)
    {
        $this->apiKey = $apiKey ;
    }

    public function get($from , $to){
        
        $from = strtoupper($from);
        $to = strtoupper($to);
       $result= Http::baseUrl($this->host)
       ->get('/api/v7/convert', 
         ['q' =>"{$from}_{$to}",
          'compact' => 'ultra',
          'apiKey' => $this->apikey
          ])->json();
              dd($result);
    }

    public function currencies(){
       return Http::baseUrl($this->host)
        ->get('/api/v7/currencies',[
            'apiKey' => $this->apikey
        ])->json();
    }
}
