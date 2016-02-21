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
            <h2>Добавить новость</h2>
            <form id="action" action="<?=SITE_URL ?>admin" method="post" enctype="multipart/form-data">
                <p><span>Заголовок: </span><input type="text" id="head" class="txt" name="header"></p>

                <p><span>Текст новости: </span><br>
                    <textarea name="text" id="text"  rows="15"></textarea></p>

                <p><span>Анонс новости (до 255 символов): </span>
                    <textarea name="anons" id="anons"  rows="5"></textarea></p>

                <p><span>Ключевые слова(СЕО): </span><input type="text" id="keys" class="txt" name="keys"></p>

                <p><span>Описание(СЕО): </span><input type="text" id="description" class="txt" name="description"></p>

                <p><span>Видимость: </span>
                    <label><input type="radio" name="visible" value="1" class="radio" checked>Да </label>
                    <label><input type="radio" name="visible" value="0" class="radio">Скрыть </label>
                </p>

                <input type="hidden" name="MAX_FILE_SIZE" value="1111111111">
                <p><span>Картинка: </span><input type="file" name="img"></p>
                <p><span>Категория: </span>
                    <select name="cat" id="admincat">
                        <?php if($category):  ?>
                            <option value="0" selected disabled>Выберите категорию</option>
                                <?php foreach($category as $e): ?>
                                <option value="<?=$e['id'] ?>"><?=$e['title'] ?></option>
                                <?php endforeach; ?>
                        <?php endif; ?>
                    </select>
                </p>
                <p><span>Подкатегория: </span>
                    <select name="subcat" id="adminsubcat">`
                        <option value="0" selected disabled>Выберите подкатегорию</option>
                    </select>
                </p>
                <p><span>Важная новость: </span>
                    <label><input type="radio" name="main" value="1" class="radio">На главную </label>
                    <label><input type="radio" name="main" value="2" class="radio">Важная </label>
                    <label><input type="radio" name="main" value="0" class="radio" checked>Обычная </label>
                </p>

                <p><input type="submit" value="Отправить" class="submit"></p>
            </form>
        </div>
    </div>
    <div class="right-bar">
        <div class="right-main">
            <div class="h4">Логи посещений</div>
            <?php if($logs): ?>
                <?php for($i=count($logs)-1;$i>count($logs)-1-5;$i--): ?>
                    <?php $m = explode('|',$logs[$i]); ?>
                    <div class="right-news">
                        <span class="time"><?=date("h:i d-m-Y", $m[0]) ?></span><br>
                        <span class="text"><?=$m[1] ?>, <?=$m[2] ?></span><br>
                        <span class="text"><?=$m[3] ?></span><br>
                        <hr>
                    </div>
                <?php endfor; ?>
            <?php endif; ?>
        </div>
    </div>