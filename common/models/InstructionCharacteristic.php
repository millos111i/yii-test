<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "instructionCharacteristic".
 *
 * @property int $id
 * @property string|null $name
 * @property float|null $norm_value
 * @property float|null $add_tolerance
 * @property float|null $sub_tolerance
 * @property string|null $measure_unit
 * @property int|null $number_of_repetition
 * @property int $instruction_id
 *
 * @property Instruction $instruction
 */
class InstructionCharacteristic extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'instructionCharacteristic';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['norm_value', 'add_tolerance', 'sub_tolerance'], 'number'],
            [['number_of_repetition', 'instruction_id'], 'integer'],
            [['instruction_id'], 'required'],
            [['name', 'measure_unit'], 'string', 'max' => 255],            
            ['measure_unit', 'in', 'range' => MeasureUnits::getArray()],
            [['instruction_id'], 'exist', 'skipOnError' => true, 'targetClass' => Instruction::className(), 'targetAttribute' => ['instruction_id' => 'id']],
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
            'norm_value' => 'Norm Value',
            'add_tolerance' => 'Add Tolerance',
            'sub_tolerance' => 'Sub Tolerance',
            'measure_unit' => 'Measure Unit',
            'number_of_repetition' => 'Number Of Repetition',
            'instruction_id' => 'Instruction ID',
        ];
    }

    /**
     * Gets query for [[Instruction]].
     *
     * @return \yii\db\ActiveQuery|\common\models\query\InstructionQuery
     */
    public function getInstruction()
    {
        return $this->hasOne(Instruction::className(), ['id' => 'instruction_id']);
    }

    /**
     * {@inheritdoc}
     * @return \common\models\query\InstructionCharacteristicQuery the active query used by this AR class.
     */
    public static function find()
    {
        return new \common\models\query\InstructionCharacteristicQuery(get_called_class());
    }
}
