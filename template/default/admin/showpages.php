<div class="main-content">
    <div class="main-content-block">
        <?php if($error): ?>
            <ul class="errormes">
                <?php foreach($error as $e): ?>
                    <li><?=$e ?></li>
                <?php endforeach; ?>
            </ul>
        <?php endif; ?>
        <?php if($message): ?>
            <p class="message"><?=$message ?></p>
        <?php endif; ?>

        <?php if(isset($title)): ?>
            <h2><?=$title ?></h2>
        <?php else: ?>
            <h2>Все страницы</h2>
        <?php endif; ?>

        <?php if($pages): ?>
            <?php foreach($pages as $n): ?>
                <div class="other-news-blocks-i">
                    <h3><a href="<?=SITE_URL ?>editpage/id/<?=$n['id'] ?>"><?=$n['title'] ?></a></h3>
                    <div class="admimistrator">
                        <a href="<?=SITE_URL ?>editpage/id/<?=$n['id'] ?>"><img src="<?=SITE_URL.VIEW ?>admin/images/w128h1281380984696edit3.png" alt=""></a>
                        <a href="<?=SITE_URL ?>editpage/del/<?=$n['id'] ?>" onclick="return confirm('Вы действительно хотите удалить?');"><img src="<?=SITE_URL.VIEW ?>admin/images/w128h1281380984637delete13.png" alt=""></a>
                    </div>
                    <hr>
                </div>
            <?php endforeach; ?>

        <?php else: ?>
            <div class="other-news-blocks-i">
                <h3>Страниц нет</h3>
                <hr>
            </div>
        <?php endif; ?>
    </div>
</div>
<div class="right-bar">
    <div class="right-main">
        <div class="h4">Меню</div>
        <div class="right-news">
            <p><a href="<?=SITE_URL ?>addnewpage/">Добавить новую страницу</a></p><br>
        </div>
    </div>
</div>
