<?php

require_once __DIR__ . "/../vendor/autoload.php";

include __DIR__ . "/controller/Core.php";
include __DIR__ . "/controller/Database.php";
include __DIR__ . "/controller/Executor.php";

// Actualizacion 2026 : Migracion a Twig + FastRoute (LegoBox)
include __DIR__ . "/controller/Req.php";
include __DIR__ . "/controller/Response.php";
include __DIR__ . "/controller/LbModel.php";
include __DIR__ . "/controller/ViewEngine.php";

// 10 octubre 2014
include __DIR__ . "/controller/Model.php";

// 13 octubre 2014
include __DIR__ . "/controller/Request.php";

// Actualizacion 2026, creado 14 octubre 2014
include __DIR__ . "/controller/Session.php";

// Actualizacion creado 2026, creado 26 diciembre 2014
if (file_exists(__DIR__ . "/controller/class.upload.php")) {
    include __DIR__ . "/controller/class.upload.php";
}

include_once __DIR__ . "/app/autoload.php";