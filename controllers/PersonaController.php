<?php

namespace app\controllers;

use Yii;
use app\models\Persona;
use app\models\PersonaSearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;

/**
 * PersonaController implements the CRUD actions for Persona model.
 */
class PersonaController extends Controller
{
    /**
     * @inheritdoc
     */
    public function behaviors()
    {
        return [
            'verbs' => [
                'class' => VerbFilter::className(),
                'actions' => [
                    'delete' => ['POST'],
                ],
            ],
            
             /** Para los permisos  se hace lo siguiente*/ 
            'access' => [
               'class' => \yii\filters\AccessControl::className(),
               'only' => ['index','update','delete','view','administrador','discapacitado','listardiscapacitados','listarnodiscapacitados','listaradministradores'],
               //Para los ussuario autenticados como super Admin
               'rules' => [
                   [
                     'allow' =>true,
                     'actions' =>['index','view','update','delete','administrador','discapacitado','listardiscapacitados','listarnodiscapacitados','listaradministradores'],
                     'roles' =>['@'],
                      'matchCallback' => function ($rule,$action){
                                                return \app\models\User::isAdmin(Yii::$app->user->identity->id);
                                         }
                   ],
                
            
               ],
            
             ],
            
        ];
    }

    /**
     * Lists all Persona models.
     * @return mixed
     */
    public function actionIndex()
    {
        $searchModel = new PersonaSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single Persona model.
     * @param integer $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionView($id)
    {
        return $this->renderAjax('view', [
            'model' => $this->findModel($id),
        ]);
    }

    /**
     * Creates a new Persona model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    /**
     * Updates an existing Persona model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionUpdate($id)
    {
        $model = $this->findModel($id);

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            Yii::$app->getSession()->setFlash('info', [

                'message' => 'Actualización Exitosa',
            ]);
            if($model->rol_id_rol ==1 ||$model->rol_id_rol ==2){
            return $this->redirect(['listaradministradores', 'id' => $model->id_persona]);
            }else{
                if($model->rol_id_rol ==4){
                return $this->redirect(['listardiscapacitados', 'id' => $model->id_persona]);
                }else{
                    return $this->redirect(['listarnodiscapacitados', 'id' => $model->id_persona]);
                }
            }
        }else{
            if($model->rol_id_rol ==1 ||$model->rol_id_rol ==2 ){
        
            return $this->render('updateAdmin', [
            'model' => $model,
        ]);
            }else{
                if($model->rol_id_rol ==4 ){
                return $this->render('updateDisc', [
                'model' => $model,
        ]);
                }else{
                    return $this->render('updateNodisc', [
                    'model' => $model,
        ]);
                }
            }
    }
    }
    
    /**
     * Deletes an existing Persona model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param integer $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionDelete($id){
        
        $model = $this->findModel($id);

        Yii::$app->getSession()->setFlash('error', [

            'message' => 'Eliminación Exitosa',
        ]);
        $this->findModel($id)->delete();
        if($model->rol_id_rol ==1 ||$model->rol_id_rol ==2 ){
        return $this->redirect(['listaradministradores']);
        }else{
            if($model->rol_id_rol ==4){
            return $this->redirect(['listardiscapacitados']);
            }else{
            return $this->redirect(['listarnodiscapacitados']);
        }   
        }
    }
    

    /**
     * Finds the Persona model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return Persona the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = Persona::findOne($id)) !== null) {
            return $model;
        }

        throw new NotFoundHttpException('The requested page does not exist.');
    }
    
    
    
    //Acción create para administrador
    public function actionAdministrador(){
          $model = new Persona();
           $model->generateAuthKey();
           $model->contrasena=substr(md5(microtime()), 1, 8);//genera contraseña aleatoria de 12 caracteres
            $email = Yii::$app->request->post('Persona') ['email']; 
            Yii::$app->mailer->compose()
                ->setFrom(Yii::$app->params['adminEmail'])
                ->setTo($email)
                ->setSubject('Envío de Contraseña')
                ->setTextBody('Su contraseña de acceso al sistema Web es: '.$model->contrasena)
                ->send();
        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            Yii::$app->getSession()->setFlash('success', [

                'message' => 'Administrador ingresado exitosamente',
            ]);
            return $this->redirect(['listaradministradores', 'id' => $model->id_persona]);
        }

        return $this->render('createadmin', [
            'model' => $model,
        ]);
    }
    
    //Acción create para personas discapacitadas
    public function actionDiscapacitado(){
          $model = new Persona();
           $model->generateAuthKey();
            $model->rol_id_rol=4;
            $model->contrasena=substr(md5(microtime()), 1, 8);
            $email = Yii::$app->request->post('Persona') ['email']; 
         Yii::$app->mailer->compose()
                ->setFrom(Yii::$app->params['adminEmail'])
                ->setTo($email)
                ->setSubject('Envío de Contraseña')
                ->setTextBody('Su contraseña de acceso a la aplicación móvil es: '.$model->contrasena)
                ->send();
               
        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            Yii::$app->getSession()->setFlash('success', [

                'message' => 'Usuario ingresado exitosamente',
            ]);
            return $this->redirect(['listardiscapacitados', 'id' => $model->id_persona]);
        }

        return $this->render('createDisc', [
            'model' => $model,
        ]);
    }
    
    //Accion listar para usuario no discapacitado
    public function actionListarnodiscapacitados(){
        $searchModel = new PersonaSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);
        $dataProvider->query->andWhere('persona.rol_id_rol = 3'); //usuario no discapacitado = rol 3
        $dataProvider->query->orderBy(['id_persona'=>SORT_DESC])->all();
        return $this->render('listarnodisc', [

            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);

    }
    
    //Accion listar para discapacitados
    public function actionListardiscapacitados(){
        $searchModel = new PersonaSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);
        $dataProvider->query->andWhere('persona.rol_id_rol = 4'); //usuario discapacitado = rol 4
        $dataProvider->query->orderBy(['id_persona'=>SORT_DESC])->all();
        return $this->render('listardisc', [

            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);

    }
    
     //Accion listar para administradores
    public function actionListaradministradores(){
        $searchModel = new PersonaSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);
        $dataProvider->query->andWhere('persona.rol_id_rol = 1 or persona.rol_id_rol = 2'); 
        $dataProvider->query->orderBy(['id_persona'=>SORT_DESC])->all();
        return $this->render('listarAdmin', [

            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);

    }
    
   
}
