<?php namespace Saiba\Ymapi\Core;

use Config;

class BaseModel {

    protected $sessionId;

    public function __construct()
    {
        $this->sessionId = (new Session())->create();
    }

} 