<div class="content">
    <div class="header">
        <h1><a href="<?=SITE_URL ?>"><?=TITLE ?></a></h1>
        <span id="date">
           </span>
    </div>
    <div class="main-content">
        <div class="main-news">
        <?php if($main_news): ?>

                <a href="<?=SITE_URL ?>post/id/<?=$main_news['id'] ?>"><img src="<?=SITE_URL.UPLOAD_IMG.$main_news['image'] ?>" alt=""></a>

                <div class="main-news-content">
                    <span class="cat"><?=$main_news['ttt'] ?></span>
                    <span class="date"><?=Utilities::dateMain($main_news['date']); ?></span>
                    <h2><a href="<?=SITE_URL ?>post/id/<?=$main_news['id'] ?>"><?=$main_news['title'] ?></a></h2>
                    <p><a href="<?=SITE_URL ?>post/id/<?=$main_news['id'] ?>"><?=$main_news['anons'] ?></a> </p>
                </div>

        <?php endif; ?>
        </div>
        <div class="other-news">
            <?php if($last_news): ?>

                <?php foreach($last_news as $n): ?>

                    <?php if($n['main_new']==0): ?>
                        <div class="other-news-blocks-i">
                            <span class="cat"><?=date("m:s",$n['date']) ?></span><span class="date"> <?=Utilities::today($n['date']); ?></span>
                            <h4><a href="<?=SITE_URL ?>post/id/<?=$n['id'] ?>"><?=$n['title'] ?></a></h4>
                            <hr>
                        </div>
                    <?php else: ?>
                        <div class="other-news-blocks">
                            <span class="cat"><?=$n['ttt'] ?></span><span class="date"><?=Utilities::today($n['date']); ?></span>
                            <a href="<?=SITE_URL ?>post/id/<?=$n['id'] ?>"><img src="<?=SITE_URL.UPLOAD_IMG.$n['image'] ?>" alt=""></a>
                            <h3><a href="<?=SITE_URL ?>post/id/<?=$n['id'] ?>"><?=$n['title'] ?></a></h3>
                            <hr>
                        </div>
                    <?php endif; ?>
                <?php endforeach; ?>
            <?php endif; ?>
        </div>
    </div>