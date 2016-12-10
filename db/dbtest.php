<?php

include $_SERVER['DOCUMENT_ROOT']."/private/Config.php";

/**
 * Created by PhpStorm.
 * User: pierre
 * Date: 10/12/2016
 * Time: 14:41
 */

try {
    $db = new PDO('mysql:host='.DB_SERVER.';dbname='.DB_DATABASE.';charset=UTF8', DB_USERNAME, DB_PASSWORD);
    $sql = 'SELECT * FROM message LIMIT 2';
    $statement = $db->prepare($sql);
    if ($statement->execute() ) {
        while ($row = $statement->fetch()) {
            print_r($row);
        }
    }

    // Fermer curseur
    $statement->closeCursor();
    $statement = null;
    // Fermer connection
    $db = null;
} catch (Exception $exception) {
    die('Erreur : '.$exception->getCode());
}


?>

<?php
$indicesServer = array('PHP_SELF',
    'argv',
    'argc',
    'GATEWAY_INTERFACE',
    'SERVER_ADDR',
    'SERVER_NAME',
    'SERVER_SOFTWARE',
    'SERVER_PROTOCOL',
    'REQUEST_METHOD',
    'REQUEST_TIME',
    'REQUEST_TIME_FLOAT',
    'QUERY_STRING',
    'DOCUMENT_ROOT',
    'HTTP_ACCEPT',
    'HTTP_ACCEPT_CHARSET',
    'HTTP_ACCEPT_ENCODING',
    'HTTP_ACCEPT_LANGUAGE',
    'HTTP_CONNECTION',
    'HTTP_HOST',
    'HTTP_REFERER',
    'HTTP_USER_AGENT',
    'HTTPS',
    'REMOTE_ADDR',
    'REMOTE_HOST',
    'REMOTE_PORT',
    'REMOTE_USER',
    'REDIRECT_REMOTE_USER',
    'SCRIPT_FILENAME',
    'SERVER_ADMIN',
    'SERVER_PORT',
    'SERVER_SIGNATURE',
    'PATH_TRANSLATED',
    'SCRIPT_NAME',
    'REQUEST_URI',
    'PHP_AUTH_DIGEST',
    'PHP_AUTH_USER',
    'PHP_AUTH_PW',
    'AUTH_TYPE',
    'PATH_INFO',
    'ORIG_PATH_INFO') ;

echo '<table cellpadding="10">' ;
foreach ($indicesServer as $arg) {
    if (isset($_SERVER[$arg])) {
        echo '<tr><td>'.$arg.'</td><td>' . $_SERVER[$arg] . '</td></tr>' ;
    }
    else {
        echo '<tr><td>'.$arg.'</td><td>-</td></tr>' ;
    }
}
echo '</table>' ;

?>
