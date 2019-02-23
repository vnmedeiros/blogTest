<?php
try {
    $dbh = new pdo( 'mysql:host=db;port=3306;dbname=myDb', 'user', 'test',
                    array(PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION));
    die(json_encode(array('outcome' => true)));
}
catch(PDOException $ex){
    print $ex;
    die(json_encode(array('outcome' => false, 'message' => 'Unable to connect', 'Exception'=> $ex)));
}
?>
