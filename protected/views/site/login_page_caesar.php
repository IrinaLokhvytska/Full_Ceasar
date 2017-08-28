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
        <?php echo $form->error($model,'username'); ?>
        <label>Login
            <?php echo $form->textField($model,'username',['class'=>'input-login']); ?>
        </label>    
    </div>

    <div class="row">
        <?php echo $form->error($model,'password'); ?>
        <label>Password
            <?php echo $form->passwordField($model,'password',['class'=>'input-password']);?>
        </label>
    </div>

    <div class="row buttons">
        <?php echo CHtml::submitButton('', ['class'=>'input-submit']);?>
    </div>

    <?php $this->endWidget();?>
</div>
