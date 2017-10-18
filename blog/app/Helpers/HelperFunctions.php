<?php
namespace App\Helpers;

class HelperFunctions
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

    /**
     * Random string generator.  I use this for creating a Cookie but it could
     * be used for other things for sure.
     * 
     * @param  integer  $length The length of the random string.
     * @return string   
     */
    static function generateRandomString($length = 10) {
        $characters = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
        $charactersLength = strlen($characters);
        $randomString = '';
        for ($i = 0; $i < $length; $i++) {
            $randomString .= $characters[rand(0, $charactersLength - 1)];
        }
        return $randomString;
    }
}

?>