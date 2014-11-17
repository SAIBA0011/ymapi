<?php namespace Saiba\Ymapi\Events;

use Saiba\Ymapi\Core\XmlRenderer;
use Saiba\Ymapi\Core\Request;

class Event {
    public function getIds($callOptions = [])
    {
        $renderer = new XmlRenderer();
        $xml = $renderer->render('Sa.Events.All.GetIDs', $callOptions);
        $request = new Request($xml);
        $result = $request->call();
        return $result;
    }
} 