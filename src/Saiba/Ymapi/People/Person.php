<?php namespace Saiba\Ymapi\People;

use Saiba\Ymapi\Core\BaseModel;
use Saiba\Ymapi\Core\XmlRenderer;
use Saiba\Ymapi\Core\Request;
use Config;

class Person extends BaseModel {

    public function search($callOptions)
    {
        $renderer = new XmlRenderer();
        $xml = $renderer->render('People.All.Search', $this->sessionId, $callOptions);
        $request = new Request($xml);
        $result = $request->call();
        return $result;
    }

    public function create($callOptions = [])
    {
        $renderer = new XmlRenderer();
        $xml = $renderer->render('Sa.Members.Profile.Create', $this->sessionId, $callOptions);
        $request = new Request($xml);
        $result = $request->call();
        return $result;
    }
}