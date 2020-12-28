<?php

namespace app\models;

use yii\base\Model;

/**
 * ContactForm is the model behind the contact form.
 */
class ContactForm extends Model
{
    public $name;
    public $secondName;
    public $email;
    public $bDate;
    public $number;

    /**
     * @return array the validation rules.
     */
    public function rules()
    {
        return [
            [['name'], 'required'],
            [['b_date'], ['safe', 'date']],
            [['name', 'second_name', 'email'], 'string', 'max' => 100],
            ['email', 'email'],
            [['email'], 'exist',
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
}
