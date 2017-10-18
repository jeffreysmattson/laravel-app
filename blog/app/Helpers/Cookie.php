<?php
namespace App\Helpers;

use App\Helpers\HelperFunctions;

class Cookie
{
    private $cookieName = '';
    private $cookieValue = '';
    private $cookieExpire = '';
    private $cookieDomain = '';
    private $cookieSecure = '';
    private $cookieHttpOnly = '';
    private $userIp = '';

    /**
     * Create the instance and set the user ip.
     * 
     * @param void
     */
    function __construct($userIp = ''){
        $this->userIp = $userIp;
    }

    /**
     * Set the cookie in the users browser
     */
    function setCookieNow(){
        $result = setCookie(
            $this->cookieName,
            $this->cookieValue,
            $this->cookieExpire,
            $this->cookieDomain,
            $this->cookieSecure,
            $this->cookieHttpOnly
        );
        return $result;
    }

    /**
     * Create the cookie.
     *
     * Base 64 encoding the identifier since sometimes this is the ip address of the
     * user.  We don't want to scare them if they happen to look at the cookie.
     *
     * @param int   $length    Length of the random string part of the Cookie
     * @return void
     */
    function createCookieValue($length = 10, $identifier = ''){
        if('' != $identifier){
            $identifier = base64_encode($identifier);
            $identifier = $identifier."-";
        }
        $randomString = HelperFunctions::generateRandomString($length);
        $this->cookieValue = $identifier.hash("md5",$randomString);
    }

    /**
     * Get the cookie value.
     * 
     * @return void
     */
    function getCookieValue(){
        return $this->cookieValue;
    }

    /**
     * Read the cookie.
     * 
     * @return [type] [description]
     */
    function readCookie(){
        echo "<pre>";
        var_dump($_COOKIE);
        echo "</pre>";
    }

    /**
     * Set the cookie name.
     * 
     * @param   string    $name
     * @return  void
     */
    public function setCookieName($name){
        $this->cookieName = $name;
    }

    /**
     * Set the cookie value.
     * 
     * @param   string    $value
     * @return  void
     */
    public function setCookieValue($value){
        $this->cookieValue = $value;
    }

    /**
     * Set the cookie expire.
     * 
     * @param   string    $expire
     * @return  void
     */
    public function setCookieExpire($expire){
        $this->cookieExpire = $expire;
    }

    /**
     * Set the cookie domain.
     * 
     * @param   string    $domain
     * @return  void
     */
    public function setCookieDomain($domain){
        $this->cookieDomain = $domain;
    }

    /**
     * Set the cookie Secure.
     * 
     * @param   string    $secure
     * @return  void
     */
    public function setCookieSecure($secure){
        $this->cookieSecure = $secure;
    }

    /**
     * Set the cookie Http only.
     * 
     * @param   string    $http
     * @return  void
     */
    public function setCookieHttpOnly($http){
        $this->cookieHttpOnly = $http;
    }
}