<?php namespace Saiba\Ymapi\People;

use Saiba\Ymapi\Core\BaseModel;
use Saiba\Ymapi\Core\XmlRenderer;
use Saiba\Ymapi\Core\Request;
use Config;

class Person extends BaseModel {

    /**
     * Search for members
     *  
     * @param  [type] $callOptions [description]
     * @return [type]              [description]
     */
    public function search($callOptions)
    {
        $renderer = new XmlRenderer();
        $xml = $renderer->render('People.All.Search', $this->sessionId, $callOptions);
        $request = new Request($xml);
        $result = $request->call();
        return $result;
    }

    /**
     * Create profile
     * 
     * @param  array  $callOptions [description]
     * @return [type]              [description]
     */
    public function create($callOptions = [])
    {
        $renderer = new XmlRenderer();
        $xml = $renderer->render('Sa.Members.Profile.Create', $this->sessionId, $callOptions);
        $request = new Request($xml);
        $result = $request->call();
        return $result;
    }

    /**
     * Update Profile
     * 
     * @param  array  $callOptions      
     * @param  array  $additionalFields 
     * @return [type]                   
     */
    public function update($callOptions = [], $additionalFields = [])
    {
        $renderer = new XmlRenderer();
        $xml = $renderer->render('Sa.People.Profile.Update', $this->sessionId, $callOptions, $additionalFields);
        $request = new Request($xml);
        $result = $request->call();
        return $result;
    }
}