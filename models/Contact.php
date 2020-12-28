<?php

namespace app\models;

use yii\db\ActiveQuery;
use yii\db\ActiveRecord;

/**
 * This is the model class for table "contacts".
 *
 * @property int $contact_id
 * @property string $name
 * @property string|null $second_name
 * @property string|null $email
 * @property string|null $b_date
 *
 * @property Number[] $numbers
 */
class Contact extends ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'contacts';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['name'], 'required'],
            [['b_date'], ['safe', 'date']],
            [['name', 'second_name', 'email'], 'string', 'max' => 100],
            [['email'], ['email', 'unique']],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'contact_id' => 'Contact ID',
            'name' => 'Name',
            'second_name' => 'Second Name',
            'email' => 'Email',
            'b_date' => 'B Date',
        ];
    }

    /**
     * Gets query for [[Number]].
     *
     * @return ActiveQuery
     */
    public function getNumbers()
    {
        return $this->hasMany(Number::class, ['contact_id' => 'contact_id']);
    }
}
