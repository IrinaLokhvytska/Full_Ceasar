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
        <?php echo $form->labelEx($model,'username');?>
        <?php echo $form->textField($model,'username',['class'=>'input-login']); ?>
    </div>

    <div class="row">
        <?php echo $form->error($model,'password'); ?>
        <?php echo $form->labelEx($model,'password'); ?>
        <?php echo $form->passwordField($model,'password',['class'=>'input-password']);?>

    </div>

    <div class="row buttons">
        <?php echo CHtml::submitButton('', ['class'=>'input-submit']);?>
    </div>

    <?php $this->endWidget();?>
</div>