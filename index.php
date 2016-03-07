<?php
const ACCESS = TRUE;
error_reporting(1);
header('Content-Type: text/html; charset=utf-8');
require_once 'config.php';
setlocale(LC_ALL, 'ru_RU.UTF-8');
set_include_path(get_include_path().PATH_SEPARATOR.
                    MODEL.PATH_SEPARATOR.
                    CONTROLLER.PATH_SEPARATOR.
                    LIB
                    );

function __autoload($name)
{
    $p = $name.'.php';

    if(!include_once($p)){
        try {
            throw new EException('No file');
        }catch (EException $e){
            //echo $e->getMessage();
        }
    }
}
$ob = Get_Params::get_instance();
$ob->init();