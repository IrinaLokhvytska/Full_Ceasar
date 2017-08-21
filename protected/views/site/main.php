<?php require_once 'modal.php'; ?>
<div class="loc-container">
    <header class="header box">SoftServe
        <img class="profile_picture" src="<?php echo Yii::app()->request->baseUrl; ?>/css/img/profile_picture.png">
    </header>
    <div class="loc-name box">Dnipro</div>
    <div class="group-name box">Dp-119 Php</div>
    <div class="status box">Stage: in process</div>
    <div class="message box">Some message</div>
    <aside class="local-groups box">
        <?php require 'groupsList.php'; ?>
    </aside>
    <aside class="notif box">
        <?php require_once 'locations.php'; ?>
    </aside>
    <main class="group-area box">
        <div class="gear">
            <a href="#">
                <img src="<?php echo Yii::app()->request->baseUrl; ?>/css/img/gear.png" class="gear-img" alt="gear icon">
            </a>
        </div>
        <div class="tabs">
            <a href="#">
                <img src="<?php echo Yii::app()->request->baseUrl; ?>/css/img/information-checked.png" class="tab-icons tabInfo" alt="info icon">
            </a>
            <a href="#">
                <img src="<?php echo Yii::app()->request->baseUrl; ?>/css/img/students.png" class="tab-icons tabStudents" alt="students icon">
            </a>
            <a href="#">
                <img src="<?php echo Yii::app()->request->baseUrl; ?>/css/img/schedule.png" class="tab-icons tabSchedule" alt="schedule icon">
            </a>
            <a href="#">
                <img src="<?php echo Yii::app()->request->baseUrl; ?>/css/img/envelope.png" class="tab-icons tabNotification" alt="envelope icon">
            </a>
        </div>
        <?php require_once 'groupInfo.php'; ?>
    </main>

    <div class="profile_block">
        <img class="cogwheel_picture" src="<?php echo Yii::app()->request->baseUrl; ?>/css/img/profile_cogwheel.png">
        <div class="user_info">
            <img class="user_picture" src="<?php echo Yii::app()->request->baseUrl; ?>/css/img/profile_picture.png">
            <p class="user_name">Name</p>
            <p class="user_surname">Surname</p>
            <p class="user_role">Role</p>
        </div>

        <a href="<?php echo Yii::app()->createAbsoluteUrl('site/logout'); ?>">
            <img class="logout" src="<?php echo Yii::app()->request->baseUrl; ?>/css/img/profile_logout.png">
        </a>
    </div>
</div>
