<?php
/**
 * Created by PhpStorm.
 * User: baia
 * Date: 2019-10-02
 * Time: 13:45
 */

namespace Tests;


use PHPUnit\Framework\TestCase;
use TaoBaoKe\Api\Dg;
use TaoBaoKe\Factory;

class CurlTest extends TestCase
{



    public function testDo()
    {
        $config = [
            'appkey' => '27858546',
            'secretKey' => '',
            'session' => '',//授权接口（sc类的接口）需要带上
            'sandbox' => false,
        ];
        $Factory = new Factory($config);



        $this->assertInstanceOf(Dg::class, $Factory->dg);

    }

    public function testC()
    {
        go(function (){
            $config = [
                'appkey' => '',
                'secretKey' => '',
                'session' => '',//授权接口（sc类的接口）需要带上
                'sandbox' => false,
            ];
            $Factory = new Factory($config);

            $param = [
                'adzone_id' => '109467100313',
                'material_id' => 13366,
                'item_id' => 560066340611,
            ];
            $response = $Factory->dg->optimusMaterial($param);
            $this->assertFalse($response);

            $this->assertEquals('25&Invalid signature', $Factory->getError());

        });
    }

}