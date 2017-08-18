<!--<div class="login">

    <form class="login-form"  action="<?php /*echo Yii::app()->createAbsoluteUrl('site/main'); */?>" method="post">
        <p class="errorLoginForm"></p>
        <label>Login
            <input class="input-login" type="text" name="login" required>
        </label>
        <br>
        <label>Password
            <input class="input-password" type="password" name="password" required>
        </label>
        <br>
        <input class="input-submit" type="submit" value="" required>
    </form>

</div>-->



<div class="login">
    <?php $form=$this->beginWidget('CActiveForm', array(
        'id'=>'login-form',
        'enableClientValidation'=>true,
        'clientOptions'=>array(
            'validateOnSubmit'=>true,
        ),
    )); ?>
    <p class="errorLoginForm"></p>
    <div class="row">
        <?php echo $form->error($model,'username', ['class'=>'errorLoginForm']); ?>
        <?php echo $form->labelEx($model,'username'); ?>
        <?php echo $form->textField($model,'username',['class'=>'input-login']); ?>
    </div>

    <div class="row">
        <?php echo $form->error($model,'password', ['class'=>'errorLoginForm']); ?>
        <?php echo $form->labelEx($model,'password'); ?>
        <?php echo $form->passwordField($model,'password',['class'=>'input-password']); ?>
    </div>

    <div class="row buttons">
        <?php echo CHtml::submitButton('Login', ['class'=>'input-submit']); ?>
    </div>

    <?php $this->endWidget(); ?>
</div>