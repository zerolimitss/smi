<div class="content">
    <div class="header">
        <h1><a href="<?=SITE_URL ?>"><?=TITLE ?></a></h1>
        <span id="date"></span>
    </div>
    <div class="dop-menu-search">
        <form action="<?=SITE_URL ?>search"  class="search1" method="post">
            <input type="text" class="stxt1" placeholder="Поиск" value="<?=rawurldecode($str) ?>" name="txt">
            <input type="submit" class="but1" >
        </form>
        <span class="errorm1"></span>
    </div>
    <div class="main-content-search">
        <div class="other-news-no-img-cat" >
            <?php if($last_news): ?>
                <?php //print_r($last_news) ?>
                <?php foreach($last_news as $n): ?>
                <div class="other-news-blocks-i">
                    <div class="il">
                        <span class="date">Новость:</span>
                        <span class="cat"><?=$n['tt'] ?></span>
                            <span class="date">-</span>
                        <span class="cat"><?=$n['ttt'] ?></span>
                    </div>
                    <div class="ir">
                        <span class="date"> <?=Utilities::today($n['date']); ?></span>
                    </div>
                    <div class="clr"></div>
                    <h3><a href="<?=SITE_URL ?>post/id/<?=$n['id'] ?>"><?=$n['title'] ?></a></h3>
                    <div class="anons"><?=$n['anons'] ?></div>
                    <hr>
                </div>
                <?php endforeach; ?>
                <?php if($nav): ?>
                <div class="pagination">
                    <?php if(isset($nav['previous'])): ?>
                        <span><a href="<?=SITE_URL ?>search/str/<?=$str  ?>/page/<?=$nav['previous'] ?>" class="left"></a></span>
                    <?php endif; ?>
                    <?php if(isset($nav['left'])): ?>
                        <?php foreach($nav['left'] as $k): ?>
                        <span><a href="<?=SITE_URL ?>search/str/<?=$str  ?>/page/<?=$k ?>"><?=$k ?></a></span>
                        <?php endforeach; ?>
                    <?php endif; ?>
                        <span><?=$nav['current'] ?></span>
                    <?php if(isset($nav['right'])): ?>
                        <?php foreach($nav['right'] as $k): ?>
                            <span><a href="<?=SITE_URL ?>search/str/<?=$str  ?>/page/<?=$k ?>"><?=$k ?></a></span>
                        <?php endforeach; ?>
                    <?php endif; ?>
                    <?php if(isset($nav['next'])): ?>
                        <span><a href="<?=SITE_URL ?>search/str/<?=$str  ?>/page/<?=$nav['next'] ?>" class="right"></a></span>
                    <?php endif; ?>
                </div>
                <?php endif; ?>
                <?php else: ?>
                <div class="other-news-blocks-i">
                    <h3>Результатов нет</h3>
                    <hr>
                </div>
            <?php endif; ?>
        </div>
    </div>