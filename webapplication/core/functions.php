<?php
const DEBUG = 1;
const ERROR = 1;
const DEBUG_SQL = 1;

/**
 * Diese Funktion erstellt, falls noch nicht vorhanden, eine neue logs.txt Datei und speichert die zu loggende Debugnachrichten in die Datei.
 *
 * @param $message - Nachricht die gespeichert werden soll
 * @param null $class - Klasse aus der die Funktion aufgerufen wird (Optional)
 */
function debug_to_logFile($message, $class = null){
    if (!is_dir(__DIR__.'/../logs')) {
        mkdir (__DIR__.'/../logs', 4777);
    }
    if(DEBUG){
        $class = $class == null ? '' : $class;
        $message = '['.(new DateTime())->format('Y-m-d H:i:s ').$class. ']' . $message. "\n";
        file_put_contents ( __DIR__.'/../logs/logs.txt', $message,FILE_APPEND);
    }
}

/**
 * Diese Funktion erstellt, falls noch nicht vorhanden, eine neue logs.txt Datei und speichert die zu loggende Errornachrichten in die Datei.
 *
 * @param $message - Nachricht die gespeichert werden soll
 * @param null $class - Klasse aus der die Funktion aufgerufen wird (Optional)
 */
function error_to_logFile($message, $class = null){
    if (!is_dir(__DIR__.'/../logs')) {
        mkdir (__DIR__.'/../logs', 4777);
    }
    if(ERROR){
        $class = $class == null ? '' : $class;
        $message = '['.(new DateTime())->format('Y-m-d H:i:s ').$class. ']' . $message. "\n";
        file_put_contents ( __DIR__.'/../logs/logs.txt', $message,FILE_APPEND);
    }
}

/**
 * Diese Funktion erstellt, falls noch nicht vorhanden, eine neue logs.txt Datei und speichert die zu loggende Errornachrichten in die Datei.
 *
 * @param $message - Nachricht die gespeichert werden soll
 * @param null $class - Klasse aus der die Funktion aufgerufen wird (Optional)
 */
function error_to_phpunit_output($message){
    if(ERROR){
        fwrite(STDERR, print_r($message, TRUE));
    }
}

/**
 * Leitet den Nutzer zu der gegebenen Seite um ahand des Controllernames und des Seitennamens
 *
 * @param $controller - Abkürzung Name des Controllers
 * @param $action - Abkärzung Name der Action/Seite
 */
function sendHeaderByControllerAndAction($controller, $action) {
    header('Location: ?c=' .$controller . '&a=' . $action);
}

/**
 * Erstellt aus einem Verzeichnis einen Array mit den Datein als Inhalt
 * Z.B. für die Error Gifs
 *
 * @param $dir - Verzeichnispfad
 * @param $numberOfOutputFiles - Anzahl an Elementen die im Array gespeichert werden
 * @return array|mixed
 */
function crateDataOfFilesFromDirectory($dir, $numberOfOutputFiles) {
    //create a grid with random pictures from a directory on the server
    $allFiles = scandir($dir);

    // delete the array indexes with '.' and '..'
    foreach ($allFiles as $delete => &$val) {
        if($val == "." or $val == '..'){
            unset($allFiles[$delete]);
        }
    }

    // random order of the array
    shuffle($allFiles);

    if(count($allFiles) < $numberOfOutputFiles){
        $numberOfOutputFiles = count($allFiles);
    }

    // pics 12 random indexes from the Array
    $rand_keys = array_rand($allFiles, $numberOfOutputFiles);

    if($numberOfOutputFiles > 1){
        foreach ($rand_keys as $datei) {
            $randArray[] = $allFiles[$datei];
        }
    }else{
        $randArray = $allFiles[$rand_keys];
    }

    return $randArray;
}