<?php

namespace backend\models;

use Yii;

/**
 * This is the model class for table "surat_out".
 *
 * @property int $id
 * @property int $no
 * @property string $date
 * @property string $sbj
 * @property string $obj
 * @property string $pj
 * @property string $file
 */
class SuratKeluar extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public $doc;

    public static function tableName()
    {
        return 'surat_out';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['no', 'date', 'sbj', 'obj', 'pj', 'file'], 'required'],
            [['no'], 'integer'],
            [['sbj'], 'string'],
            [['date'], 'string', 'max' => 10],
            [['obj', 'file'], 'string', 'max' => 255],
            [['pj'], 'string', 'max' => 50],
            [['no'], 'unique'],
            ['no', 'trim'],
            [['doc'], 'file', 'skipOnEmpty' => !$this->isNewRecord, 'extensions' => 'pdf']
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'no' => 'Nomor Surat',
            'date' => 'Tanggal Surat',
            'sbj' => 'Perihal Surat',
            'obj' => 'Tujuan Surat',
            'pj' => 'PJ/Penerima Surat',
            'file' => 'Dokumen',
            'doc' => 'Dokumen'
        ];
    }
}
