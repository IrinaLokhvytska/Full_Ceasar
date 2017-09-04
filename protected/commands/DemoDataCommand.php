<?php

class DemoDataCommand extends CConsoleCommand
{
    // $app = Yii::app();
    // const USERS = Yii::app()->basePath . '/data/demo/users.php';
    // const LOCATIONS = Yii::app()->basePath . '/data/demo/locations.php';
    // const GROUPS = Yii::app()->basePath . '/data/demo/groups.php';
    // const USER_GROUPS = Yii::app()->basePath . '/data/demo/user_groups.php';
    // const USER_ROLES = Yii::app()->basePath . '/data/demo/user_roles.php';
    // const DIRECTIONS = Yii::app()->basePath . '/data/demo/directions.php';

    public function actionFillOutAllTables()
    {
        $this->actionFillOutTableLocations();
        $this->actionFillOutTableUsers();
        $this->actionFillOutTableDirections();
        $this->actionFillOutTableGroups();
        $this->actionFillOutTableUserGroups();
        $this->actionFillOutTableUserRoles();
        $this->actionFillOutTableExperts();
        $this->actionFillOutTableStudents();
    }

    public function actionFillOutTableLocations()
    {
        $locations = require_once Yii::app()->basePath . '/data/demo/locations.php';
        $command = Yii::app()->db->createCommand();
        foreach ($locations as $location) {
            $command->insert('locations', $location);
        }
    }

    public function actionFillOutTableUsers()
    {
        $users = require_once Yii::app()->basePath . '/data/demo/users.php';
        $command = Yii::app()->db->createCommand();
        foreach ($users as $user) {
            $command->insert('users', $user);
        }
    }

    public function actionFillOutTableDirections()
    {
        $directions = require_once Yii::app()->basePath . '/data/demo/directions.php';
        $command = Yii::app()->db->createCommand();
        foreach ($directions as $direction) {
            $command->insert('directions', $direction);
        }
    }

    public function actionFillOutTableGroups()
    {
        $groups = require_once Yii::app()->basePath . '/data/demo/groups.php';
        $command = Yii::app()->db->createCommand();
        foreach ($groups as $group) {
            $command->insert('groups', $group);
        }
    }

    public function actionFillOutTableUserGroups()
    {
        $user_groups = require_once Yii::app()->basePath . '/data/demo/user_groups.php';
        $command = Yii::app()->db->createCommand();
        foreach ($user_groups as $user_group) {
            $command->insert('user_groups', $user_group);
        }
    }

    public function actionFillOutTableUserRoles()
    {
        $user_roles = require_once Yii::app()->basePath . '/data/demo/user_roles.php';
        $command = Yii::app()->db->createCommand();
        foreach ($user_roles as $user_role) {
            $command->insert('user_roles', $user_role);
        }
    }

    public function actionFillOutTableExperts()
    {
        $demodata = require_once Yii::app()->basePath . '/data/demo/experts.php';
        $command = Yii::app()->db->createCommand();
        foreach ($demodata as $columnsArr) {
            $command->insert('experts', $columnsArr);
        }
    }

    public function actionFillOutTableStudents()
    {
        $demodata = require_once Yii::app()->basePath . '/data/demo/students.php';
        $command = Yii::app()->db->createCommand();
        foreach ($demodata as $columnsArr) {
            $command->insert('students', $columnsArr);
        }
    }
}
