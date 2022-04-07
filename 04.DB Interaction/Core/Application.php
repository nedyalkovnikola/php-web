<?php


namespace Core;

class Application
{
    const FRONTEND_FOLDER = 'Frontend';

    public function loadTemplate($templateName, $data = null)
    {
        include self::FRONTEND_FOLDER 
        . '/' 
        . $templateName 
        . '.php';
    }
}