<?php

/* $dataArray - view argument
description:
$dataArray = [
    'groupName' => '',
    'groupDirection' => '',
    'studentList' => [
        [
            //student info
            'id' => '',
            'name' => '',
            'surname' => '',
            'photo_url' => '',
            'english_lvl' => '',
        ],
    ]
];
*/

//test

$dataArray = [
    'groupName' => 'DP12',
    'groupDirection' => 'PHP',
    'studentList' => [
        [
            //student info
            'id' => '1',
            'name' => 'Svetlana',
            'surname' => 'Dniprenko',
            'photo_url' => '/../users_picture/Klakovych.png',
            'english_lvl' => 'intermediate',
        ],
    ]
];

?>

<div class="modal fade" id="studentListEditModal">
    <div class="modal-dialog  modal-lg">
        <div class="modal-content">
            <div class="container-fluid">

                <div class="studentListEdit-modal">

                    <div class="studentListEdit-side left"></div>

                    <div class="studentListEdit-middle">
                        <div class="studentListEdit-middle-header">
                            <div
                                class="studentListEdit-location"><?= $dataArray['groupName'] . " " . $dataArray['groupDirection'] ?></div>
                            <button class="studentListEdit-addStudent">Add student</button>
                        </div>

                        <div class="studentListEdit-middle-studentList">
                            <table class="studentList">
                                <tr>
                                    <th>Name</th>
                                    <th>Photo</th>
                                    <th>English level</th>
                                    <th></th>
                                    <th></th>
                                    <th></th>
                                </tr>
                                <?php foreach ($dataArray['studentList'] as $student) : ?>
                                    <tr>
                                        <td class="align-left"><?= $student['name'] . ' ' . $student['surname']; ?></td>
                                        <td class="align-center"><img class="studentPhoto" src="<?= Yii::app()->basePath . $student['photo_url']; ?>"></td>
                                        <td class="align-center"><?= $student['english_lvl']; ?></td>
                                        <td class="align-center">
                                            <img class="studentIcon" data-toggle="modal" data-target="#downloadPhotoCV" src="<?= Yii::app()->basePath; ?>/../img/b_download48.png">
                                        </td>
                                        <td class="align-center">
                                            <img class="studentIcon" data-toggle="modal" data-target="#editStudentInfo" src="<?= Yii::app()->basePath; ?>/../img/b_cog48.png">
                                        </td>
                                        <td class="align-center">
                                            <img class="studentIcon" data-toggle="modal" data-target="#deleteStudentInfo" src="<?= Yii::app()->basePath; ?>/../img/b_trash48.png">
                                        </td>
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
                        <img class="studentIcon" src="<?= Yii::app()->basePath; ?>/../img/b_forward48.png">
                    </div>

                </div>

            </div>
        </div>
    </div>
</div>
