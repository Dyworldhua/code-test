<?php
namespace Fruit;
include_once('./BaseApi/BaseApiService.php');
use Fruit\BaseApi\BaseApiService;

class FruitApiService
{

    private $baseApi;

    CONST REQUEST_URL = "http://fruit.test/api";

    public function __construct(BaseApiService $baseApi)
    {
        $this->baseApi = $baseApi;
    }

    public function request($method,$url,$param=[]){

        try{

            $response = $this->baseApi->request($method,self::REQUEST_URL.$url,$param);

            if($response->getStatusCode() != 200)throw new \Exception("Request failed");

            $body = json_decode($response->getBody()->getContents(),true);

            $code = 200;

            if($body['status'] == 1){

                // insert sql

            }else if($body['status'] == 0){

                $code = 400;

            }

            return ['code'=>$code,'data'=>$body['data'],'msg'=>$body['msg']];

        }catch(\Exception $e){

            return ['code'=>500,'msg'=>$e->getMessage()];

        }
    }

}

$class = new FruitApiService(new BaseApiService());

// Get Fruit List
var_dump($class->request("GET",'/list'));

// Buy Fruit
var_dump($class->request("POST",'/buy',[
    'form_params'=>[
        'id'=>1,
        'qty'=>2
    ]
]));

