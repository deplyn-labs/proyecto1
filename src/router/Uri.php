<?php

class Uri {

    var $uri;
    var $method;
    var $function;
    var $matches;
    protected $request;
    protected $response;

    public function __construct($uri, $method, $function) {
        $this->uri = $uri;
        $this->method = $method;
        $this->function = $function;
    }

    public function match($url) {
        $path = preg_replace('#:([\w]+)#', '([^/]+)', $this->uri);
        $regex = "#^$path$#i";
        if (!preg_match($regex, $url, $matches)) {
            return false;
        }
        if ($this->method != $_SERVER['REQUEST_METHOD'] && $this->method != "ANY") {
            return false;
        }
        array_shift($matches);
        $this->matches = $matches;
        return true;
    }

    private function execFunction() {
        $this->parseRequest();
        $this->response = call_user_func_array($this->function, $this->matches);
    }

    private function formatCamelCase($string) {
        $parts = preg_split("[-|_]", strtolower($string)); //listar_usuarios. = ["listas", "Usuarios"]
        $finalString = "";
        $i = 0;
        foreach ($parts as $parts) {
            $finalString .= ($i = 0) ? strtolower($parts) : ucfirst($parts);
            $i++;
        }
        return $finalString;
    }

    private function getParts() {
        $parts = array();
        if (strpos($this->function, "@")) {
            $methodParts = explode("@", $this->function);
            $parts["class"] = $methodParts[0];
            $parts["method"] = $methodParts[1];
        } else {
            $parts["class"] = $this->function;
            $parts["method"] = ($this->uri == "/") ? "index" : $this->formatCamelCase($this->uri);
        }
        return $parts;
    }

    private function functionFromController() {
        $parts = $this->getParts();
        $class = $parts["class"];
        $method = $parts["method"];
        //Importamos el controlador...
        if (!$this->importController($class)) {
            return;
        }
        //Preparar la ejeución...
        $this->parseRequest();
        $classInstance = new $class();
        $classInstance->setRequest($this->request);
        //Lanzamos el método...
        $launch = array($classInstance, $method);
        if (is_callable($launch)) {
            $this->response = call_user_func_array($launch, $this->matches);
        } else {
            throw new Exception("El método $class.$method no existe.", -1);
        }
    }

    public function call() {
        try {
            $this->request = $_REQUEST;
            if (is_string($this->function)) {
                $this->functionFromController();
            } else {
                $this->execFunction();
            }
            $this->printResponse();
        } catch (Exception $ex) {
            echo "ERROR: " . $ex->getMessage();
        }
    }

    private function parseRequest() {
        $this->request = new Request($this->request);
        $this->matches[] = $this->request;
    }

    private function printResponse() {
        if (is_string($this->response)) {
            echo $this->response;
        } else if (is_object($this->response) || is_array($this->response)) {
            $res = new Respuesta();
            echo $res->json($this->response);
        }
    }

    public function importController($class) {
        $file = PATH_CONTROLLERS . $class . ".php";
        if (!file_exists($file)) {
            throw new Exception("El controlador ($file) no existe.");
            return false;
        }
        require_once $file;
        return true;
    }

}
