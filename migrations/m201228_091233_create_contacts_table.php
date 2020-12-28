<?php

use yii\db\Migration;

/**
 * Handles the creation of table `{{%contacts}}`.
 */
class m201228_091233_create_contacts_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable('{{%contacts}}', [
            'contact_id' => $this->primaryKey(),
            'name' => $this->string(100)->notNull(),
            'second_name' => $this->string(100)->null(),
            'email' => $this->string(100)->unique()->null(),
            'b_date' => $this->date()->null()
        ]);
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropTable('{{%contacts}}');
    }
}
