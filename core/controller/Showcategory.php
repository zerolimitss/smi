<?php

class Showcategory extends Admin_Base
{
    protected $category;
    protected $subcat;
    protected function input($par = [])
    {
        parent::input();
        $this->category = $this->obm_u->get_category();

        $this->subcat = $this->obm_u->get_sub_category();
        if(isset($par['mes']))
            $this->message = urldecode($par['mes']);

        if(isset($par['error']))
            $this->error[] = urldecode($par['error']);
    }

    protected function output()
    {

        $this->content = $this->render("admin/category",[
            'category'=>$this->category,
            'subcat'=>$this->subcat,
            'message'=>$this->message,
            'error'=>$this->error
        ]);
        $this->page = parent::output();
    }
}