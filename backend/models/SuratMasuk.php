<?php

namespace backend\models;

use Yii;

/**
 * This is the model class for table "surat_in".
 *
 * @property int $id
 * @property string $no
 * @property string $date
 * @property string $sbj
 * @property string $origin
 * @property string $pj
 * @property string $file
 */
class SuratMasuk extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public $doc;

    public static function tableName()
    {
        return 'surat_in';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['no', 'date', 'sbj', 'origin', 'pj', 'file'], 'required'],
            [['sbj'], 'string'],
            [['no', 'pj'], 'string', 'max' => 50],
            [['date'], 'string', 'max' => 10],
            [['origin', 'file'], 'string', 'max' => 255],
            [['no'], 'unique'],
            ['no', 'trim'],
            [['doc'], 'file', 'skipOnEmpty' => !$this->isNewRecord]
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
            'origin' => 'Asal Surat',
            'pj' => 'PJ/Penerima Surat',
            'file' => 'Dokumen',
            'doc' => 'Dokumen'
        ];
    }
}
