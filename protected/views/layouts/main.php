<!DOCTYPE html>
<html>
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8">
    <meta name="language" content="en">

    <link rel="stylesheet" type="text/css" href="<?php echo Yii::app()->request->baseUrl; ?>/css/group_modal.css">
    <link rel="stylesheet" type="text/css" href="<?php echo Yii::app()->request->baseUrl; ?>/css/main_page.css">
    <link rel="stylesheet" type="text/css" href="<?php echo Yii::app()->request->baseUrl; ?>/css/profile.css">
    <link rel="stylesheet" type="text/css" href="<?php echo Yii::app()->request->baseUrl; ?>/css/groupInfo.css">
    <link rel="stylesheet" type="text/css" href="<?php echo Yii::app()->request->baseUrl; ?>/css/locations.css">
    <link rel="stylesheet" type="text/css" href="<?php echo Yii::app()->request->baseUrl; ?>/css/notifications.css">
    <link rel="stylesheet" type="text/css" href="<?php echo Yii::app()->request->baseUrl; ?>/css/schedule.css">
    <link rel="stylesheet" type="text/css" href="<?php echo Yii::app()->request->baseUrl; ?>/css/studentList.css">
    <link rel="stylesheet" type="text/css" href="<?php echo Yii::app()->request->baseUrl; ?>/css/groupsList.css">
    <link rel="stylesheet" type="text/css" href="<?php echo Yii::app()->request->baseUrl; ?>/css/error.css">
    <link rel="stylesheet" type="text/css"
          href="<?php echo Yii::app()->request->baseUrl; ?>/node_modules/bootstrap/dist/css/bootstrap.css">

    <script src="<?php echo Yii::app()->request->baseUrl; ?>/node_modules/jquery/dist/jquery.js"></script>
    <script src="<?php echo Yii::app()->request->baseUrl; ?>/node_modules/bootstrap/dist/js/bootstrap.js"></script>
    <script src="<?php echo Yii::app()->request->baseUrl; ?>/js/GroupModal.js"></script>
    <script src="<?php echo Yii::app()->request->baseUrl; ?>/js/BudgetOwner.js"></script>
    <script src="<?php echo Yii::app()->request->baseUrl; ?>/js/DateCourse.js"></script>
    <script src="<?php echo Yii::app()->request->baseUrl; ?>/js/TeachersSelect.js"></script>
    <script src="<?php echo Yii::app()->request->baseUrl; ?>/js/ExpertsInput.js"></script>
    <script src="<?php echo Yii::app()->request->baseUrl; ?>/js/Frame.js"></script>
    <script src="<?php echo Yii::app()->request->baseUrl; ?>/js/group_model_init.js"></script>
    <script src="<?php echo Yii::app()->request->baseUrl; ?>/js/profile.js"></script>
    <script src="<?php echo Yii::app()->request->baseUrl; ?>/js/profile_init.js"></script>
    <script src="<?php echo Yii::app()->request->baseUrl; ?>/js/GroupsList.js"></script>
    <script src="<?php echo Yii::app()->request->baseUrl; ?>/js/LocationsList.js"></script>
    <script src="<?php echo Yii::app()->request->baseUrl; ?>/js/MyGroupsListFilter.js"></script>
    <title><?php echo CHtml::encode($this->pageTitle); ?></title>
</head>

<body>

<?php echo $content; ?>

<div class="clear"></div>

<script>
    window.addEventListener('DOMContentLoaded', () => {
        let groupsListMenu = new GroupsList([
                "<?= Yii::app()->createUrl('GroupsList/GetGroupsList'); ?>",
                "<?= Yii::app()->createUrl('GroupsList/ShowGroup'); ?>"]);
//            myGroupsListFilter = new MyGroupsListFilter([
//                "<?//= Yii::app()->createUrl('GroupsList/GetMyGroupsList'); ?>//"]);

        groupsListMenu.xname = 'pizdec';
        sessionStorage.setItem('groupsListObj', groupsListMenu);
        console.log(sessionStorage.getItem('groupsListObj').xname);
    });
</script>
</body>
</html>
