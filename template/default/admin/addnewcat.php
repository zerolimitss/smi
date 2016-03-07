<div class="main-content">
    <div class="main-content-block">
        <?=Utilities::errorOrMessage($error,$message); ?>

        <?php if(!isset($parent)): ?>
            <h2>Добавить категорию</h2>
        <?php else: ?>
            <h2>Добавить подкатегорию</h2>
        <?php endif; ?>

        <form action="<?=SITE_URL ?>addnewcat/" method="post" id="actioncategory">
            <p>Заголовок: <input type="text" name="header" id="patterncat"></p>
            <p>Позиция: <select name="position" id="pos">
                    <?php for($i=1;$i<=$count+1;$i++): ?>
                        <option value="<?=$i ?>"><?=$i ?></option>
                    <?php endfor; ?>
                </select></p>
            <input type="hidden" name="parent" value="<?=$parent ?>">
            <p><input type="submit" value="Добавить" class="submit"> <input type="button" value="Назад" class="back"></p>
        </form>
    </div>
</div>