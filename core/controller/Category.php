<?php

/**
 * Created by PhpStorm.
 * User: Prime1
 * Date: 02.02.2016
 * Time: 11:06
 */
class Category extends Static_Page
{

    protected function input($par=[])
    {
        parent::input();

        $this->keywords = "актуальные новости, сми, news";
        $this->description = "Только актуальные новости на данный момент";

        if(!empty($par)){
            if(isset($par['id'])){
                $id = (int)$par['id'];
                if($id==0) throw new EException("Error 404 ");

                $this->id = $id;
                $this->subcategory = $this->obm->get_subcat($id);
                $this->title .= $this->obm->get_cat_title($id);

                if(isset($par['sub'])){
                    $sub = (int)$par['sub'];
                    if($sub==0) return false;
                    $this->subId = $sub;

                    $this->title .= " / ".$this->obm->get_cat_title($sub);
                    $this->main_news = $this->obm->get_main_new($sub,true);
                    $this->last_news = $this->obm->get_last_news('0,10', $sub,true);
                }else {
                    $this->main_news = $this->obm->get_main_new($id);
                    $this->last_news = $this->obm->get_last_news('0,10', $id);
                }
            }else{
                throw new EException("Error 404 ");
            }
        }else{
            throw new EException("Error 404 ");
        }

        //print_r($this->last_news1);
    }

    protected function output()
    {


        $this->content = $this->render('category',[
            'subcategory'=>$this->subcategory,
            'main_news'=> $this->main_news,
            'last_news'=>$this->last_news,
            'catid'=>$this->id,
            'subid'=>$this->subId
        ]);

        //print_r($this->main_day_news);
        $this->page = parent::output();
    }
}