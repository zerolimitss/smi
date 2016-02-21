<?php

/**
 * Created by PhpStorm.
 * User: Prime1
 * Date: 06.02.2016
 * Time: 8:14
 */
class Post extends Static_Page
{
    protected $post;
    protected $subcategory;


    protected function input($par)
    {
        parent::input();
        if(isset($par)){
            $id = (int)$par['id'];
            $this->post = $this->obm->get_post_by_id($id);

            //получаем масив 0-категория, 1-субкатегория
            $cat = $this->obm->get_cat_and_subcat_by_post($id);

            $this->id = $cat[0];
            $this->subId = $cat[1];

            $this->subcategory = $this->obm->get_subcat($this->id);
        }
        $this->title .= $this->post['title'];
        $this->keywords = $this->post['keywords'];
        $this->description = $this->post['description'];
    }

    protected function output()
    {
        $this->content = $this->render('post',[
            'main_news'=>$this->post,
            'subcategory'=>$this->subcategory,
            'catid'=>$this->id,
            'subid'=>$this->subId
        ]);
        $this->page = parent::output();
    }
}