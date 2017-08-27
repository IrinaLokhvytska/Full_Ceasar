<!DOCTYPE html>
<html>
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8">
    <meta name="language" content="en">

    <link rel="stylesheet" type="text/css" href="<?php echo Yii::app()->request->baseUrl; ?>/css/group_modal.css">
    <link rel="stylesheet" type="text/css" href="<?php echo Yii::app()->request->baseUrl; ?>/css/main_page.css">
    <link rel="stylesheet" type="text/css" href="<?php echo Yii::app()->request->baseUrl; ?>/css/profile.css">
    <link rel="stylesheet" type="text/css" href="<?php echo Yii::app()->request->baseUrl; ?>/css/leftside.css">
    <link rel="stylesheet" type="text/css" href="<?php echo Yii::app()->request->baseUrl; ?>/css/groupInfo.css">
    <link rel="stylesheet" type="text/css" href="<?php echo Yii::app()->request->baseUrl; ?>/css/locations.css">
    <link rel="stylesheet" type="text/css" href="<?php echo Yii::app()->request->baseUrl; ?>/css/notifications.css">
    <link rel="stylesheet" type="text/css" href="<?php echo Yii::app()->request->baseUrl; ?>/css/schedule.css">
    <link rel="stylesheet" type="text/css" href="<?php echo Yii::app()->request->baseUrl; ?>/css/studentList.css">
    <link rel="stylesheet" type="text/css" href="<?php echo Yii::app()->request->baseUrl; ?>/css/groupList.css">
    <link rel="stylesheet" type="text/css" href="<?php echo Yii::app()->request->baseUrl; ?>/css/error.css">
    <link rel="stylesheet" type="text/css" href="<?php echo Yii::app()->request->baseUrl; ?>/css/groupDelete.css">
    <link rel="stylesheet" type="text/css" href="<?php echo Yii::app()->request->baseUrl; ?>/node_modules/bootstrap/dist/css/bootstrap.css">

    <script src="<?php echo Yii::app()->request->baseUrl; ?>/node_modules/jquery/dist/jquery.js"></script>
    <script src="<?php echo Yii::app()->request->baseUrl; ?>/node_modules/bootstrap/dist/js/bootstrap.js"></script>
    <script src="<?php echo Yii::app()->request->baseUrl; ?>/js/GroupModal.js"></script>
    <script src="<?php echo Yii::app()->request->baseUrl; ?>/js/BudgetOwner.js"></script>
    <script src="<?php echo Yii::app()->request->baseUrl; ?>/js/DateCourse.js"></script>
    <script src="<?php echo Yii::app()->request->baseUrl; ?>/js/TeachersSelect.js"></script>
    <script src="<?php echo Yii::app()->request->baseUrl; ?>/js/ExpertsInput.js"></script>
    <script src="<?php echo Yii::app()->request->baseUrl; ?>/js/Frame.js"></script>
    <script src="<?php echo Yii::app()->request->baseUrl; ?>/js/profile.js"></script>
    <script src="<?php echo Yii::app()->request->baseUrl; ?>/js/GroupInfo.js"></script>
    <script src="<?php echo Yii::app()->request->baseUrl; ?>/js/DeleteGroup.js"></script>
    <script src="<?php echo Yii::app()->request->baseUrl; ?>/js/EditGroup.js"></script>
    <script src="<?php echo Yii::app()->request->baseUrl; ?>/js/GroupList.js"></script>
    <script src="<?php echo Yii::app()->request->baseUrl; ?>/js/LocationsList.js"></script>
    <title><?php echo CHtml::encode($this->pageTitle); ?></title>
</head>

<body>

<?php echo $content; ?>

<div class="clear"></div>

<script>
    document.addEventListener('DOMContentLoaded', locationsInit);

    function locationsInit() {
        let locationModal = document.querySelector('#locationModal'),
            locationsListModalUrlArray = [
                "<?= Yii::app()->createUrl('Locations/GetLocations'); ?>",
                "<?= Yii::app()->createUrl('Locations/ShowLocations'); ?>"
            ],
            groupInfoElement = new GroupInfo(),
            groupListMenu = new GroupList([
                    "<?= Yii::app()->createUrl('GroupList/GetGroupList'); ?>",
                    "<?= Yii::app()->createUrl('GroupList/ShowGroup'); ?>",
                    "<?= Yii::app()->createUrl('GroupList/GetMyGroupList'); ?>"],
                groupInfoElement,
                <?= Yii::app()->user->location; ?>
            ),

            profilePicture = document.querySelector('.profile_picture'),
            profileBlock = document.querySelector('.profile_block'),
            profile = new Profile(profilePicture, profileBlock),

            groupModalMenuElement = document.querySelector('#groupModal .groups'),
            groupModalMenu = new GroupModal([
                    "<?= Yii::app()->createUrl('Group/GetLocation'); ?>",
                    "<?= Yii::app()->createUrl('Group/GetTeachersList'); ?>",
                    "<?= Yii::app()->createUrl('Group/GetDirectionsList'); ?>",
                    "<?= Yii::app()->createUrl('Group/Create'); ?>",
                    "<?= Yii::app()->createUrl('Group/Edit'); ?>"
                ],
                groupModalMenuElement),
            deleteGroup = new DeleteGroup([
                "<?= Yii::app()->createUrl('Group/Delete'); ?>"]),
            editGroupModal = document.querySelector('#edit-group-modal .groups'),
            editGroup = new EditGroup([
                    "<?= Yii::app()->createUrl('Group/GetLocation'); ?>",
                    "<?= Yii::app()->createUrl('Group/GetTeachersList'); ?>",
                    "<?= Yii::app()->createUrl('Group/GetDirectionsList'); ?>",
                    "<?= Yii::app()->createUrl('Group/Create'); ?>",
                    "<?= Yii::app()->createUrl('Group/Edit'); ?>"
                ],
                editGroupModal),
            locationsListModal = null;

        locationsListModal = (locationsListModal === null)
            ? new LocationsList(locationModal, locationsListModalUrlArray, groupListMenu)
            : locationsListModal;

    }

</script>

</body>
</html>
