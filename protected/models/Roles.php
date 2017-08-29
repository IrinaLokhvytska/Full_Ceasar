<?php

class Roles extends CActiveRecord
{
	public function tableName()
	{
		return 'roles';
	}

	public function relations()
	{
		return array(
			'userRoles' => array(self::HAS_MANY, 'UserRoles', 'role_id'),
		);
	}

        public function attributeLabels()
	{
		return array(
			'id' => 'ID',
			'name' => 'Name',
		);
	}

	public function search()
	{
		$criteria=new CDbCriteria;

		$criteria->compare('id',$this->id);
		$criteria->compare('name',$this->name,true);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}

	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}
}
