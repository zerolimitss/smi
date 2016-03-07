<div class="content">
    <div class="header">
        <h1><a href="<?=SITE_URL ?>"><?=TITLE ?></a></h1>
        <span id="date"></span>
    </div>
    <?php if($subcategory): ?>
        <div class="dop-menu">
            <a <?php if(empty($subid)) echo "class=\"active\"" ?> href="<?=SITE_URL ?>category/id/<?=$catid  ?>">Все</a>
            <?php foreach($subcategory as $k): ?>
                <?php $a=Utilities::active($k['id'],$subid)?>
                <a <?=$a ?> href="<?=SITE_URL ?>category/id/<?=$catid  ?>/sub/<?=$k['id'] ?>"><?=$k['title'] ?></a>
            <?php endforeach; ?>
            <a href="<?=SITE_URL ?>archive/id/<?=$catid ?>">Архив</a>
        </div>
    <?php endif; ?>
    <div class="main-content">
        <div class="main-news-post">
        <?php if($main_news): ?>
                    <span class="date"><?=Utilities::dateMain($main_news['date'],true); ?></span>
                    <h2><?=$main_news['title'] ?></h2>
                    <?php if($main_news['image']): ?>
                    <img src="<?=SITE_URL.UPLOAD_IMG.$main_news['image'] ?>" alt="">
                    <?php endif; ?>
                    <div class="newcont"><?=nl2br($main_news['text']) ?> </div>
                <div class="clr"></div>
        <?php endif; ?>
        </div>
    </div>