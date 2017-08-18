<?php

class m170816_120208_create_user_roles_table extends CDbMigration
{
	public function up()
	{
        $this->execute('
            CREATE TABLE IF NOT EXISTS `user_roles` (
            `id` INT NOT NULL AUTO_INCREMENT,
            `user` INT NOT NULL,
            `role` INT NOT NULL,
            PRIMARY KEY (`id`))
            ENGINE = InnoDB DEFAULT CHARSET=utf8;
        ');

        $this->execute('
            ALTER TABLE `user_roles`
            ADD CONSTRAINT `user_role` FOREIGN KEY (`id`) REFERENCES `users` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
            ADD CONSTRAINT `role` FOREIGN KEY (`role`) REFERENCES `roles` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;
        ');
	}

	public function down()
	{
		$this->dropForeignKey('user_role', 'user_roles');
        $this->dropForeignKey('role', 'user_roles');
        $this->dropTable('user_roles');
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