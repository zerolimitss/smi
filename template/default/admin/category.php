<div class="main-content">
    <div class="main-content-block">
        <?=Utilities::errorOrMessage($error,$message); ?>
        <h2>Редактировать категории</h2>
        <?php if($category): ?>
            <br>
            <ul class="categorylist">
                <?php foreach($category as $e): ?>
                    <li><a href="<?=SITE_URL ?>editcategory/id/<?=$e['id'] ?>"><?=$e['title'] ?></a></li>
                    <?php if($category): ?>
                        <ul>
                            <?php foreach($subcat as $s): ?>
                                <?php if($s['parent_id']==$e['id']): ?>
                                <li><a href="<?=SITE_URL ?>editcategory/subid/<?=$s['id'] ?>"><?=$s['title'] ?></a></li>
                                    <?php endif; ?>
                            <?php endforeach; ?>
                        </ul>
                    <?php endif; ?>
                <?php endforeach; ?>
            </ul>
        <?php endif; ?>
    </div>
</div>
<div class="right-bar">
    <div class="right-main">
        <div class="h4">Меню</div>
        <div class="right-news">
            <p><a href="<?=SITE_URL ?>addnewcat/">Добавить новую категорию</a></p><br>
        </div>
    </div>
</div>