</div>
<div class="clr"></div>
<div class="footer">
    <?php if($footer_pages): ?>
    <ul>
        <?php foreach($footer_pages as $k): ?>
        <li><a href="<?=SITE_URL ?>page/id/<?=$k['id'] ?>"><?=$k['title'] ?></a></li>
            <?php endforeach; ?>
    </ul>
    <?php endif; ?>
    <div class="date">
        <span>© <?=date("Y") ?> ООО «<?=TITLE ?>»</span>
    </div>
</div>
</div>
</body>
</html>