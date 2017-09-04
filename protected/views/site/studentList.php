
<div class="students-list">
    <?php
    $this->widget('zii.widgets.grid.CGridView', [
        'dataProvider' => $arrayDataProvider,
        'columns' => [
            [
                'name' => 'Name',
                'type' => 'raw',
                'value' => 'CHtml::encode($data["first_name"]) . " " . CHtml::encode($data["last_name"])'
            ],
            [
                'name' => 'Photo',
                'type' => 'raw',
                'value' => 'CHtml::image(Yii::app()->request->baseUrl . $data["photo_url"], "student.png", array(
                        "class" =>"student-list-photo",
                    ))'
            ],
            [
                'name' => 'English level',
                'type' => 'raw',
                'value' => 'CHtml::encode($data["english_lvl"])',
            ],
        ],
    ]);
    ?>
</div>
<div class="students-list-right-shifter">
    <?php
    $rightShifterImg = CHtml::image(Yii::app()->request->baseUrl . "/css/img/b_forward48.png", 'forwardBtn.png',
        [
            'class' => 'studentIcon',
        ]);
    echo CHtml::ajaxLink($rightShifterImg,
        ['StudentList/ScoreTable/group_id/2'],
        [
            'update' => '.group-area-content',
        ]);
    ?>
</div>


