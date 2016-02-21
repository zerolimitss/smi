<div class="content">
    <div class="header">
        <h1><a href="<?=SITE_URL ?>"><?=TITLE ?></a></h1>
        <span id="date"></span>
    </div>
    <div class="main-content">
        <div class="main-news-post">
        <?php if($page): ?>
            <h2><?=$page['title'] ?></h2>
            <div class="newcont"><?=nl2br($page['text']) ?> </div>
            <div class="clr"></div>
        <?php endif; ?>
        </div>

    </div>