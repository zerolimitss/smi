    <div class="dop-menu-news">
        <form action="" id="categoryNews">
            <select name="rubricka" id="">
                <option value="0" selected>Все рубрики</option>
                <?php if($category): ?>
                    <?php foreach($category as $c): ?>
                        <?php if($catid == $c['id']): ?>
                            <option value="<?=$c['id'] ?>" selected><?=$c['title'] ?></option>
                        <?php else: ?>
                            <option value="<?=$c['id'] ?>"><?=$c['title'] ?></option>
                        <?php endif; ?>
                    <?php endforeach; ?>
                <?php endif; ?>
            </select>
        </form>
        <?php if($nav): ?>
            <?php if(isset($nav['previous'])): ?>
                <a class="left" href="<?=SITE_URL ?>news/id/<?=$catid  ?>/page/<?=$nav['previous'] ?>"></a>
            <?php endif; ?>
            <?php if(isset($nav['next'])): ?>
                <a class="right" href="<?=SITE_URL ?>news/id/<?=$catid  ?>/page/<?=$nav['next'] ?>"></a>
            <?php endif; ?>
        <?php endif; ?>
    </div>
    <div class="main-content-news">
        <div class="main-content-wrapper">
            <?php if(isset($mes)): ?>
                <p class="mes"><?=$mes ?></p>
            <?php endif; ?>

            <?php if(isset($title)): ?>
                <h2><?=$title ?></h2>
            <?php else: ?>
                <h2>Все новости</h2>
            <?php endif; ?>

            <?php if($posts): ?>
                <?php //print_r($posts) ?>
                <?php foreach($posts as $n): ?>
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
                        <h3><a href="<?=SITE_URL ?>edit/id/<?=$n['id'] ?>"><?=$n['title'] ?></a></h3>
                        <div class="admimistrator">
                            <a href="<?=SITE_URL ?>edit/id/<?=$n['id'] ?>"><img src="<?=SITE_URL.VIEW ?>admin/images/w128h1281380984696edit3.png" alt=""></a>
                            <a href="<?=SITE_URL ?>edit/del/<?=$n['id'] ?>" onclick="return confirm('Вы действительно хотите удалить?');"><img src="<?=SITE_URL.VIEW ?>admin/images/w128h1281380984637delete13.png" alt=""></a>
                        </div>
                        <hr>
                    </div>
                <?php endforeach; ?>

            <?php else: ?>
                <div class="other-news-blocks-i">
                    <h3>Новостей нет</h3>
                    <hr>
                </div>
            <?php endif; ?>
        </div>
    </div>