<?php
namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests;
use App;
use App\Helpers\HelperFunctions;
use App\Helpers\Cookie;

class Images extends Controller
{
    // First Controller
    public function index(){
        $userIp = HelperFunctions::getUserIP();
        
        $this->visitorProcess($userIp);
        $this->updateVisitorMeta($userIp);

        $cookie = new Cookie();
        $cookie->setCookieName('GSXR-750');
        $cookie->createCookieValue(100, $userIp);
        echo $cookie->getCookieValue();
    }

    /**
     * Increment the visit number
     * 
     * @param  int          $currentCount   
     * @return boolean      True on success false on fail.
     */
    private function incrementVisitCount( $currentCount ){
        $visitor = new App\Visitors;
        $visitor->NumVisits = $currentCount++;
        $visitor->save();
    }

    /**
     * Check if user ip has already been here.
     * 
     * @param  [type] $userIp [description]
     * @return [type]         [description]
     */
    private function visitorProcess( $userIp ){
        
        // Check if ip all ready exists.
        $visitor = new App\Visitors;
        $visitorIpExist = $visitor::where('UserIp', $userIp)->first();
        $visits = $visitorIpExist->UserIp;
        if(null != $visitorIpExist){
            $visitor->increment('NumVisits');
            return true;
        }
        $visitor->UserIp = $userIp;
        $visitor->NumVisits = 1;
        return $visitor->save();
    }

    /**
     * Update the visitors meta data.
     * 
     * @return void
     */
    private function updateVisitorMeta( $userIp ){
        $rawHeaders = getallheaders();
        $cleanHeaders = HelperFunctions::removeHyphensFromKeys( $rawHeaders );
        
        extract($cleanHeaders);

        // Add associated meta to table.
        $visitorsMeta = new App\VisitorsMeta;
        $visitorsMeta->UserIp = $userIp;
        $visitorsMeta->SessionHeaderArray = implode("|",$rawHeaders);
        $visitorsMeta->host             = $Host;
        $visitorsMeta->UserAgent        = $UserAgent;
        $visitorsMeta->Accept           = $Accept;
        $visitorsMeta->AcceptLanguage   = $AcceptLanguage;
        $visitorsMeta->AcceptEncoding   = $AcceptEncoding;
        $visitorsMeta->Cookie           = $Cookie;
        $visitorsMeta->save();
    }
}
