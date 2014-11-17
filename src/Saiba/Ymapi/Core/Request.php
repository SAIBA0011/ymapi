<?php namespace Saiba\Ymapi\Core;

class Request {

    protected $url;
    protected $xml;
    function __construct($xml)
    {
        $this->url = "https://api.yourmembership.com";
        $this->xml = $xml;
    }

    public function call()
    {
        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, $this->url);
        curl_setopt($ch, CURLOPT_POSTFIELDS,
            "xmlRequest=" . $this->xml);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
        curl_setopt($ch, CURLOPT_CONNECTTIMEOUT, 300);
        $data = curl_exec($ch);
        curl_close($ch);
        $result = simplexml_load_string($data);
        return $result;
    }
} 