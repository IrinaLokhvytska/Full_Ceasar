<a data-toggle="modal" href="#locationModal">
    <img src="<?php echo Yii::app()->request->baseUrl; ?>/css/img/globe.png" class="globe-img" alt="globe icon">
</a>

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

<script>
    document.addEventListener('DOMContentLoaded', locationsInit);

    function locationsInit() {
        let locationModal = document.querySelector('#locationModal'),
            urlArray = [
                "<?= Yii::app()->createUrl('Locations/GetLocations'); ?>",
                "<?= Yii::app()->createUrl('Locations/ShowLocations'); ?>"
            ];
        locationsListModal = null;
        locationsListModal = (locationsListModal === null)
            ? new LocationsList(locationModal, urlArray)
            : locationsListModal;
    }
</script>