<?php

class m170816_120048_create_streams_table extends CDbMigration
{
	public function up()
	{
        $this->execute('
            CREATE TABLE IF NOT EXISTS `streams` (
            `id` INT NOT NULL AUTO_INCREMENT,
            `name` VARCHAR(45) NOT NULL,
            PRIMARY KEY (`id`))
            ENGINE = InnoDB DEFAULT CHARSET=utf8;
        ');

        $builder=Yii::app()->db->schema->commandBuilder;
        $command=$builder->createMultipleInsertCommand('streams', [
                ['name'=>'SoftwareDevelopment'],
                ['name'=>'QualityControl'],
                ['name'=>'ITandCM'],
                ['name'=>'UX'],
            ]);
        $command->execute();
	}

	public function down()
	{
		$this->dropTable('streams');
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