<body>
<div class="cover">
	<div class="left_bar">
		<ul class="nav">
			<li><a href="<?=SITE_URL ?>" <?php if(empty($catid)) echo "class=\"active\"" ?>>Главная</a></li>
			<?php if($left_menu): ?>
				<?php foreach($left_menu as $k): ?>
					<?php $a=active($k['id'],$catid)?>
					<li><a <?=$a ?> href="<?=SITE_URL ?>category/id/<?=$k['id'] ?>"><?=$k['title'] ?></a></li>
				<?php endforeach; ?>
			<?php endif; ?>
		</ul>
		<hr>
		<form action="<?=SITE_URL ?>search"  class="search" method="post">
			<input type="text" placeholder="Поиск" name="txt" class="stxt">
			<input type="submit" class="but" name="submit">
		</form>
		<span class="errorm"></span>
	</div>