св<?php

class m170816_120012_create_users_table extends CDbMigration
{
	public function up()
	{
        $this->execute('
            CREATE TABLE IF NOT EXISTS `users` (
            `id` INT NOT NULL AUTO_INCREMENT,
            `first_name` VARCHAR(45) NOT NULL,
            `last_name` VARCHAR(45) NOT NULL,
            `username` VARCHAR(45) NOT NULL,
            `password` VARCHAR(45) NOT NULL,
            `location_id` INT NOT NULL,
            `picture` VARCHAR(100) NOT NULL,
            `type` VARCHAR(45) NOT NULL,
            PRIMARY KEY (`id`),
            UNIQUE `username` (`username`)) ENGINE = InnoDB DEFAULT CHARSET=utf8;
        ');
	}

	public function down()
	{
		$this->dropTable('users');
	}

	/*
	// Use safeUp/safeDown to do migration with transaction
	public function safeUp()
	{
	}

	public function safeDown()
	{
	}
	*/
}