    <div class="main-content">
        <div class="main-content-block">
            <?=Utilities::errorOrMessage($error,$message); ?>
                <?php if(!isset($parent)): ?>
                    <h2>Редактировать категорию: <?=$category['title'] ?></h2>
                <?php else: ?>
                    <h2>Редактировать подкатегорию: <?=$category['title'] ?></h2>
                <?php endif; ?>
            <form action="<?=SITE_URL ?>editcategory/updateid/<?=$category['id'] ?>" method="post" id="actionpage">
                <p>Заголовок: <input type="text" name="header" value="<?=$category['title'] ?>"  id="patterncat"></p>
                <p>Позиция: <select name="position" id="pos">
                        <?php for($i=1;$i<=$count+1;$i++): ?>
                            <option value="<?=$i ?>" <? if($i==$category['position']) echo 'selected' ?>><?=$i ?></option>
                        <?php endfor; ?>
                    </select></p>
                <?php if(isset($parent)): ?>
                <p>Родительская категория:
                    <select name="parent" id="parent" >
                        <?php for($i=0;$i<count($parent);$i++): ?>
                            <option value="<?=$parent[$i]['id'] ?>" <? if($category['parent_id']==$parent[$i]['id']) echo 'selected' ?>><?=$parent[$i]['title'] ?></option>
                        <?php endfor; ?>
                    </select>
                </p>
                <?php endif; ?>
                <p><input type="submit" value="Изменить" class="submit"> <input type="button" value="Назад" class="back"></p>
            </form>

        </div>
    </div>
    <div class="right-bar">
        <div class="right-main">
            <div class="h4">Меню</div>
            <div class="right-news">
                <?php if(!$parent): ?>
                <p><a href="<?=SITE_URL ?>addnewcat/parent/<?=$category['id'] ?>">Добавить подкатегорию</a></p><br>
                <?php endif; ?>
                <p><a href="<?=SITE_URL ?>editcategory/<? echo !$parent?"del":"delsub" ?>/<?=$category['id'] ?>">Удалить</a></p>
                <br>
            </div>
        </div>
    </div>