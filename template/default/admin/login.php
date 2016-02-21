    <div class="main-content">
        <div class="main-content-block">
            <h2>Авторизация</h2>
            <?php if($error): ?>
                <p><?=$error ?></p>
            <?php endif; ?>
            <form action="<?=SITE_URL ?>login" method="post" >
                <p><span>Логин: </span><input type="text" class="txt" name="login"></p>

                <p><span>Пароль: </span><input type="password" class="txt" name="pass"></p>

                <p><input type="submit" value="Enter" class="submit"></p>
            </form>
        </div>
    </div>