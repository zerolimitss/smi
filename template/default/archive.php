<div class="content">
    <div class="header">
        <h1><a href="<?=SITE_URL ?>"><?=TITLE ?></a></h1>
        <span id="date"></span>
    </div>
    <div class="dop-menu-archive">
        <form action="" id="categoryArchive">
            <select name="rubricka" id="">
                <option value="0">Все рубрики</option>
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
                <a class="left" href="<?=SITE_URL ?>archive/id/<?=$catid  ?>/page/<?=$nav['previous'] ?>"></a>
            <?php endif; ?>
            <?php if(isset($nav['next'])): ?>
                <a class="right" href="<?=SITE_URL ?>archive/id/<?=$catid  ?>/page/<?=$nav['next'] ?>"></a>
            <?php endif; ?>
        <?php endif; ?>
    </div>
    <div class="main-content">
        <div class="main-news-category">
        </div>
        <div class="other-news-no-img-cat" >
            <?php if($last_news): ?>
                <?php foreach($last_news as $n): ?>
                <div class="other-news-blocks-i">
                    <span class="cat"><?=date("H:i",$n['date']) ?></span><span class="date"> <?=Utilities::today($n['date']); ?></span>
                    <h4><a href="<?=SITE_URL ?>post/id/<?=$n['id'] ?>"><?=$n['title'] ?></a></h4>
                    <hr>
                </div>
                <?php endforeach; ?>
            <?php endif; ?>
        </div>
    </div>