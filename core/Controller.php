<?php

namespace core;

use app\classes\Uri;
use app\exceptions\ControllerNotExitException;

class Controller
{
    private $uri;
    private $controller;
    private $namespace;
    private $folders = [
        'app\controllers\portal',
        'app\controllers\admin',
    ];

    public function __construct()
    {
        $this->uri = Uri::uri();
    }

    public function load()
    {
        if ($this->isHome()) {
            return $this->controllerHome();
        }

        return $this->controllerNotHome();
    }

    public function getController()
    {
    }

    private function isHome()
    {
        return $this->uri === '/';
    }

    private function controllerExist($controller)
    {
        $controllerExist = false;
        foreach ($this->folders as $folder) {
            if (class_exists($folder.'\\'.$controller)) {
                $controllerExist = true;
                $this->namespace = $folder;
                $this->controller = $controller;
            }
        }

        return $controllerExist;
    }

    private function instantiateController()
    {
        $controller = $this->namespace.'\\'.$this->controller;

        return new $controller();
    }

    private function controllerHome()
    {
        if (!$this->controllerExist('HomeCOntroller')) {
            throw new ControllerNotExitException('Esse controller não existe');
        }

        return $this->instantiateController();
    }

    private function controllerNotHome()
    {
    }
}
