<!--<link rel="stylesheet" type="text/css" href="--><?php //echo Yii::app()->request->baseUrl; ?><!--/css/mainPage/groupInfo.css">-->
<?php
$baseUrl = Yii::app()->baseUrl;
$cs = Yii::app()->getClientScript();
$cs->registerCssFile($baseUrl . '/css/mainPage/groupInfo.css');
?>

<div class="group-coordination"><span class="text">Group coordination:</span></div>
<div class="group-info"><span class="text">Group info:</span></div>
<table class="coordination-table group-info-tables">
    <tr>
        <th><br/></th>
        <th></th>
    </tr>
    <tr>
        <td>Teacher</td>
        <td>Oleg Shvets</td>
    </tr>
    <tr>
        <td>Expert</td>
        <td>Yuriy Osypchuk</td>
    </tr>
</table>
<table class="info-table group-info-tables">
    <tr>
        <th><br/></th>
        <th></th>
    </tr>
    <tr>
        <td>Date start:</td>
        <td class="start-date-table">undefined</td>
    </tr>
    <tr>
        <td>Date finish:</td>
        <td class="finish-date-table">undefined</td>
    </tr>
</table>
<div class="middle-space"></div>