<?php

class Controller
{
    protected $load;
    protected $data=array();
    public function __construct()
    {
        $this->load = new Loader();
    }
    protected function redirect($url, $message=null, $wait = 0)
    {

        extract($message);
        if($wait == 0) {
            include VIEWS_PATH."/$url";
        } else {
            include VIEWS_PATH . "message.html";
        }
        exit;
    }
}