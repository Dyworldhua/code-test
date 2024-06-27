<?php
namespace Fruit\BaseApi;
use GuzzleHttp\Client;

class BaseApiService
{

    public function request($method,$url,$param=[]){

        $client = new Client();

        return $client->request($method,$url,$param);

    }

}