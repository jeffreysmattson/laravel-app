<?php
namespace App\Helpers;

class visitors
{
    static function getUserIP(){
        $client  = @$_SERVER['HTTP_CLIENT_IP'];
        $forward = @$_SERVER['HTTP_X_FORWARDED_FOR'];
        $remote  = $_SERVER['REMOTE_ADDR'];

        if(filter_var($client, FILTER_VALIDATE_IP))
        {
            $ip = $client;
        }
        elseif(filter_var($forward, FILTER_VALIDATE_IP))
        {
            $ip = $forward;
        }
        else
        {
            $ip = $remote;
        }

        return $ip;
    }

    static function removeHyphensFromKeys( $array ){
        if(!is_array($array)){
            return;
        }

        $removed = array();
        foreach($array as $key => $value){
            $removed[str_replace('-', '', $key)] = $value;
        }

        return $removed;
    }
}

?>