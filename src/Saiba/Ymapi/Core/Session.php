<?php namespace Saiba\Ymapi\Core;

class Session {

    protected $sessionID;

    public function create()
    {
        $renderer = new XmlRenderer();
        $xml = $renderer->render('Session.Create');
        $request = new Request($xml);
        $result = $request->call();
        $this->sessionID = $result->{'Session.Create'}->SessionID;
        $this->setSession();
        return true;
    }

    public function setSession()
    {
        setcookie("YMSessionid", $this->sessionID, time() + (60 * 19));
    }
}