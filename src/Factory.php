<?php
/**
 * Created by PhpStorm.
 * User: baia
 * Date: 2019-10-02
 * Time: 13:28
 */

namespace TaoBaoKe;


class Factory
{
    private $config;
    private $error;

    public function __construct($config = null)
    {
        if (empty($config)) {
            throw new \Exception('no config');
        }
        $this->config = $config;
    }

    public function __get($api)
    {
        try {
            $classname = __NAMESPACE__ . "\\Api\\" . ucfirst($api);
            if (!class_exists($classname)) {
                throw new \Exception('api undefined');
            }
            $new = new $classname($this->config, $this);
            return $new;
        } catch (\Exception $e) {
            throw new \Exception('api undefined');
        }
    }

    public function setError($message)
    {
        $this->error = $message;
    }

    public function getError()
    {
        return $this->error;
    }

}