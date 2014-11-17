<?php namespace Saiba\Ymapi\People;

use Saiba\Ymapi\Core\XmlRenderer;
use Saiba\Ymapi\Core\Request;

class Person {

    public function search($callOptions)
    {
        $renderer = new XmlRenderer();
        $xml = $renderer->render('People.All.Search', $callOptions);
        $request = new Request($xml);
        $result = $request->call();
        return $result->{'People.All.Search'}->Results;
    }

    public function create($callOptions = [])
    {
        $renderer = new XmlRenderer();
        $xml = $renderer->render('Sa.Members.Profile.Create', $callOptions);
        $request = new Request($xml);
        $result = $request->call();
        return $result;
    }
}