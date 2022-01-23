<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "instruction".
 *
 * @property int $id
 * @property string $name
 * @property string $author
 * @property int $release_number
 * @property string $release_date
 * @property string|null $additional_info
 *
 * @property InstructionCharacteristic[] $instructionCharacteristics
 */
class Instruction extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'instruction';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['name', 'author', 'release_number', 'release_date'], 'required'],
            [['release_number'], 'integer'],
            [['release_date'], 'safe'],
            [['name', 'author', 'additional_info'], 'string', 'max' => 255],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'name' => 'Name',
            'author' => 'Author',
            'release_number' => 'Release Number',
            'release_date' => 'Release Date',
            'additional_info' => 'Additional Info',
        ];
    }

    /**
     * Gets query for [[InstructionCharacteristics]].
     *
     * @return \yii\db\ActiveQuery|\common\models\query\InstructionCharacteristicQuery
     */
    public function getInstructionCharacteristics()
    {
        return $this->hasMany(InstructionCharacteristic::className(), ['instruction_id' => 'id']);
    }

    /**
     * {@inheritdoc}
     * @return \common\models\query\InstructionQuery the active query used by this AR class.
     */
    public static function find()
    {
        return new \common\models\query\InstructionQuery(get_called_class());
    }
}
