<?php
/**
 * Created by PhpStorm.
 * User: baia
 * Date: 2019-10-02
 * Time: 14:12
 */

namespace TaoBaoKe\Api;


use TaoBaoKe\Tools\GateWay;

class Word extends GateWay
{
    public function get(array $params)
    {
        $result = $this->send('taobao.tbk.item.word.get', $params);

        return $result;
    }

}