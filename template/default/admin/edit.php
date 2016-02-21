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
            <h2>Редактировать новость</h2>
            <form id="action" action="<?=SITE_URL ?>edit/id/<?=$post_id ?>" method="post" enctype="multipart/form-data">
                <p><span>Заголовок: </span><input type="text" id="head" class="txt" name="header" value="<?=$post['title'] ?>"></p>

                <p><span>Текст новости: </span><br>
                    <textarea name="text" id="text"  rows="15" ><?=$post['text'] ?></textarea></p>

                <p><span>Анонс новости (до 255 символов): </span>
                    <textarea name="anons" id="anons"  rows="5"><?=$post['anons'] ?></textarea></p>

                <p><span>Ключевые слова(СЕО): </span><input type="text" id="keys" class="txt" name="keys" value="<?=$post['keywords'] ?>"></p>

                <p><span>Описание(СЕО): </span><input type="text" id="description" class="txt" name="description" value="<?=$post['description'] ?>"></p>

                <p><span>Видимость: </span>
                    <label><input type="radio" name="visible" value="1" class="radio" <? echo $post['visible']==1?"checked":""; ?>>Да </label>
                    <label><input type="radio" name="visible" value="0" class="radio" <? echo $post['visible']==0?"checked":""; ?>>Скрытая </label>
                </p>

                <input type="hidden" name="MAX_FILE_SIZE" value="1111111111">
                <p><span>Картинка: </span><input type="file" name="img"></p>
                <p><span>Категория: </span>
                    <select name="cat" id="admincat1">
                        <?php if($category):  ?>
                            <option value="0" selected disabled>Выберите категорию</option>
                                <?php foreach($category as $e): ?>
                                <option value="<?=$e['id'] ?>" <? echo $post['c1id']==$e['id']?"selected":""; ?>><?=$e['title'] ?></option>
                                <?php endforeach; ?>
                        <?php endif; ?>
                    </select>
                </p>
                <p><span>Подкатегория: </span>
                    <select name="subcat" id="adminsubcat">`
                        <option value="0" selected disabled>Выберите подкатегорию</option>
                        <?php if($subcatarray):  ?>
                            <?php foreach($subcatarray as $s): ?>
                                <option value="<?=$s['id'] ?>" <? echo $post['category_id']==$s['id']?"selected":""; ?>><?=$s['title'] ?></option>
                            <?php endforeach; ?>
                        <?php endif; ?>
                    </select>
                </p>
                <p><span>Важная новость: </span>
                    <label><input type="radio" name="main" value="1" class="radio" <? echo $post['main_new']==1?"checked":""; ?>>На главную </label>
                    <label><input type="radio" name="main" value="2" class="radio" <? echo $post['main_new']==2?"checked":""; ?>>Важная </label>
                    <label><input type="radio" name="main" value="0" class="radio" <? echo $post['main_new']==0?"checked":""; ?>>Обычная </label>
                </p>

                <p><input type="submit" value="Отправить" class="submit"></p>
                <p><input type="button" value="Назад" class="back"></p>
            </form>
        </div>
    </div>