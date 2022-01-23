<?php

use yii\db\Migration;

/**
 * Class m220123_105153_create_tables
 */
class m220123_105153_create_tables extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $tableOptions = null;

        $this->createTable('{{%instruction}}', [
            'id' => $this->primaryKey(),
            'name' => $this->string()->notNull(),
            'author' => $this->string()->notNull(),
            'release_number' => $this->integer()->notNull(),
            'release_date' => $this->datetime()->notNull(),
            'additional_info' => $this->string(),
        ], $tableOptions);

        $this->createTable('{{%instructionCharacteristic}}', [
            'id' => $this->primaryKey(),
            'name' => $this->string(),
            'norm_value' => $this->float(),
            'add_tolerance' => $this->float(),
            'sub_tolerance' => $this->float(),
            'measure_unit' => $this->string(),
            'number_of_repetition' => $this->integer(),
            'instruction_id' => $this->integer()->notNull(),
        ], $tableOptions);
    
        $this->createIndex(
            'idx-instructionCharacteristic-instruction_id',
            'instructionCharacteristic',
            'instruction_id'
        );

        $this->addForeignKey(
            'fk-instructionCharacteristic-instruction_id',
            'instructionCharacteristic',
            'instruction_id',
            'instruction',
            'id',
            'CASCADE'
        );
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropForeignKey(
            'fk-instructionCharacteristic-instruction_id',
            'instructionCharacteristic'
        );

        $this->dropIndex(
            'idx-instructionCharacteristic-instruction_id',
            'instructionCharacteristic'
        );

        $this->dropTable('{{%instructionCharacteristic}}');
        
        $this->dropTable('{{%instruction}}');
    }
}
