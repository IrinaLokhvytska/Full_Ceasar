<!DOCTYPE html>
<html>
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8">
    <meta name="language" content="en">

    <link rel="stylesheet" type="text/css" href="<?php echo Yii::app()->request->baseUrl; ?>/css/login.css">
    <link rel="stylesheet" type="text/css" href="<?php echo Yii::app()->request->baseUrl; ?>/css/main_page.css">

    <script src="<?php echo Yii::app()->request->baseUrl; ?>/js/login.js"></script>
    <script src="<?php echo Yii::app()->request->baseUrl; ?>/js/login_init.js"></script>

    <title><?php echo CHtml::encode($this->pageTitle); ?></title>
</head>

<body>

    <header class="header box">SoftServe</header>
    <?php echo $content; ?>
    <div class="clear"></div>

</body>
</html>