<?php

namespace backend\controllers;

use common\models\Instruction;
use common\models\InstructionCharacteristic;
use yii\data\ActiveDataProvider;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use backend\models\Model;
use yii\helpers\ArrayHelper;

/**
 * InstructionController implements the CRUD actions for Instruction model.
 */
class InstructionController extends Controller
{
    /**
     * @inheritDoc
     */
    public function behaviors()
    {
        return array_merge(
            parent::behaviors(),
            [
                'verbs' => [
                    'class' => VerbFilter::className(),
                    'actions' => [
                        'delete' => ['POST'],
                    ],
                ],
            ]
        );
    }

    /**
     * Lists all Instruction models.
     *
     * @return string
     */
    public function actionIndex()
    {
        $dataProvider = new ActiveDataProvider([
            'query' => Instruction::find(),
            /*
            'pagination' => [
                'pageSize' => 50
            ],
            'sort' => [
                'defaultOrder' => [
                    'id' => SORT_DESC,
                ]
            ],
            */
        ]);

        return $this->render('index', [
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single Instruction model.
     * @param int $id ID
     * @return string
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionView($id)
    {
        return $this->render('view', [
            'model' => $this->findModel($id),
        ]);
    }

    /**
     * Creates a new Instruction model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return string|\yii\web\Response
     */
    public function actionCreate()
    {
        $model = new Instruction();
        $modelsCharacteristic = [new InstructionCharacteristic()];

        if ($this->request->isPost) {
            $modelsCharacteristic = Model::createMultiple(InstructionCharacteristic::classname());
            Model::loadMultiple($modelsCharacteristic, $this->request->post());

            if ($model->load($this->request->post()) && $model->save()) {
                foreach ($modelsCharacteristic as $modelCharacteristic) {
                    $modelCharacteristic->instruction_id = $model->id;
                    $modelCharacteristic->save();
                }

                return $this->redirect(['view', 'id' => $model->id]);
            }
        } else {
            $model->loadDefaultValues();
        }
        
        return $this->render('create', [
            'model' => $model,
            'modelsCharacteristic' => (empty($modelsCharacteristic)) ? [new InstructionCharacteristic()] : $modelsCharacteristic
        ]);
    }

    /**
     * Updates an existing Instruction model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param int $id ID
     * @return string|\yii\web\Response
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionUpdate($id)
    {
        
        $model = $this->findModel($id);
        $modelsCharacteristic = $model->instructionCharacteristics;
        
        if ($this->request->isPost && $model->load($this->request->post()) && $model->save()) {
            $oldIDs = ArrayHelper::map($modelsCharacteristic, 'id', 'id');
            $modelsCharacteristic = Model::createMultiple(InstructionCharacteristic::classname(), $modelsCharacteristic);
            Model::loadMultiple($modelsCharacteristic, $this->request->post());
            $deletedIDs = array_diff($oldIDs, array_filter(ArrayHelper::map($modelsCharacteristic, 'id', 'id')));

            if (! empty($deletedIDs)) {
                InstructionCharacteristic::deleteAll(['id' => $deletedIDs]);
            }
            foreach ($modelsCharacteristic as $modelCharacteristic) {
                $modelCharacteristic->instruction_id = $model->id;
                $modelCharacteristic->save();
            }

            return $this->redirect(['view', 'id' => $model->id]);
        }
        
        return $this->render('update', [
            'model' => $model,
            'modelsCharacteristic' => $modelsCharacteristic
        ]);
    }

    /**
     * Deletes an existing Instruction model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param int $id ID
     * @return \yii\web\Response
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionDelete($id)
    {
        $this->findModel($id)->delete();

        return $this->redirect(['index']);
    }

    /**
     * Finds the Instruction model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param int $id ID
     * @return Instruction the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = Instruction::findOne(['id' => $id])) !== null) {
            return $model;
        }

        throw new NotFoundHttpException('The requested page does not exist.');
    }
}
