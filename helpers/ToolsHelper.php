<?php


namespace app\helpers;


class ToolsHelper
{
    //获取IP
    public static function getIp()
    {
        if ($_SERVER["HTTP_CLIENT_IP"] && strcasecmp($_SERVER["HTTP_CLIENT_IP"], "unknown")) {
            $ip = $_SERVER["HTTP_CLIENT_IP"];
        } else {
            if ($_SERVER["HTTP_X_FORWARDED_FOR"] && strcasecmp($_SERVER["HTTP_X_FORWARDED_FOR"], "unknown")) {
                $ip = $_SERVER["HTTP_X_FORWARDED_FOR"];
            } else {
                if ($_SERVER["REMOTE_ADDR"] && strcasecmp($_SERVER["REMOTE_ADDR"], "unknown")) {
                    $ip = $_SERVER["REMOTE_ADDR"];
                } else {
                    if (isset ($_SERVER['REMOTE_ADDR']) && $_SERVER['REMOTE_ADDR'] && strcasecmp($_SERVER['REMOTE_ADDR'],
                            "unknown")
                    ) {
                        $ip = $_SERVER['REMOTE_ADDR'];
                    } else {
                        $ip = "unknown";
                    }
                }
            }
        }
        return ($ip);
    }

    //获取到凌晨的时间戳
    public static function getDayEndLimit(){
        $today = strtotime(date("Y-m-d"),time());
        $todayend = $today+60*60*24;
        $now = time();
        return $todayend - $now;
    }

    public static function getKeyValue($json){
        if($json!=null){
            $list = json_decode($json,true);
            $keyvalue = array();
            foreach ($list as $item){
                $keyvalue[$item['key']] = $item['value'];
            }
            return $keyvalue;
        }
        return null;
    }
}