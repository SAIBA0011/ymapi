<?php namespace Saiba\Ymapi\Core;

use Saiba\Ymapi\Auth\Auth;
use Config;

class Check {

    public function result($result)
    {
        switch($result->ErrCode) {
            case 0:
                return true;
                break;
            case 101:
                die('[Version] is missing, invalid or unrecognized');
                break;
            case 102:
                die('[ApiKey] is missing or invalid');
                break;
            case 103:
                die('[SaPassCode] is invalid');
                break;
            case 201:
                ( new Session() )->create();
                return false;
                break;
            case 202:
                ( new Session() )->create();
                return false;
                break;
            case 301:
                die('[CallID] is missing or invalid');
                break;
            case 302:
                die('[CallID] has already been used during this session');
                break;
            case 401:
                die('Invalid method call');
                break;
            case 402:
                ( new Session() )->create();
                return false;
                break;
            case 403:
                $details = [ 'Username' => Config::get('ymapi::username'), 'Password' => Config::get('ymapi::password') ];
                ( new Auth() )->Authenticate($details);
                return false;
                break;
            case 404:
                die('Method call failed. One or more arguments is missing or invalid');
                break;
            case 405:
                die('Method requires SA authority. Proper credentials must be supplied');
                break;
            case 406:
                die('Method could not uniquely identify a record on which to operate');
                break;
            case 901:
                die('Invalid HTTP request');
                break;
            case 902:
                die('XML Packet is malformed or otherwise unreadable');
                break;
            case 998:
                die('The API service is currently unavailable');
                break;
            case 999:
                die('An unknown error has occured');
                break;
        }
    }

} 