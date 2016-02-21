<?php

class Showpages extends Admin_Base
{
    private $pages;
    protected function input($par = [])
    {
        parent::input();
        $model = Model::get_instance();

        $this->pages = $model->get_footer();

        if(isset($par['mes']))
            $this->message = urldecode($par['mes']);
        if(isset($par['error']))
            $this->error[] = urldecode($par['error']);
    }

    protected function output()
    {

        $this->content = $this->render("admin/showpages",[
            'pages'=>$this->pages,
            'message'=>$this->message,
            'error'=>$this->error
        ]);

        $this->page = parent::output();
    }
}