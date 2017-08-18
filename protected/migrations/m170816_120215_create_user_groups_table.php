<?php

class m170816_120215_create_user_groups_table extends CDbMigration
{
	public function up()
	{
        $this->execute('
            CREATE TABLE IF NOT EXISTS `user_groups` (
            `id` INT NOT NULL AUTO_INCREMENT,
            `user` INT NOT NULL,
            `group` INT NOT NULL,
            PRIMARY KEY (`id`))
            ENGINE = InnoDB DEFAULT CHARSET=utf8;
        ');

        $this->execute('
            ALTER TABLE `user_groups`
            ADD CONSTRAINT `user_group` FOREIGN KEY (`id`) REFERENCES `users` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
            ADD CONSTRAINT `group` FOREIGN KEY (`group`) REFERENCES `groups` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;
        ');
	}

	public function down()
	{
		$this->dropForeignKey('user_group', 'user_groups');
        $this->dropForeignKey('group', 'user_groups');
        $this->dropTable('user_groups');
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