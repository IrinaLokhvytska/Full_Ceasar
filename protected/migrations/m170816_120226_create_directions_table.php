<?php

class m170816_120226_create_directions_table extends CDbMigration
{
	public function up()
	{
        $this->execute('
            CREATE TABLE IF NOT EXISTS `directions` (
            `id` INT NOT NULL AUTO_INCREMENT,
            `name` VARCHAR(45) NOT NULL,
            `stream` INT NOT NULL,
            PRIMARY KEY (`id`))
            ENGINE = InnoDB DEFAULT CHARSET=utf8;
        ');

        $this->execute('
            ALTER TABLE `directions`
            ADD CONSTRAINT `stream` FOREIGN KEY (`stream`) REFERENCES `streams` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;
        ');

        $this->execute('
            ALTER TABLE `groups`
            ADD CONSTRAINT `direction` FOREIGN KEY (`direction`) REFERENCES `directions` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;
        ');
	}

	public function down()
	{
        $this->dropForeignKey('stream', 'directions');
		$this->dropForeignKey('direction', 'groups');
        $this->dropTable('directions');
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