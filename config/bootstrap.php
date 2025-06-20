<?php
define("PROJECT_ROOT_PATH", __DIR__ . "/../");

// include main configuration file
require_once PROJECT_ROOT_PATH . "/config/db_config.php";

// include the base controller file
require_once PROJECT_ROOT_PATH . "/Controller/BaseController.php";

// include the use model file
require_once PROJECT_ROOT_PATH . "/Model/UserModel.php";