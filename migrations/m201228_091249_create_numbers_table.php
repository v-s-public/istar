<?php

use yii\db\Migration;

/**
 * Handles the creation of table `{{%numbers}}`.
 */
class m201228_091249_create_numbers_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable('{{%numbers}}', [
            'contact_id' => $this->integer(11)->notNull(),
            'number' => $this->string(13)->notNull()
        ]);

        $this->addPrimaryKey('pk_numbers', 'numbers', ['contact_id', 'number']);

        $this->addForeignKey(
            'fk_numbers_contacts',
            'numbers',
            'contact_id',
            'contacts',
            'contact_id',
            'CASCADE',
            'CASCADE'
        );
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropTable('{{%numbers}}');
    }
}
