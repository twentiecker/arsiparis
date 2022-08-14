<?php

namespace backend\controllers;

use Yii;
use backend\models\SuratKeluar;
use backend\models\SuratKeluarSearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use yii\web\UploadedFile;

/**
 * SuratKeluarController implements the CRUD actions for SuratKeluar model.
 */
class SuratKeluarController extends Controller
{
    /**
     * {@inheritdoc}
     */
    public function behaviors()
    {
        return [
            'access' => [
                'class' => \yii\filters\AccessControl::className(),
                'only' => ['index', 'create', 'update'],
                'rules' => [
                    // allow all POST requests
                    [
                        'allow' => true,
                        'verbs' => ['POST']
                    ],
                    // allow authenticated users
                    [
                        'allow' => true,
                        'roles' => ['@'],
                    ],
                ],
            ],
            'verbs' => [
                'class' => VerbFilter::className(),
                'actions' => [
                    'delete' => ['POST'],
                ],
            ],
        ];
    }

    /**
     * Lists all SuratKeluar models.
     * @return mixed
     */
    public function actionIndex()
    {
        $searchModel = new SuratKeluarSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single SuratKeluar model.
     * @param integer $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionView($id)
    {
        return $this->render('view', [
            'model' => $this->findModel($id),
        ]);
    }

    /**
     * Creates a new SuratKeluar model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        $model = new SuratKeluar();
        if (Yii::$app->user->identity->name != 'superadmin') {
            $model->pj = Yii::$app->user->identity->name; 
        }

        if (Yii::$app->request->isAjax && $model->load($_POST))
        {
            Yii::$app->response->format = 'json';
            return \yii\widgets\ActiveForm::validate($model);
        }

        if ($model->load(Yii::$app->request->post())) {
            
            $convertSbj = preg_replace('/[^a-zA-Z0-9\-]/', '_', $model->sbj);

            $docName = substr($model->date, 6, 4).substr($model->date, 3, 2).substr($model->date, 0, 2).' B-'.$model->no.' '.$convertSbj;
            $model->doc = UploadedFile::getInstance($model, 'doc');
            

            $model->file = 'uploads/'.$docName.'.'.$model->doc->extension;

            $model->save();
            $model->doc->saveAs('uploads/'.$docName.'.'.$model->doc->extension);

            return $this->redirect(['view', 'id' => $model->id]);
        }

        return $this->render('create', [
            'model' => $model,
        ]);
    }

    /**
     * Updates an existing SuratKeluar model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionUpdate($id)
    {
        $model = $this->findModel($id);

        $tmpNo = $model->no;
        $tmpDate = $model->date;
        $tmpSbj = $model->sbj;
        $tmpFile = $model->file;

        if (Yii::$app->request->isAjax && $model->load($_POST))
        {
            Yii::$app->response->format = 'json';
            return \yii\widgets\ActiveForm::validate($model);
        }

        if ($model->load(Yii::$app->request->post())) {

            $convertSbj = preg_replace('/[^a-zA-Z0-9\-]/', '_', $model->sbj);            

            $docName = substr($model->date, 6, 4).substr($model->date, 3, 2).substr($model->date, 0, 2).' B-'.$model->no.' '.$convertSbj;
            $model->doc = UploadedFile::getInstance($model, 'doc');
            
            if (!empty($model->doc)) {
                
                $model->file = 'uploads/'.$docName.'.'.$model->doc->extension;
                $model->save();
                $model->doc->saveAs('uploads/'.$docName.'.'.$model->doc->extension);
            }
            
            if ($tmpNo != $model->no || $tmpDate != $model->date || $tmpSbj != $model->sbj){
                if(empty($model->doc)) {
                    rename($model->file, 'uploads/'.$docName.'.pdf');
                    $model->file = 'uploads/'.$docName.'.pdf';
                    $model->save();
                } else {
                    unlink($tmpFile);                    
                }           
            }

            

            return $this->redirect(['view', 'id' => $model->id]);
        }

        return $this->render('update', [
            'model' => $model,
        ]);
    }

    /**
     * Deletes an existing SuratKeluar model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param integer $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionDelete($id)
    {
        $data = SuratKeluar::findOne($id);
        unlink($data->file);
        $data->delete();

        return $this->redirect(['index']);
    }

    /**
     * Finds the SuratKeluar model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return SuratKeluar the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = SuratKeluar::findOne($id)) !== null) {
            return $model;
        }

        throw new NotFoundHttpException('The requested page does not exist.');
    }
}
