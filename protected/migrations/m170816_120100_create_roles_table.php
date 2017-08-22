<?php

class m170816_120100_create_roles_table extends CDbMigration
{
	public function up()
	{
        $this->execute('
            CREATE TABLE IF NOT EXISTS `roles` (
            `id` INT NOT NULL AUTO_INCREMENT,
            `name` VARCHAR(45) NOT NULL,
            PRIMARY KEY (`id`))
            ENGINE = InnoDB DEFAULT CHARSET=utf8;
        ');

        $builder=Yii::app()->db->schema->commandBuilder;
        $command=$builder->createMultipleInsertCommand('roles', [
                ['id'=>1, 'name'=>'teacher'],
                ['id'=>2, 'name'=>'coordinator'],
                ['id'=>3, 'name'=>'administrator'],
                ['id'=>4, 'name'=>'recruiter'],
                ['id'=>5, 'name'=>'guest'],
                ['id'=>6, 'name'=>'tse'],
            ]);
        $command->execute();
	}

	public function down()
	{
		$this->dropTable('roles');
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