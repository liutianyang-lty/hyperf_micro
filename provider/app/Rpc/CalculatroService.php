<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2020/6/5 0005
 * Time: 20:54
 */
namespace App\Rpc;
/**
 * 服务名称、服务协议、
 * @RpcService(name="CalculatroService", protocol="jsonrpc-http", server="jsonrpc-http")
 */
class CalculatroService
{
    public function add(int $a, int $b)
    {
        return $a + $b;
    }

    public function minus(int $a, int $b)
    {
        return $a - $b;
    }
}