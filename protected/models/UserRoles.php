<?php

class UserRoles extends CActiveRecord
{
	public function tableName()
	{
		return 'user_roles';
	}
        
	public function relations()
	{
		return array(
			'role' => array(self::BELONGS_TO, 'Roles', 'role_id'),
			'user' => array(self::BELONGS_TO, 'Users', 'user_id'),
		);
	}

	public function attributeLabels()
	{
		return array(
			'id' => 'ID',
			'user_id' => 'User',
			'role_id' => 'Role',
		);
	}

	public function search()
	{
		
		$criteria=new CDbCriteria;

		$criteria->compare('id',$this->id);
		$criteria->compare('user_id',$this->user_id);
		$criteria->compare('role_id',$this->role_id);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}

	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}
}
