<?php

/**
 * Created by PhpStorm.
 * User: Prime1
 * Date: 06.02.2016
 * Time: 8:14
 */
class Archive extends Static_Page
{
    protected $post;
    protected $subcategory;
    protected $currentPage;
    protected $nav;
    protected $category;


    protected function input($par)
    {
        parent::input();
        $this->title .= "Архив / ";
        if(isset($par['id'])){
            $id = (int)$par['id'];
            $this->title .= $this->obm->get_cat_title($id);
        }else{
            throw new EException("Error 404 ");
        }

        $this->id = $id;

        //получить меню селект
        $this->category = $this->obm->get_leftbar();

        if(isset($par['page'])){
            $this->currentPage = (int)$par['page'];
            if($this->currentPage==0)  throw new EException("Error 404 ");
        }else{
            $this->currentPage = 1;
        }

        $this->keywords = "Архив новостей";
        $this->description = "Archive";

        $this->leftBarBool = false;

        $pager = new Pagination('posts',QUANTITY_A,$this->id,$this->currentPage);
        $this->last_news = $pager->get_posts();
        $this->nav = $pager->get_nav();
    }

    protected function output()
    {

        $this->content=$this->render('archive',[
            'last_news'=>$this->last_news,
            'catid'=>$this->id,
            'subcategory'=>$this->subcategory,
            'nav'=>$this->nav,
            'category'=>$this->category
        ]);
        $this->page = parent::output();
    }
}