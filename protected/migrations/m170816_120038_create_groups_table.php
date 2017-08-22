<?php

class m170816_120038_create_groups_table extends CDbMigration
{
	public function up()
	{
        $this->execute('
            CREATE TABLE IF NOT EXISTS `groups` (
            `id` INT NOT NULL AUTO_INCREMENT,
            `name` VARCHAR(45) NOT NULL,
            `location_id` INT NOT NULL,
            `direction_id` INT NOT NULL,
            `start_date` datetime DEFAULT NULL,
            `finish_date` datetime DEFAULT NULL,
            `budget` VARCHAR(45) NOT NULL,
            `expert` VARCHAR(50) NOT NULL,
            PRIMARY KEY (`id`))
            ENGINE = InnoDB DEFAULT CHARSET=utf8;
        ');

        $this->execute('
            ALTER TABLE `groups`
            ADD CONSTRAINT `group_location` FOREIGN KEY (`location`) REFERENCES `locations` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;
        ');
	}

	public function down()
	{
        $this->dropForeignKey('group_location', 'groups');
        $this->dropTable('groups');
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