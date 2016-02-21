<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <?php if($styles): ?>
    <?php foreach($styles as $s): ?>
            <link rel="stylesheet" type="text/css" href="<?=$s ?>" />
    <?php endforeach; ?>
    <?php endif; ?>

    <?php if($scripts): ?>
        <?php foreach($scripts as $s): ?>
            <script type="text/javascript" src="<?=$s ?>"></script>
        <?php endforeach; ?>
    <?php endif; ?>

    <title><?=$title ?></title>
</head>
<body>
<div class="cover">