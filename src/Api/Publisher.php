<?php
/**
 * Created by PhpStorm.
 * User: baia
 * Date: 2019-10-02
 * Time: 14:07
 */

namespace TaoBaoKe\Api;


use TaoBaoKe\Tools\GateWay;

class Publisher extends GateWay
{

    public function infoSave(array $params)
    {
        $result = $this->send('taobao.tbk.sc.publisher.info.save', $params);
        return $result;
    }

    public function infoGet(array $params)
    {
        $result = $this->send('taobao.tbk.sc.publisher.info.get', $params);
        return $result;
    }

    public function inviteCodeGet(array $params)
    {
        $result = $this->send('taobao.tbk.sc.invitecode.get', $params);
        return $result;
    }

}