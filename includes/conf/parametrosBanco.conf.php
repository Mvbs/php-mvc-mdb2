<?php
    //================================================================
    //Leitura das configuracoes de Banco em um arquivo externo
    //================================================================
    /*$arquivo    = "conf/params_banco.ini";
    $arquivoIni = parse_ini_file($arquivo, true);

    define( _DB_DRIVER_NAME_    , $arquivoIni['banco']['db_driver_name']);
    define( _DB_HOST_NAME_      , $arquivoIni['banco']['db_host_name']);
    define( _DB_USER_NAME_      , $arquivoIni['banco']['db_user_name']);
    define( _DB_PASSWORD_       , $arquivoIni['banco']['db_password_name']);
    define( _DB_DATABASE_NAME_  , $arquivoIni['banco']['db_database_name']);
    define( _DB_PORT_NUMBER_    , $arquivoIni['banco']['db_port_name']);*/

    define( _DB_DRIVER_NAME_    , 'mysql');
    define( _DB_HOST_NAME_      , 'localhost');
    define( _DB_USER_NAME_      , 'root');
    define( _DB_PASSWORD_       , 'posdsw');
    define( _DB_DATABASE_NAME_  , 'abstracao_banco');
    define( _DB_PORT_NUMBER_    , 3306);
?>