<div class="login">

    <form class="login-form"  action="<?php echo Yii::app()->createAbsoluteUrl('site/main'); ?>" method="post">
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

</div>
