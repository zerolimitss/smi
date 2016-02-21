<?php


abstract class Static_Page extends Base
{
    protected $header;
    protected $left_bar;
    protected $right_bar;
    protected $content;
    protected $footer;

    protected $left_menu;
    protected $footer_pages;
    protected $right_news;
    protected $rightBarBool = true;
    protected $leftBarBool = true;
    protected $subcategory;
    protected $keywords;
    protected $description;
    protected $styles;
    protected $scripts;
    protected $title;
    protected $main_news;
    protected $main_day_news;
    protected $last_news;
    protected $obm;

    protected $id;
    protected $subId;
    
    protected function input($par=[])
    {
        global $header_sts;
        $this->obm = Model::get_instance();

        $this->left_menu = $this->obm->get_leftbar();

        $this->footer_pages = $this->obm->get_footer();
        $this->right_news = $this->obm->get_rightbar();

        if(isset($header_sts['styles'])) {
            foreach ($header_sts['styles'] as $v) {
                $this->styles[] = SITE_URL . VIEW . $v;
            }
        }
        if(isset($header_sts['scripts'])) {
            foreach ($header_sts['scripts'] as $v) {
                $this->scripts[] = SITE_URL . VIEW . $v;
            }
        }
        $this->title = TITLE . " / ";

    }

    protected function output()
    {
        $this->header = $this->render('header',[
            'styles'=> $this->styles,
            'scripts'=> $this->scripts,
            'title'=> $this->title,
            'keywords'=>$this->keywords,
            'description'=>$this->description
        ]);

        //нужно ли подсвечивать меню слева
        if($this->leftBarBool){
            $this->left_bar = $this->render('leftbar',[
                'left_menu'=>$this->left_menu,
                'catid'=>$this->id
            ]);
        }else{
            $this->left_bar = $this->render('leftbar',[
                'left_menu'=>$this->left_menu,
                'catid'=>-1
            ]);
        }

        $this->footer = $this->render('footer',[
            'footer_pages'=>$this->footer_pages
        ]);

        if($this->rightBarBool)
            $this->right_bar = $this->render('rightbar',[
                'right_news'=>$this->right_news
            ]);

        $this->footer_pages = $this->render('footer',[
            'footer_pages'=>$this->footer_pages
        ]);

        $page = $this->render('index',[
            'header'=>$this->header,
            'left_bar'=>$this->left_bar,
            'content'=>$this->content,
            'right_bar'=>$this->right_bar,
            'footer'=>$this->footer,
        ]);
        return $page;
    }
}