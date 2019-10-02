<?php


namespace TaoBaoKe\Tools;


use TaoBaoKe\Factory;



class GateWay
{

    /**
     * @link https://open.taobao.com/api.htm?docId=24515&docType=2
     * @var string 淘宝联盟官网URL
     */
    protected $unionUrl = 'https://eco.taobao.com/router/rest';

    /**
     * 是否是Auth
     * @var bool
     */
    protected $isAuth = false;

    /**
     * 配置
     * @var array
     */
    protected $globalConfig = [
        'appkey' => '',
        'secretKey' => '',
        'format' => 'json',
        'session' => '',//授权接口（sc类的接口）需要带上
        'signMethod' => 'md5',
        'apiVersion' => '2.0',
        'sandbox' => false,
    ];

    /**
     * @var TbkFatory
     */
    protected $taoBaoKe;

    public function __construct($config, Factory $factory)
    {
        $this->globalConfig = array_merge($this->globalConfig, $config);
        $this->taoBaoKe = $factory;
    }

    public function send($method, array $params)
    {
        //组装系统参数
        $sysParams["app_key"] = $this->globalConfig['appkey'];
        $sysParams["v"] = $this->globalConfig['apiVersion'];
        $sysParams["format"] = $this->globalConfig['format'];
        $sysParams["sign_method"] = $this->globalConfig['signMethod'];
        $sysParams["method"] = $method;
        $sysParams["timestamp"] = \date("Y-m-d H:i:s");
        $data= array_merge($params, $sysParams);
        $data["sign"] = $this->generateSign(array_merge($params, $sysParams), $this->globalConfig['secretKey']);

        try {
            $resp = Helpers::curl_post($this->unionUrl, $data);
            $info = json_decode($resp, true);
            var_dump($info);
            if (isset($info['error_response'])) {
                $this->taoBaoKe->setError($info['error_response']['code']  . '&' . $info['error_response']['msg'] );
                return false;
            }

            return \current($info);
        } catch (\Exception $exception) {
            $this->taoBaoKe->setError($exception->getMessage());
            return false;
        }
    }

    private function generateSign(array $attributes, $secretKey)
    {
        ksort($attributes);
        $stringToBeSigned = $secretKey;
        foreach ($attributes as $k => $v) {
            if (!is_array($v) && "@" != substr($v, 0, 1)) {
                $stringToBeSigned .= "$k$v";
            }
        }
        unset($k, $v);
        $stringToBeSigned .= $secretKey;
        return strtoupper(md5($stringToBeSigned));
    }
}