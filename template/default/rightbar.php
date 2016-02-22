<div class="right-bar">
    <div class="right-main">
        <div class="h4">Важные новости</div>
                <?php if($right_news): ?>
                    <?php foreach($right_news as $r): ?>
                        <div class="right-news">
                            <span class="time"><?=date("H:i",$r['date']) ?></span>
                            <span class="text"><a href="<?=SITE_URL ?>post/id/<?=$r['id'] ?>"><?=$r['title'] ?></a></span>
                            <hr>
                        </div>
                    <?php endforeach; ?>
                <?php else: ?>
                    <div class="right-news">
                        <p>Новостей нет</p>
                    </div>
                <?php endif; ?>
    </div>
</div>

