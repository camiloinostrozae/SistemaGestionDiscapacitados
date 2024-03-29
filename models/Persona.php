<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "persona".
 *
 * @property int $id_persona
 * @property string $nombre
 * @property string $apellido
 * @property string $rut
 * @property string $fecha_nacimiento
 * @property string $email
 * @property string $telefono
 * @property string $sexo
 * @property string $contrasena
 * @property string $auth_key
 * @property int $comuna_id_comuna
 * @property int $rol_id_rol
 *
 * @property InteractuarCampana[] $interactuarCampanas
 * @property Campana[] $campanaIdCampanas
 * @property InteractuarTramite[] $interactuarTramites
 * @property Tramite[] $tramiteIdTramites
 * @property Llamada[] $llamadas
 * @property Comuna $comunaIdComuna
 * @property Rol $rolIdRol
 */
class Persona extends \yii\db\ActiveRecord implements \yii\web\IdentityInterface
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'persona';
    }

    public $region_id;

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['nombre', 'apellido', 'fecha_nacimiento', 'email', 'rut' ,'telefono', 'sexo', 'contrasena', 'auth_key', 'comuna_id_comuna', 'rol_id_rol'], 'required'],
            [['rut'],'unique','message'=>'Ya existe una persona registrada con ese Rut'],
            [['email'],'unique','message'=>'Ya existe una persona con ese email'],
            [['fecha_nacimiento'], 'safe'],
            [['comuna_id_comuna', 'rol_id_rol'], 'integer'],
            [['nombre', 'contrasena'], 'string', 'max' => 45],
            [['apellido', 'email'], 'string', 'max' => 100],
            [['telefono'], 'string', 'max' => 20],
            [['telefono'], 'validarTel'],
            [['telefono'], 'validarTel2'],
            [['telefono'], 'unique','message'=>'Ya existe una persona registrada con ese Teléfono'],
            [['rut'], 'validateRut'],
            [['sexo'], 'string', 'max' => 10],
            [['email'], 'email','message'=>'Email con Formato no Válido'],
            [['auth_key'], 'string', 'max' => 32],
            [['comuna_id_comuna'], 'exist', 'skipOnError' => true, 'targetClass' => Comuna::className(), 'targetAttribute' => ['comuna_id_comuna' => 'id_comuna']],
            [['rol_id_rol'], 'exist', 'skipOnError' => true, 'targetClass' => Rol::className(), 'targetAttribute' => ['rol_id_rol' => 'id_rol']],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id_persona' => 'Id Persona',
            'nombre' => 'Nombre',
            'apellido' => 'Apellido Paterno',
            'rut' => 'Rut',
            'fecha_nacimiento' => 'Fecha Nacimiento',
            'email' => 'Email',
            'telefono' => 'Teléfono',
            'sexo' => 'Sexo',
            'contrasena' => 'Contraseña',
            'auth_key' => 'Auth Key',
            'comuna_id_comuna' => 'Comuna',
            'rol_id_rol' => 'Tipo Administrador',
            'region_id' => 'Región'
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getInteractuarCampanas()
    {
        return $this->hasMany(InteractuarCampana::className(), ['persona_id_persona' => 'id_persona']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getCampanaIdCampanas()
    {
        return $this->hasMany(Campana::className(), ['id_campana' => 'campana_id_campana'])->viaTable('interactuar_campana', ['persona_id_persona' => 'id_persona']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getInteractuarTramites()
    {
        return $this->hasMany(InteractuarTramite::className(), ['persona_id_persona' => 'id_persona']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getTramiteIdTramites()
    {
        return $this->hasMany(Tramite::className(), ['id_tramite' => 'tramite_id_tramite'])->viaTable('interactuar_tramite', ['persona_id_persona' => 'id_persona']);
    }
    
      public function getNombreRegion()
    {
        return $this->hasOne(Region::className(), ['id_region' => 'region_id_region'])->viaTable('comuna', ['id_comuna' => 'comuna_id_comuna']);
    }


    /**
     * @return \yii\db\ActiveQuery
     */
    public function getLlamadas()
    {
        return $this->hasMany(Llamada::className(), ['persona_id_persona' => 'id_persona']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getComunaIdComuna()
    {
        return $this->hasOne(Comuna::className(), ['id_comuna' => 'comuna_id_comuna']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getRolIdRol()
    {
        return $this->hasOne(Rol::className(), ['id_rol' => 'rol_id_rol']);
    }


    public function getAuthKey(){
        return $this->auth_key;
    }

    public function getId(){
        return $this->id_persona;
    }

    public function getRol(){
        return $this->id_rol;
    }

    public function validateAuthKey($authKey){
        return $this->auth_key === $authKey;
    }

    public static function findIdentity($id){
        return self::findOne($id);
    }

    public static function findIdentityByAccessToken($token,$type=null){
        throw new \yii\base\NotSupportedException();
    }

    //Función para buscar el usuario por email, servirá para el login Solo en el Sistema Web
    public static function findByEmail($email){
       return self::findOne(['email'=>$email]);
        
    }
    
    public static function findByCorreo($email){
        if(self::findOne(['email'=>$email])){
            return true;
        }else{
            return false;
        }
    }

    //Función para buscar el usuario por telefono, servirá para el login
    public static function findByTelefono($telefono){
        $celular = self::findOne(['telefono'=>$telefono]);
        if($celular){
            return true;
        }else{
            return false;
        }
    }
    
    //Verifica si el rut se encuentra en la BD
    public function isValidRut($rut){
        $run = self::findOne(['rut'=>$rut]);
        if($run){
            return true;
        }else{
            return false;
        }
    }
    //Formatea el rut ingresado al formato XXXXXXXX-X
    public function formatearRut($rut){


        $rut_formateado = str_replace(".","",$rut);
        return $rut_formateado;


    }

    //Función para validar la contraseña
    public function validatePassword($contrasena){
        return $this->contrasena === $contrasena;
    }

    public  function generateAuthKey()
    {
        return $this->auth_key = Yii::$app->security->generateRandomString();
    }

    //Seleccionar el ID del usuario en base a su authkey
    public static function getUserId($auth_key){
        return self::findOne(['auth_key'=>$auth_key]);
    }


    //Función para formatear la fecha ingresada en el form y se inserte en el formato correcto

    public function beforeSave($insert){
        //Se formatea al formato que guarda MYSQL
        $time = date("Y-m-d", strtotime($this->fecha_nacimiento));
        if ($time) {
            $this->fecha_nacimiento = $time;
            return parent::beforeSave($insert);
        }
        else {
            return false;
        }

    }



    //Función para validar el rut de persona
    public function validateRut($attribute,$params){
        $rut=$this->rut;
        if(strpos($rut,"-")===false){
            $this->addError($attribute, 'El RUT ingresado no es válido, Ingrese formato XXXXXXXX-Y');
        }else{
            if(strpos($rut,".")!=false){
                $this->addError($attribute, 'El RUT ingresado no es válido, Ingrese formato XXXXXXXX-Y');
            }else{
                $data = explode('-', $rut);
                if(is_numeric($data[0])){
                    $evaluate = strrev($data[0]);
                    $multiply = 2;
                    $store = 0;
                    for ($i = 0; $i < strlen($evaluate); $i++) {
                        $store += $evaluate[$i] * $multiply;
                        $multiply++;
                        if ($multiply > 7)
                            $multiply = 2;
                    }
                    isset($data[1]) ? $verifyCode = strtolower($data[1]) : $verifyCode = '';
                    $result = 11 - ($store % 11);
                    if ($result == 10)
                        $result = 'k';
                    if ($result == 11)
                        $result = 0;
                    if ($verifyCode != $result)
                        $this->addError('rut', 'El RUT ingresado no es válido');
                }else{
                    $this->addError($attribute, 'El RUT ingresado no es válido');  
                }
            }}
    }

    public function validarTel($attribute,$params){

        $telefono=$this->telefono;
        if(strlen($telefono)<8){
            $this->addError($attribute, 'Ingrese un teléfono de 8 dígitos');
        }
    }

    public function validarTel2($attribute,$params){
        $telefono=$this->telefono;
        if(ctype_digit($telefono)==false){//ve si telefono se compone de puros digitos
            $this->addError($attribute, 'Teléfono con formato inválido');
        }

    }


}
