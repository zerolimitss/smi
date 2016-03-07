    <div class="main-content">
        <div class="main-content-block">
            <?=Utilities::errorOrMessage($error,$message); ?>
            <h2>Добавить страницу: <?=$page['title'] ?></h2>
            <form id="actionpage" action="<?=SITE_URL ?>addnewpage/id/<?=$page_id ?>" method="post" enctype="multipart/form-data">
                <p><span>Заголовок: </span><input type="text" id="head" class="txt" name="header"></p>

                <p><span>Текст: </span><br>
                    <textarea name="text" id="text"  rows="15" ><?=$page['text'] ?></textarea></p>

                <p><span>Ключевые слова(СЕО): </span><input type="text" id="keys" class="txt" name="keys"></p>

                <p><span>Описание(СЕО): </span><input type="text" id="description" class="txt" name="description"></p>

                <p>Позиция: <select name="position" id="pos">
                        <?php for($i=1;$i<=$count+1;$i++): ?>
                            <option value="<?=$i ?>" <? if($i==$page['position']) echo 'selected' ?>><?=$i ?></option>
                        <?php endfor; ?>
                    </select></p>

                <p><input type="submit" value="Отправить" class="submit"></p>
                <p><input type="button" value="Назад" class="back"></p>
            </form>
        </div>
    </div>