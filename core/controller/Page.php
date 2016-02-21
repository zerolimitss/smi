<?php

class Page extends Static_Page
{
    protected $page;


    protected function input($par)
    {
        parent::input();
        if(isset($par)){
            $id = (int)$par['id'];
        }else{
            return false;
        }
        $this->page = $this->obm->get_page_by_id($id);
        $this->title .= $this->page['title'];
        $this->keywords = $this->page['keywords'];
        $this->description = $this->page['description'];
    }

    protected function output()
    {
        $this->content = $this->render('page',[
            'page'=>$this->page
        ]);
        $this->page = parent::output();
    }
}