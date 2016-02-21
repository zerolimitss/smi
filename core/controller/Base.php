<?php

abstract class Base
{
    protected $requst_url;
    protected $name_controller;
    protected $params = [];
    protected $error;
    protected $page;

    protected function clear_str($str)
    {
        return strip_tags(trim($str));
    }

    public function init()
    {
        if(class_exists($this->name_controller)){
            $ob1 = new $this->name_controller;
            if(method_exists($ob1,'request'))
                $ob1->request($this->params);
        }else{
           throw new EException("Такой страницы не существует");
        }
    }

    protected function request($par=[])
    {
        $this->input($par);
        $this->output();
        $this->get_page();
    }

    protected function render($file, $param=[])
    {
        extract($param);
        ob_start();
        include(VIEW.$file.'.php');
        return ob_get_clean();
    }

    protected function input($par=[])
    {

    }

    protected function output()
    {

    }

    protected function get_page()
    {
        echo $this->page;
    }

}