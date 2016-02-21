<?php

class News extends Admin_Base
{

    private $category;
    private $id;
    private $current_page;
    private $posts;
    private $nav;
    private $h2;
    protected function input($par = [])
    {
        parent::input();
        $model = Model::get_instance();

        $this->category = $model->get_leftbar();
        if(!empty($par['id'])){
            $this->id = (int)$par['id'];
        }else{
            $this->id = 0;
        }

        if(!empty($par['page'])){
            $this->current_page = (int)$par['page'];
        }else{
            $this->current_page = 1;
        }

        $page = new Pagination('posts',QUANTITY_A,$this->id,
            $this->current_page);
        $this->posts = $page->get_posts();
        $this->nav = $page->get_nav();

        if($this->id>0)
            $this->h2 = $model->get_cat_title($this->id);

        if(isset($par['mes']))
            $this->message = urldecode($par['mes']);
    }

    protected function output()
    {

        $this->content = $this->render("admin/news",[
            'category'=>$this->category,
            'catid'=>$this->id,
            'nav'=>$this->nav,
            'posts'=>$this->posts,
            'title'=>$this->h2,
            'mes'=>$this->message
        ]);

        $this->page = parent::output();
    }
}