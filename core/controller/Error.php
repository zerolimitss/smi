<?php

class Error extends Static_Page
{
    protected $emes;

    protected function input($par)
    {
        parent::input();
        if(isset($par)){
            $this->emes = urldecode($par['mes']);
        }else{
            return false;
        }
        $this->rightBarBool = false;
        $this->title .= "Ошибка";
    }

    protected function output()
    {
        $this->content = $this->render('error',[
            'emes'=>$this->emes
        ]);
        $this->page = parent::output();
    }
}