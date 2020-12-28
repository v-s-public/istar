<?php

namespace app\models;

use Yii;
use yii\base\Model;

/**
 * ContactForm is the model behind the contact form.
 */
class ContactForm extends Model
{
    public $contact_id;
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
            [['contact_id', 'second_name', 'date', 'email'], 'safe'],
            [['name', 'second_name', 'email'], 'string', 'max' => 100],
            ['b_date', 'date', 'format' => 'php:Y-m-d'],
            [['second_name'], 'default', 'value'=> NULL],
            [['b_date'], 'default', 'value'=> NULL],
            ['email', 'email'],
            [['email'], 'default', 'value'=> NULL],
            ['email', 'validateEmail'],
            [['number'], 'string', 'max' => 13],
        ];
    }

    /**
     * Custom validation rule for e-mail
     *
     * @param $attribute
     */
    public function validateEmail($attribute)
    {
        $contact = $this->getContactByEmail();

        if ($this->contact_id) {
            if ($contact) {
                if ($contact->contact_id !== $this->contact_id) {
                    $this->addError($attribute, 'This email in use!');
                }
            }
        } else {
            $contact ? $this->addError($attribute, 'This email in use!') : null;
        }
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

    /**
     * Update contact
     *
     * @param Contact $contact
     * @return bool
     */
    public function updateContact(Contact $contact)
    {
        $contact->attributes = $this->attributes;
        return $contact->save();
    }

    /**
     * Find contact by e-mail
     *
     * @return array|\yii\db\ActiveRecord|null
     */
    private function getContactByEmail()
    {
        return Contact::find()->where(['email' => $this->email])->one();
    }
}
