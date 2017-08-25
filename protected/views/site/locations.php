<?php if (Yii::app()->user->type === 'itacademy'): ?>
<a data-toggle="modal" href="#locationModal">
    <img src="<?php echo Yii::app()->request->baseUrl; ?>/css/img/globe.png" class="globe-img" alt="globe icon">
</a>
<?php endif; ?>

<div class="modal fade" id="locationModal">
    <div class="modal-dialog  modal-lg">
        <div class="modal-content">
            <div class="wrapper">
                <aside class="left"></aside>
                <aside class="right"></aside>
                <div class="loc-list">
                </div>
                <div class="footer">
                    <button type="button" class="btn btn-secondary pull-right" data-dismiss="modal" id="confirm">Confirm</button>
                    <button type="button" class="btn btn-secondary pull-right btnClose" data-dismiss="modal">Close</button>
                </div>
            </div>
        </div>
    </div>
</div>
