<?php namespace Saiba\Ymapi\Auth;

use Saiba\Ymapi\Core\XmlRenderer;
use Saiba\Ymapi\Core\Request;

class Auth {
    public function Authenticate($callOptions)
    {
        $renderer = new XmlRenderer();
        $xml = $renderer->render('Sa.Auth.Authenticate', $callOptions);
        $request = new Request($xml);
        $result = $request->call();
        return $result;
    }
} 