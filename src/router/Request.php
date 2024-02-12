<?php

class Request {

    protected $request;
    protected $data;
    public $method;

    public function __construct($request, $flag = true) {
        $this->request = $request;
        $this->extractData();
        $this->setExtraData($flag);
    }

    public function extractData() {
        $this->data = array();
        foreach ($this->request as $key => $value) {
            if (is_object($value) || is_array($value)) {
                $this->data[$key] = new Request($value, false);
            } else {
                if ($key != "http_referer") {
                    $this->data[$key] = $value;
                }
            }
        }
    }

    public function setExtraData($flag) {
        if ($flag == true) {
            $this->method = $_SERVER["REQUEST_METHOD"];
            $this->data["http_referer"] = isset($_SERVER["HTTP_REFERER"]) ? $_SERVER["HTTP_REFERER"] : null;
            $headers = apache_request_headers();
            $this->data["headers"] = new Request($headers, false);
        }
    }

    public function __get($key) {
        return isset($this->data[$key]) ? $this->data[$key] : null;
    }

    public function __set($key, $value) {
        $this->data[$key] = $value;
    }

    public function all() {
        return $this->data;
    }

}
