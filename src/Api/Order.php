<?php


namespace TaobaoUnionSdk\Api;


use TaoBaoKe\Tools\GateWay;

class Order extends GateWay
{
    public function refund(array $params)
    {
        $result = $this->send('taobao.tbk.relation.refund', $params);
        return $result;
    }

    public function get(array $params)
    {
        $result = $this->send('taobao.tbk.order.details.get', $params);
        return $result;
    }

    public function punish(array $params)
    {
        $result = $this->send('taobao.tbk.dg.punish.order.get', $params);
        return $result;
    }

}