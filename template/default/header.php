<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
<?php if($styles): ?>
<?php foreach($styles as $k): ?>
	<link rel="stylesheet" type="text/css" href="<?=$k ?>" />
<?php endforeach; ?>
<?php endif; ?>
<?php if($scripts): ?>
<?php foreach($scripts as $k): ?>
	<script type="text/javascript" src="<?=$k ?>"></script>
<?php endforeach; ?>
<?php endif; ?>
<?php if($keywords): ?>
	<meta name="Keywords" content="<?=$keywords ?>">
<?php endif; ?>
<?php if($description): ?>
	<meta name="Description" content="<?=$description ?>">
<?php endif; ?>
	<title><?=$title ?></title>
</head>