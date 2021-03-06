<?php namespace Saiba\Ymapi\Events;

use Saiba\Ymapi\Core\BaseModel;
use Saiba\Ymapi\Core\XmlRenderer;
use Saiba\Ymapi\Core\Request;

class Event extends BaseModel {

    public function getIds($callOptions = [])
    {
        $renderer = new XmlRenderer();
        $xml = $renderer->render('Sa.Events.All.GetIDs', $this->sessionId, $callOptions);
        $request = new Request($xml);
        $result = $request->call();
        return $result;
    }
} 