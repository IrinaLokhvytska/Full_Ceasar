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
                        "class" =>"studentPhoto",
                    ))'
            ],
            [
                'name' => 'Incoming test',
                'type' => 'raw',
                'value' => 'CHtml::encode($data["incoming_test"])',
            ],
            [
                'name' => 'Entry score',
                'type' => 'raw',
                'value' => 'CHtml::encode($data["entry_score"])',
            ],
            [
                'name' => 'Approved by',
                'type' => 'raw',
                'value' => 'CHtml::encode($data["approved_by"])',
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
        ['StudentList/GridView/group_id/2'],
        [
            'update' => '.group-area-content',
        ]);
    ?>
</div>


