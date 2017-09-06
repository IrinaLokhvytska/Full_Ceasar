<?php

$dataArray = [
    'groupName' => 'DP12',
    'groupDirection' => 'PHP',
    'studentList' => [
        [
            //student info
            'id' => '1',
            'name' => 'Svetlana',
            'surname' => 'Dniprenko',
            'photo_url' => 'users_picture/Klakovych.png',
            'incoming_test' => '600',
            'entry_score' => '4.0',
            'approved_by' => 'Bezrukavyi'
        ],
        [
            //student info
            'id' => '1',
            'name' => 'Svetlana',
            'surname' => 'Dniprenko',
            'photo_url' => 'users_picture/Klakovych.png',
            'incoming_test' => '600',
            'entry_score' => '4.0',
            'approved_by' => 'Bezrukavyi'
        ],
        [
            //student info
            'id' => '1',
            'name' => 'Svetlana',
            'surname' => 'Dniprenko',
            'photo_url' => 'users_picture/Klakovych.png',
            'incoming_test' => '600',
            'entry_score' => '4.0',
            'approved_by' => 'Bezrukavyi'
        ],
    ]
];

?>

<div class="modal fade" id="studentListEditModal">
    <div class="modal-dialog  modal-lg">
        <div class="modal-content">
            <div class="container-fluid">
                <div class="studentListEdit-modal">
                    <div class="studentListEdit-side left">
                        <img class="studentIcon" src="<?php echo Yii::app()->request->baseUrl; ?>/css/img/b_back48.png">
                    </div>
                    <div class="studentListEdit-middle">
                        <div class="studentListEdit-middle-studentList">
                            <table class="studentList">
                                <tr>
                                    <th>Name</th>
                                    <th>Photo</th>
                                    <th>Incoming test</th>
                                    <th>Entry score</th>
                                    <th>Approved by</th>
                                    <th></th>
                                </tr>
                                <?php foreach ($dataArray['studentList'] as $student) : ?>
                                    <tr>
                                        <td class="align-left"><?= $student['name'] . ' ' . $student['surname']; ?></td>
                                        <td class="align-center"><img class="studentFoto"
                                                                      src="<?= $student['photo_url']; ?>"></td>
                                        <td class="align-center"><?= $student['incoming_test']; ?></td>
                                        <td class="align-center"><?= $student['entry_score']; ?></td>
                                        <td class="align-center"><?= $student['approved_by']; ?></td>
                                    </tr>
                                <?php endforeach; ?>
                            </table>
                        </div>

                        <div class="studentListEdit-middle-footer">
                            <button type="button" class="submit">
                                <span class="glyphicon glyphicon-ok"></span>
                            </button>
                            <button type="button" class="close-modal" data-dismiss="modal">
                                <span class="glyphicon glyphicon-remove"></span>
                            </button>
                        </div>
                    </div>
                    <div class="studentListEdit-side right">
                        <img class="studentIcon"
                             src="<?php echo Yii::app()->request->baseUrl; ?>/css/img/b_forward48.png">
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

