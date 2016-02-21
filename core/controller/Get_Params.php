<?php

class Get_Params extends Base
{
    static $instance;

    protected function __construct()
    {
        $url = $_SERVER['REQUEST_URI'];
        $url = substr($url,1);
        $arr = explode('/',$url);
        array_shift($arr);
        if(!empty($arr[0])){
            $this->name_controller = ucfirst($this->clear_str($arr[0]));
            if(isset($arr[1]) && isset($arr[2])){
                array_shift($arr);
                $ke = [];
                $ve = [];
                foreach ($arr as $k=>$v) {
                    if($k%2 === 0){
                        $ke[]=$this->clear_str($v);
                    }else{
                        $ve[]=$v;
                    }
                }
                if(!$this->params = array_combine($ke,$ve)){
                    throw new EException("Не правильный адресс",$url);
                }
            }
        }
        else{
            $this->name_controller = 'Index_Controller';
        }

    }

    static function get_instance()
    {
        if(self::$instance instanceof self){
            return self::$instance;
        }else{
            return self::$instance = new self;
        }
    }
}