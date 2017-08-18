<?php

class m170816_120030_create_locations_table extends CDbMigration
{
	public function up()
	{
        $this->execute('
            CREATE TABLE IF NOT EXISTS `locations` (
            `id` INT NOT NULL AUTO_INCREMENT,
            `short_name` VARCHAR(45) NOT NULL,
            `full_name` VARCHAR(45) NOT NULL,
            PRIMARY KEY (`id`))
            ENGINE = InnoDB DEFAULT CHARSET=utf8;
        ');

        $this->execute('
            ALTER TABLE `users`
            ADD CONSTRAINT `user_location` FOREIGN KEY (`location`) REFERENCES `locations` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;
        ');
	}

	public function down()
	{
        $this->dropForeignKey('user_location', 'users');
        $this->dropTable('locations');
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