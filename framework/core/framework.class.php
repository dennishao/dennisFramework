<?php

class framework
{
    public static function run()
    {
        self::init();
        self::autoload();
        self::dispatch();
    }

    private static function init()
    {
        //定义常量
        define("ROOT", dirname(dirname(dirname(__FILE__))));

        define("APP_PATH", ROOT . "/applications");
        define("FRAMEWORK_PATH", ROOT . "/framework");
        define("PUBLIC_PATH", ROOT . "/public");

        define("CONFIG_PATH", APP_PATH . "/config");
        define("CONTROLLERS_PATH", APP_PATH . "/controllers");
        define("MODELS_PATH", APP_PATH . "/models");
        define("VIEWS_PATH", APP_PATH . "/views");

        define("CORE_PATH", FRAMEWORK_PATH . "/core");
        define("DATABASE_PATH", FRAMEWORK_PATH . "/database");
        define("HELPERS_PATH", FRAMEWORK_PATH . "/helpers");
        define("LIBRARIES_PATH", FRAMEWORK_PATH . "/libraries");

        define("CSS_PATH", PUBLIC_PATH . "/css");
        define("JS_PATH", PUBLIC_PATH . "/js");
        define("IMAGES_PATH", PUBLIC_PATH . "/images");
        define("UPLOADS_PATH", PUBLIC_PATH . "/uploads");

        //index.php?c=Index&a=index
        define("CONTROLLER", isset($_REQUEST['c']) ? $_REQUEST['c'] : "Index");
        define("ACTION", isset($_REQUEST['a']) ? $_REQUEST['a'] : "index");


        //包含核心类库
        require_once CORE_PATH . "/Controller.class.php";
        require_once CORE_PATH . "/Loader.class.php";
        require_once DATABASE_PATH . "/Mysql.class.php";
        require_once CORE_PATH . "/Model.class.php";

        require_once CONFIG_PATH . "/config.php";

        //开启session
        session_start();

    }

    protected static function autoload()
    {
        spl_autoload_register(array(__CLASS__, "load"));
    }

    private static function load($className)
    {
        //区别xxxController和xxxModel
        if (substr($className, -10) == "Controller") {
            require_once CONTROLLERS_PATH."/$className.class.php";
        } elseif (substr($className, -5) == "Model") {
            require_once MODELS_PATH."/$className.class.php";
        }
    }

    protected static function dispatch()
    {
        $controller_name = CONTROLLER . "Controller";
        $action_name = ACTION . "Action";
        $controller = new $controller_name;
        $controller->$action_name();
    }
}