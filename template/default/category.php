<div class="content">
    <div class="header">
        <h1><a href="<?=SITE_URL ?>"><?=TITLE ?></a></h1>
        <span id="date"></span>
    </div>
    <?php if($subcategory): ?>
    <div class="dop-menu">
        <a <?php if(empty($subid)) echo "class=\"active\"" ?> href="<?=SITE_URL ?>category/id/<?=$catid  ?>">Все</a>
        <?php foreach($subcategory as $k): ?>
            <?php $a=active($k['id'],$subid)?>
        <a <?=$a ?> href="<?=SITE_URL ?>category/id/<?=$catid  ?>/sub/<?=$k['id'] ?>"><?=$k['title'] ?></a>
        <?php endforeach; ?>
        <a href="<?=SITE_URL ?>archive/id/<?=$catid  ?>">Архив</a>
    </div>
    <?php endif; ?>
    <div class="main-content">
        <div class="main-news-category">
        <?php if($main_news): ?>
                    <span class="cat"><?=date("h:m",$main_news['date']); ?></span>
                    <h2><a href="<?=SITE_URL ?>post/id/<?=$main_news['id'] ?>"><?=$main_news['title'] ?></a></h2>
                    <?php if($main_news['image']): ?>
                    <a href="<?=SITE_URL ?>post/id/<?=$main_news['id'] ?>">
                        <img src="<?=SITE_URL.UPLOAD_IMG.$main_news['image'] ?>" alt="">
                    </a>
                    <?php endif; ?>
                    <p><a href="<?=SITE_URL ?>post/id/<?=$main_news['id'] ?>"><?=$main_news['anons'] ?></a> </p>

                <div class="clr"></div>
                <br>
                <hr>

        <?php endif; ?>
        </div>
        <div class="other-news-no-img-cat">
            <?php if($last_news): ?>
                <?php foreach($last_news as $n): ?>
                <div class="other-news-blocks-i">
                    <span class="cat"><?=date("m:s",$n['date']) ?></span><span class="date"> <?=today($n['date']); ?></span>
                    <h4><a href="<?=SITE_URL ?>post/id/<?=$n['id'] ?>"><?=$n['title'] ?></a></h4>
                    <hr>
                </div>
                <?php endforeach; ?>
            <?php endif; ?>
        </div>
    </div>