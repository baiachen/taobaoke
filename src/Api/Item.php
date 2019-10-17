<?php

namespace TaoBaoKe\Api;

use TaoBaoKe\Tools\GateWay;

class Item extends GateWay
{

    /**
     * taobao.tbk.item.recommend.get( 淘宝客商品关联推荐查询 )
     * @link https://open.taobao.com/api.htm?docId=24517&docType=2&scopeId=11655
     * @param array $param
     * @return bool|mixed
     */
    public function getRecommend(array $param)
    {
        if (!isset($param['fields'])) {
            $param['fields'] = 'num_iid,title,pict_url,small_images,reserve_price,zk_final_price,user_type,provcity,item_url,nick,volume';
        }

        $result = $this->send('taobao.tbk.item.recommend.get', $param);

        return isset($result['results']['n_tbk_item']) ? $result['results']['n_tbk_item'] : false;
    }


    /**
     *  taobao.tbk.item.info.get (淘宝客商品详情（简版）)
     * @link https://open.taobao.com/api.htm?docId=24518&docType=2&scopeId=11655
     * @param array $params
     * @return bool
     */
    public function getInfo(array $params)
    {

        $result = $this->send('taobao.tbk.item.info.get', $params);
        return isset($result['results']['n_tbk_item']) ? \current($result['results']['n_tbk_item']) : false;
    }

    /**
     * taobao.tbk.item.click.extract( 链接解析api )
     * @link https://open.taobao.com/api.htm?docId=28156&docType=2
     * @param $click_url
     * @return bool|mixed
     */
    public function extractClick($click_url)
    {
        $params['click_url'] = $click_url;
        $result = $this->send('taobao.tbk.item.click.extract', $params);
        return $result;
    }

    /**
     * taobao.tbk.item.guess.like( 淘宝客商品猜你喜欢 )
     * @link https://open.taobao.com/api.htm?docId=29528&docType=2
     * @param array $params
     * @return bool|mixed
     */
    public function guessLike(array $params)
    {
        $result = $this->send('taobao.tbk.item.guess.like', $params);
        return $result;
    }
}