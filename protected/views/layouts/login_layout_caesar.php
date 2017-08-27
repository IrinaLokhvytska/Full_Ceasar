<!DOCTYPE html>
<html>
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8">
    <meta name="language" content="en">

    <link rel="stylesheet" type="text/css" href="<?= Yii::app()->request->baseUrl; ?>/css/login.css">
    <link rel="stylesheet" type="text/css" href="<?= Yii::app()->request->baseUrl; ?>/css/mainPage/main_page.css">

    <script src="<?= Yii::app()->request->baseUrl; ?>/js/login/login.js"></script>
    <script src="<?= Yii::app()->request->baseUrl; ?>/js/login/login_init.js"></script>

    <title><?= CHtml::encode($this->pageTitle); ?></title>
</head>

<body>

    <header class="header box">SoftServe</header>
    <?= $content; ?>
    <div class="clear"></div>

</body>
</html>
