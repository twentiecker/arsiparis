<?php

namespace backend\models;

use Yii;

/**
 * This is the model class for table "lembur".
 *
 * @property int $id
 * @property string $name
 * @property string $employee_id
 * @property string $date
 * @property string $task
 */
class Lembur extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'lembur';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['name', 'employee_id', 'date', 'task'], 'required'],
            [['task'], 'string'],
            [['name'], 'string', 'max' => 50],
            [['employee_id'], 'string', 'max' => 9],
            [['date'], 'string', 'max' => 10],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'name' => 'Nama Pegawai',
            'employee_id' => 'NIP',
            'date' => 'Tanggal Lembur',
            'task' => 'Agenda/Kegiatan Lembur',
        ];
    }
}
