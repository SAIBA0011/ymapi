<?php namespace Saiba\Ymapi\Core;

use Config;
use Exception;

class Session {

    protected $sessionID;

    public function create()
    {
        $renderer = new XmlRenderer();
        $xml = $renderer->render('Session.Create');
        $request = new Request($xml);
        $result = $request->call();
        $this->sessionID = $result->{'Session.Create'}->SessionID;

        $callOptions = [ 'Username' => Config::get('ymapi::username'), 'Password' => Config::get('ymapi::password') ];

        $renderer = new XmlRenderer();
        $xml = $renderer->render('Sa.Auth.Authenticate', $result->{'Session.Create'}->SessionID, $callOptions);
        $request = new Request($xml);
        $authed = $request->call();

        if (isset($authed->{'Sa.Auth.Authenticate'}->ID)) {
            return $this->sessionID;
        }
        throw new Exception('Authentication Failed!');
    }
}
