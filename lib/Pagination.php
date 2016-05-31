<?php

class Pagination
{
    private $dbb;
    private $table;
    private $postByPage;
    private $totalCount;
    private $currentPage;
    private $category;
    private $match;


    public function __construct($table,$postByPage,$category,$currentPage,$match=false)
    {
        $this->dbb = MySQL::get_instance();
        $this->table = $table;
        $this->postByPage = $postByPage;
        $this->category = $category;
        $this->currentPage = $currentPage;
        if($match)
            $this->match = $this->dbb->db->real_escape_string($match);
        $this->totalCount = $this->get_total();

    }

    private function get_total()
    {
        if($this->match){
            $sql = "SELECT COUNT(*) as c FROM " . $this->table;
            $sql .= " WHERE MATCH (title,text) ";
            $sql .= "AGAINST ('".$this->match;
            $sql .= "' IN BOOLEAN MODE)";
            $res = $this->dbb->get_query($sql);
        }else{
            if ($this->category != 0){
                $sql = "SELECT COUNT(*) as c FROM " . $this->table;
                $sql .= " WHERE category_id IN ( ";
                $sql .= "SELECT id FROM category WHERE parent_id=".$this->category;
                $sql .= ")";
                $res = $this->dbb->get_query($sql);
            }else{
                $sql = "SELECT COUNT(*) as c FROM " . $this->table;
                $res = $this->dbb->get_query($sql);
            }

        }
        return $res[0]['c'];
    }

    public function get_posts()
    {
        //всего страниц
        $allPages = $this->totalCount / $this->postByPage;

        //если записей не хватает на страницу, делаем больше страниц
        if (($this->totalCount % $this->postByPage) != 0) {
            $allPages=ceil($allPages);
        }
        //если страница выходит за пределы
        if ($this->currentPage <= 0) {
            $this->currentPage =1;
        }
        if ($this->currentPage > $allPages) {
            $this->currentPage=$allPages;
        }

        //формула смещения
        $start = ($this->currentPage - 1) * $this->postByPage;

        //если это пагинация для поиска
        if($this->match){
            $sql = " SELECT p.id, p.title, p.text, p.image, p.date,
                        p.keywords, p.description, p.anons, p.category_id,
                        c1.title as tt, c.title as ttt FROM posts p
                        INNER JOIN category c ON p.category_id = c.id
                        INNER JOIN category c1 ON c.parent_id = c1.id ";
            $sql .= " WHERE MATCH (p.title,p.text) AGAINST ('".$this->match;
            $sql .= "' IN BOOLEAN MODE)";
            $sql .= " ORDER BY date DESC LIMIT " . $this->postByPage;
            $sql .= " OFFSET " . $start;
            //echo $sql;
        }else{
            if ($this->category != 0){
                $sql = "SELECT p.id, p.title,p.date,c1.title as tt, c.title as ttt FROM posts p
                          INNER JOIN category c ON p.category_id = c.id
                          INNER JOIN category c1 ON c.parent_id = c1.id ";
                $sql .= " WHERE category_id IN ( ";
                $sql .= "SELECT id FROM category WHERE parent_id=" . $this->category;
                $sql .= ") ORDER BY date DESC LIMIT " . $this->postByPage;
                $sql .= " OFFSET " . $start;
            }else{
                $sql = "SELECT p.id, p.title,p.date,c1.title as tt, c.title as ttt FROM posts p
                          INNER JOIN category c ON p.category_id = c.id
                          INNER JOIN category c1 ON c.parent_id = c1.id ";
                $sql .= " ORDER BY date DESC LIMIT " . $this->postByPage;
                $sql .= " OFFSET " . $start;
            }
        }
        $res = $this->dbb->get_query($sql);
        return $res;
    }

    public function get_nav()
    {
        $arr = [];
        $allPages = $this->totalCount / $this->postByPage;
        //если записей не хватает на страницу, делаем больше страниц
        if(($this->totalCount % $this->postByPage) != 0){
            $allPages=ceil($allPages);
        }
        //echo $allPages;
        //всего постов меньше числа записей на страницу
        if($this->totalCount<$this->postByPage ||
            $this->currentPage>$allPages){
            return false;
        }

        //если страница не 1я, показать предыдущая
        if($this->currentPage !=1){
            $arr['previous']=$this->currentPage-1;
        }

        if($this->currentPage < $allPages){
            $arr['next']=$this->currentPage+1;
        }

        //ссылки слева от текущей страници
        if($this->currentPage>2 && $this->currentPage <= $allPages){
            for($i=$this->currentPage-2; $i<$this->currentPage;$i++){
                $arr['left'][]=$i;
            }
        }
        if($this->currentPage==2 ){
                $arr['left'][]=1;
        }

        //ссылки справа от текущей страници
        if($this->currentPage < $allPages){
            $r=0;
            for($i=$this->currentPage+1; $i<=$allPages;$i++){
                $r++;
                $arr['right'][]=$i;
                if($r==2) break;
            }
        }

        //текущая страница
        $arr['current'] = $this->currentPage;
        return $arr;
    }
}