<?php

class Index_Controller extends Static_Page
{
    protected function input()
    {
        parent::input();
        $this->title .= "Главная";
        $this->keywords = "актуальные новости, сми, news";
        $this->description = "Только актуальные новости на данный момент";
        $this->main_news = $this->obm->get_main_new();
        $this->last_news = $this->obm->get_last_news('0,20');

        //print_r($this->last_news1);
    }

    protected function output()
    {


        $this->content = $this->render('content',[
            'main_news'=> $this->main_news,
            'last_news'=>$this->last_news
        ]);

        $this->page = parent::output();
    }
}