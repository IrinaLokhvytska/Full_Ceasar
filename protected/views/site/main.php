<div class="check-delete"></div>
<div class="loc-container">
    <header class="header box">SoftServe
        <img class="profile_picture"
             src="<?php echo Yii::app()->request->baseUrl; ?><?php echo Yii::app()->user->picture; ?>">
    </header>
    <div class="left-popup"></div>
    <div class="right-popup"></div>
    <div class="loc-name box"></div>
    <div class="group-name box"></div>
    <div class="status box">Stage: in process</div>
    <div class="message box">Some message</div>
    <aside class="local-groups box">
        <?php require Yii::app()->basePath . '/views/site/groupList.php'; ?>
    </aside>
    <aside class="notif box"></aside>
    <main class="group-area box">
        <div class="gear">
            <?php if (Yii::app()->user->type === 'itacademy'): ?>
                <a href="#" data-toggle="modal" data-target="#edit-group-modal">
                    <img src="<?php echo Yii::app()->request->baseUrl; ?>/css/img/gear.png" class="gear-img" alt="gear icon">
                </a>
                <a href="#" class="delete-group">
                    <img src="<?php echo Yii::app()->request->baseUrl; ?>/css/img/trash.jpg" class="trash-img" alt="trash bin icon">
                </a>
            <?php endif; ?>
        </div>
        <div class="tabs">
            <a href="#">
                <img src="<?php echo Yii::app()->request->baseUrl; ?>/css/img/information-checked.png"
                     class="tab-icons tabInfo" alt="info icon">
            </a>
            <a href="#">
                <img src="<?php echo Yii::app()->request->baseUrl; ?>/css/img/students.png"
                     class="tab-icons tabStudents" alt="students icon">
            </a>
            <a href="#">
                <img src="<?php echo Yii::app()->request->baseUrl; ?>/css/img/schedule.png"
                     class="tab-icons tabSchedule" alt="schedule icon">
            </a>
            <a href="#">
                <img src="<?php echo Yii::app()->request->baseUrl; ?>/css/img/envelope.png"
                     class="tab-icons tabNotification" alt="envelope icon">
            </a>
        </div>
        <?php require Yii::app()->basePath . '/views/site/groupInfo.php'; ?>
    </main>

    <div class="profile_block">
        <img class="cogwheel_picture" src="<?php echo Yii::app()->request->baseUrl; ?>/css/img/gear.png">
        <div class="user_info">
            <img class="user_picture"
                 src="<?php echo Yii::app()->request->baseUrl; ?><?php echo Yii::app()->user->picture; ?>">
            <p class="user_name">Name: <?php echo Yii::app()->user->firstname; ?></p>
            <p class="user_surname">Surname <?php echo Yii::app()->user->lastname; ?></p>

            <p class="user_role">Type <?php echo Yii::app()->user->type; ?></p>
        </div>

        <a href="<?php echo Yii::app()->createAbsoluteUrl('site/logout'); ?>">
            <img class="logout" src="<?php echo Yii::app()->request->baseUrl; ?>/css/img/profile_logout.png">
        </a>
    </div>

    <div class="leftside-bar">
        <?php if (Yii::app()->user->type === 'itacademy'): ?>
            <a data-toggle="modal" href="#locationModal">
                <img src="<?php echo Yii::app()->request->baseUrl; ?>/css/img/globe.png" class="globe-img"
                     alt="globe icon">
            </a>
        <?php endif; ?>
    </div>


</div>
<?php require Yii::app()->basePath . '/views/site/locations.php'; ?>
<?php require Yii::app()->basePath . '/views/site/modal.php'; ?>
<?php require Yii::app()->basePath . '/views/site/edit_group.php'; ?>

