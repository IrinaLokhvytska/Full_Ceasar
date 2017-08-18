<?php

class m170816_120237_create_notifications_table extends CDbMigration
{
	public function up()
	{
        $this->execute('
            CREATE TABLE IF NOT EXISTS `notifications` (
            `id` INT NOT NULL AUTO_INCREMENT,
            `message` VARCHAR(100) NOT NULL,
            `group_id` INT NOT NULL,
            PRIMARY KEY (`id`))
            ENGINE = InnoDB DEFAULT CHARSET=utf8;
        ');
	}

	public function down()
	{
		$this->dropTable('notifications');
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