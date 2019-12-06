<?php

declare(strict_types = 1);

namespace Vgip\Intime\Error;

class Error 
{
    private $error = [];
    
    public function setErrorMessage(string $key, string $message)
    {
        $this->error[$key] = $message;
    }
    
    public function getErrorAll()
    {
        return $this->error;
    }
    
    public function setErrorMessageAll(Error $error)
    {
        $this->error = array_merge($this->error, $error->getErrorAll());
    }
    
    public function getErrorCounter()
    {
        $counter = count($this->error);
        
        return $counter;
    }
}
