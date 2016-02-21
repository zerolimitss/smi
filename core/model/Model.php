<?php

class Model
{
    private static $inst;
    public $obm;

    static function get_instance()
    {
        if(self::$inst instanceof self){
            return self::$inst;
        }
        return self::$inst = new self;
    }

    private function __construct()
    {
        $this->obm = MySQL::get_instance();
    }

    public function get_leftbar()
    {
        $sql = "SELECT id, title FROM category WHERE parent_id=0 ORDER BY position";
        $res = $this->obm->get_query($sql);
        return $res;
    }

    public function get_footer()
    {
        $sql = "SELECT id, title FROM pages ORDER BY position";
        $res = $this->obm->get_query($sql);
        return $res;
    }

    public function get_rightbar()
    {
        $sql = "SELECT id, title, date FROM posts WHERE main_new='2'
                ORDER BY date DESC LIMIT 5";
        $res = $this->obm->get_query($sql);
        return $res;
    }

    public function get_main_new($id='',$sub=false)
    {
        $sql = "SELECT p.id, p.title, p.anons, p.image, p.date, c.title as ttt";
        $sql .= " FROM posts p, category c";
        //если главная новость на странице ВСЕ категории
        if(!empty($id) && $sub==false){
            $sql .= " WHERE  p.category_id IN (SELECT id FROM category WHERE parent_id=$id)
             AND p.main_new IN ('1','2') ";
        }
        //если на суб категори
        elseif(!empty($id) && $sub){
            $sql .= " WHERE  p.category_id=$id AND p.main_new IN ('1','2') AND p.category_id=c.id";
        }
        //если на главной странице
        else{
            $sql .= " WHERE p.main_new='1' AND p.category_id=c.id";
        }
        $sql .= " LIMIT 1";
        $res = $this->obm->get_query($sql);
        return $res[0];
    }

    public function get_last_news($l,$id='',$sub=false)
    {
        $sql = "SELECT p.id, p.title, p.anons, p.image, p.date, p.main_new, c.title as ttt ";
        $sql .= "FROM posts p, category c ";
        $sql .= "WHERE p.category_id=c.id  ";
        //на главную
        if(empty($id) && $sub==false){
            $sql .= "AND p.main_new NOT IN ('1') ";
        }
        //на категорию все новости
        elseif(!empty($id) && $sub==false){
            $sql .= "AND p.main_new NOT IN ('1','2') ";
            $sql .= "AND c.id IN(SELECT id FROM category WHERE parent_id=$id) ";
        }
        //на суб категорию
        elseif(!empty($id) && $sub){
            $sql .= "AND p.main_new NOT IN ('1','2') ";
            $sql .= "AND c.id=$id ";
        }
        $sql .= "ORDER BY date DESC LIMIT $l";
        $res = $this->obm->get_query($sql);
        return $res;
    }
    public function get_cat_title($id)
    {
        $sql = "SELECT title FROM category
                WHERE id=$id
                LIMIT 1";
        $res = $this->obm->get_query($sql);
        return $res[0]['title'];
    }
    
    public function get_subcat($id)
    {

        $sql = "SELECT id, title FROM category
                WHERE parent_id=$id
                ORDER BY position";
        $res = $this->obm->get_query($sql);
        return $res;
    }

    public function get_post_by_id($id)
    {
        $sql = "SELECT p.id, p.title, p.text, p.image, p.date,
                        p.keywords, p.description
                        ";
        $sql .= " FROM posts p";
        $sql .= " WHERE p.id=$id ";
        $sql .= " LIMIT 1";
       // echo $sql;
        $res = $this->obm->get_query($sql);
        return $res[0];
    }

    public function get_cat_and_subcat_by_post($id)
    {
        $sql = "SELECT category_id ";
        $sql .= " FROM posts";
        $sql .= " WHERE id=$id";
        $sql .= " LIMIT 1";
        $res = $this->obm->get_query($sql);
            $subCat = $res[0]['category_id'];

        $sql = "SELECT parent_id ";
        $sql .= " FROM category";
        $sql .= " WHERE id=$subCat";
        $sql .= " LIMIT 1";
        $res = $this->obm->get_query($sql);
            $cat = $res[0]['parent_id'];

        return [$cat,$subCat];
    }

    public function get_page_by_id($id)
    {
        $sql = "SELECT id, title, text,
                        keywords, description, position
                        ";
        $sql .= " FROM pages";
        $sql .= " WHERE id=$id ";
        $sql .= " LIMIT 1";
        $res = $this->obm->get_query($sql);
        return $res[0];
    }



}