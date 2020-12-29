<?php

namespace app\models;

use yii\db\ActiveQuery;
use yii\db\ActiveRecord;

/**
 * This is the model class for table "numbers".
 *
 * @property int $contact_id
 * @property string $number
 *
 * @property Contact $contact
 */
class Number extends ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'numbers';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['contact_id', 'number'], 'required'],
            [['contact_id'], 'integer'],
            [['number'], 'string', 'max' => 13],
            [['contact_id', 'number'], 'unique', 'targetAttribute' => ['contact_id', 'number']],
            [['contact_id'], 'exist', 'skipOnError' => true, 'targetClass' => Contact::class, 'targetAttribute' => ['contact_id' => 'contact_id']],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'contact_id' => 'Contact ID',
            'number' => 'Number',
        ];
    }

    /**
     * Gets query for [[Contact]].
     *
     * @return ActiveQuery
     */
    public function getContact()
    {
        return $this->hasOne(Contact::class, ['contact_id' => 'contact_id']);
    }
}
