<?php
/* @var $this SiteController */
/* @var $error array */

$this->pageTitle='SoftServe ITAcademy'. ' - Error';
$this->breadcrumbs=array(
    'Error',
);
?>


<div class="nb-error">
    <div class="error-code">
        <?php echo $code; ?>
        <div class="error-box">
            <h3 class="font-bold">We couldn't find the page.<?php echo CHtml::encode($message); ?></h3>
            Sorry, but the page you are looking for was either not found or does not exist. <br/>
            Try refreshing the page or click the button to go back to the Homepage.
        </div>
    </div>
</div>