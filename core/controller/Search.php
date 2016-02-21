<?php

/**
 * Created by PhpStorm.
 * User: Prime1
 * Date: 06.02.2016
 * Time: 8:14
 */
class Search extends Static_Page
{
    protected $currentPage;
    protected $nav;
    protected $str;


    protected function input($par)
    {
        parent::input();
        $this->title .= "Поиск / ";
        if($_SERVER['REQUEST_METHOD']=='POST'){
            if(empty($_POST['txt'])) throw new EException("Error 404 ");
            $this->str = $this->clear_str($_POST['txt']);
        }elseif(!empty($par)){
            $this->str = rawurldecode($par['str']);
        }else{
            return false;
        }

        if(isset($par['page'])){
            $this->currentPage = (int)$par['page'];
            if($this->currentPage==0)  throw new EException("Error 404 ");
        }else{
            $this->currentPage = 1;
        }

        $this->keywords = "Поиск новостей";
        $this->description = "Поиск";

        $this->rightBarBool = false;
        $this->leftBarBool = false;
        $pager = new Pagination('posts',QUANTITY,$this->id,$this->currentPage,$this->str);
        $this->last_news = $pager->get_posts();
        $this->nav = $pager->get_nav();
    }

    protected function output()
    {
        $this->content=$this->render('search',[
            'last_news'=>$this->last_news,
            'str'=>rawurlencode($this->str),
            'nav'=>$this->nav
        ]);


        $this->page = parent::output();
    }
}