<?php

namespace app\models;

use yii\base\Model;

/**
 * ContactForm is the model behind the contact form.
 */
class ContactForm extends Model
{
    public $name;
    public $second_name;
    public $email;
    public $b_date;
    public $number;

    /**
     * @return array the validation rules.
     */
    public function rules()
    {
        return [
            [['name'], 'required'],
            ['b_date', 'safe'],
            ['b_date', 'date', 'format' => 'php:Y-m-d'],
            [['name', 'second_name', 'email'], 'string', 'max' => 100],
            ['email', 'email'],
            ['email', 'unique',
                'targetClass' => Contact::class,
                'targetAttribute' => 'email'],
            [['number'], 'string', 'max' => 13],
        ];
    }

    /**
     * @return array customized attribute labels
     */
    public function attributeLabels()
    {
        return [
            'name' => 'Name',
            'second_name' => 'Second Name',
            'email' => 'Email',
            'b_date' => 'Birth Date',
            'number' => 'Phone Number'
        ];
    }

    /**
     * Save form data to Contact model
     *
     * @return bool
     */
    public function saveContact()
    {
        $contact = new Contact();
        $contact->attributes = $this->attributes;
        return $contact->save();
    }
}
