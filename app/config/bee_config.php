<?php

//saber si estamos en servidor local o remoto
define("IS_LOCAL", in_array($_SERVER['REMOTE_ADDR'],['127.0.0.1','::1']));

//definir el uso de horario o el time zone del sistema
date_default_timezone_set('America/Mexico_City');

setlocale(LC_ALL,"es_ES");
setlocale(LC_TIME, "spanish");
//Lenguaje
define('LANG','es');

//Definirla base de nuestro proyecto
define('BASEPATH', IS_LOCAL ? '/proyecto002/' : '___ EL BASEPATH ESTA EN PRODUCCION___');

//Sal de sistema
define("AUTH_SALT",'BeeFramework<3');

//Puerto y la URL del sitio
define('PORT','8848');
// define('URL' , IS_LOCAL ? 'http://127.0.0.1:'.PORT.'/proyecto002/' : '___URL EN PRODUCCION___'); //Ruta absoluta a nivel url
define('URL' , IS_LOCAL ? 'http://localhost/proyecto002/' : '___URL EN PRODUCCION___');

//Ruta de directorios y archivos
define('DS'  , DIRECTORY_SEPARATOR); //redifinimos el separador a una constante mas corta (diagonal invertida)
define('ROOT', getcwd().DS);       //getcwd() nos regresa la ruta. .DS para crear un separador de directorio (proyecto001\)

define('APP'        , ROOT.'app'.DS); //Ruta absoluta (Nivel a disco duro -> donde se encuentra en el server)
define('CLASSES'    , APP.'classes'.DS);
define('CONFIG'     , APP.'config'.DS);
define('CONTROLLERS', APP.'controllers'.DS);
define('FUNCTIONS'  , APP.'functions'.DS);
define('MODELS'     , APP.'models'.DS);

define('TEMPLATES', ROOT.'templates'.DS);
define('INCLUDES' , TEMPLATES.'includes'.DS);
define('MODULES'  , TEMPLATES.'modules'.DS);
define('VIEWS'    , TEMPLATES.'views'.DS);

// URL abasolutas para carga de archivos o assets
define("ASSETS"  , URL.'assets/');
define("CSS"     , ASSETS.'css/');
define("FAVICON" , ASSETS.'favicon/');
define("FONTS"   , ASSETS.'fonts/');
define("IMAGES"  , ASSETS.'images/');
define('JS'      , ASSETS.'js/');
define('PLUGINS', ASSETS.'plugins/');
define('UPLOADS' , ASSETS.'uploads/');

//Constantes para credenciales de base de datos
//Set para conexion local o de desarrollo
define('LDB_ENGINE' , 'mysql');
define('LDB_HOST'   , 'localhost');
define('LDB_NAME'   , 'bee_db');
define('LDB_USER'   , 'root');
define('LDB_PASS'   , '');
define('LDB_CHARSET', 'utf8');

//set para conexion en produccion
define('DB_ENGINE' , 'mysql');
define('DB_HOST '  , 'localhost');
define('DB_NAME'   , '__REMOTE_DB__');
define('DB_USER'   , '__REMOTE_DB__');
define('DB_PASS'   , '__REMOTE_DB__');
define('DB_CHARSET', 'utf8');

// El controlador por defecto / el metodo por defecto / y el controlador de errores por defecto
define('DEFAULT_CONTROLLER','home');
define('DEFAULT_ERROR_CONTROLLER','error');
define('DEFAULT_METHOD','index');

define('MODALS', TEMPLATES.'modal/');