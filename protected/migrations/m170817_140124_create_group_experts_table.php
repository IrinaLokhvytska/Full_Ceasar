<?php

class m170817_140124_create_group_experts_table extends CDbMigration
{
	public function up()
	{
        $this->execute('
            CREATE TABLE IF NOT EXISTS `group_experts` (
            `id` INT NOT NULL AUTO_INCREMENT,
            `group` INT NOT NULL,
            `name` VARCHAR(45) NOT NULL,
            PRIMARY KEY (`id`))
            ENGINE = InnoDB DEFAULT CHARSET=utf8;
        ');

        $this->execute('
            ALTER TABLE `group_experts`
            ADD CONSTRAINT `group_experts` FOREIGN KEY (`group`) REFERENCES `groups` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;
        ');
	}

	public function down()
	{
        $this->dropForeignKey('group_experts', 'group_experts');
        $this->dropTable('group_experts');
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