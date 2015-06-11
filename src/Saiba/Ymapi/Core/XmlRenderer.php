<?php namespace Saiba\Ymapi\Core;

use ManiaLib\XML\Node;
use ManiaLib\XML\Rendering\Renderer;
use Config;

class XmlRenderer {

    protected $pubkey;
    protected $prikey;
    protected $sapass;
    protected $version;

    function __construct()
    {
        $this->pubkey = Config::get('ymapi::pubkey');
        $this->prikey = Config::get('ymapi::prikey');
        $this->sapass = Config::get('ymapi::sapass');
        $this->version = Config::get('ymapi::version');
    }

    public function render($call, $sessionID = false, $callOptions = [], $additionalFields = [])
    {
        $root = Node::create()
            ->setNodeName('YourMembership');
        Node::create()
            ->setNodeName('Version')
            ->setNodeValue($this->version)
            ->appendTo($root);
        Node::create()
            ->setNodeName('ApiKey')
            ->setNodeValue($this->prikey)
            ->appendTo($root);
        Node::create()
            ->setNodeName('CallID')
            ->setNodeValue($this->randomCallID())
            ->appendTo($root);

            if( $sessionID )
            {
                Node::create()
                    ->setNodeName('SessionID')
                    ->setNodeValue($sessionID)
                    ->appendTo($root);
            }

        Node::create()
            ->setNodeName('SaPasscode')
            ->setNodeValue($this->sapass)
            ->appendTo($root);
        $call = Node::create()
            ->setNodeName('Call')
            ->setAttribute('Method', $call)
            ->appendTo($root);
        /**
         * Adding Additional Fields
         */
        if ( ! empty($additionalFields)) {

            $customResponses = Node::create()
                ->setNodeName('CustomFieldResponses')
                ->appendTo($call);

            foreach($additionalFields as $key => $val)
            {
                $customFieldNode= Node::create()
                    ->setNodeName('CustomFieldResponse')
                    ->setAttribute('FieldCode', $key)
                    ->appendTo($customResponses);

                $values = Node::create()
                    ->setNodeName('Values')
                    ->appendTo($customFieldNode);

                Node::create()
                    ->setNodeName('Value')
                    ->setNodeValue($val)
                    ->appendTo($values);
            }
        }

        if ( ! empty($callOptions)) {
            foreach( $callOptions as $option => $val ) {
                Node::create()
                    ->setNodeName($option)
                    ->setNodeValue($val)
                    ->appendTo($call);
            }
        }
        $renderer = new Renderer();
        $renderer->setRoot($root);
        $xml = $renderer->getXML();
        return $xml;
    }

    protected function randomCallID()
    {
        $rand = mt_rand(111111,999999);
        return $rand;
    }
}