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

function getGrowthStages($arrayWithData): array {
    $stages = [];
    $newGrowthStage = [];
    $allData = $arrayWithData;
    unset($allData['plantName']);
    unset($allData['submitAddPlant']);

    //complete new growth stage
    if($allData['newGrowthStageName'] != '' && $allData['newNutrient'] != '' && $allData['newAmount']!= '') {
        $newGrowthStage = [
            'growthStageId' => 0,
            'name' => $allData['newGrowthStageName'],
            'nutrientArray' =>  [// start nutrient
                [
                    'nutrientId' => NUTRIENTS_NAME_TO_ID[$allData['newNutrient']],
                    'name' => $allData['newNutrient'],
                    'element' => NUTRIENTS_NAME_TO_ELEMENT[$allData['newNutrient']],
                    'amount' => $allData['newAmount']
                ]
            ],
            'defaultDuration' => 2
        ];
    }

    unset($allData['newGrowthStageName']);
    unset($allData['newNutrient']);
    unset($allData['newValue']);

    $noMoreStages = false;
    $index = 1;

    while(!$noMoreStages) {
        $stageName = "stage{$index}_newName";

        if(isset($allData[$stageName])) {
            $growthStagesInfos = getAllFromGrowthStage($allData, "stage$index", $index);
            $stages[] = $growthStagesInfos;
        } else {
            $noMoreStages = true;
        }
        $index++;
    }

    if(!empty($newGrowthStage)) {
        $stages[] = $newGrowthStage;
    }

    error_to_logFile(json_encode($stages, 128));

    return $stages;
}

function getAllFromGrowthStage(array $array, string $stageIdentifier, int $index): array {
    $growthStageInfos = [];
    $nutrientInfos = [];

    foreach ($array as $key => $value) {
        if(str_contains($key, $stageIdentifier)) {

            if($key == "{$stageIdentifier}_newName") {
                $growthStageInfos['growthStageId'] = $index;
                $growthStageInfos['name'] = $value;
            } else if($key == "{$stageIdentifier}_newNutrient") {
                if($value != '') {
                    $nutrientInfos[] = [
                        'nutrientId' => NUTRIENTS_NAME_TO_ID[$value],
                        'name' => $value,
                        'element' => NUTRIENTS_NAME_TO_ELEMENT[$value],
                        'amount' => $array["{$stageIdentifier}_newAmount"]
                    ];
                }
            } else if($key == "{$stageIdentifier}_newAmount") {
                continue;
            } else {
                $nutrientName = explode('_', $key)[1];
                $nutrientInfos[] = [
                    'nutrientId' => NUTRIENTS_NAME_TO_ID[$nutrientName],
                    'name' => $nutrientName,
                    'element' => NUTRIENTS_NAME_TO_ELEMENT[$nutrientName],
                    'amount' => $value
                ];
            }
        }
    }

    $growthStageInfos['nutrientArray'] = $nutrientInfos;
    $growthStageInfos['defaultDuration'] = 2;
    return $growthStageInfos;
}

function getNutrientArray($arrayWithData): array {
    $nutrientArray = [];
    $newNutrient = [];
    $allData = $arrayWithData;
    unset($allData['fertilizerName']);
    unset($allData['submitAddFertilizer']);

    //complete new nutrient array
    if($allData['nutrientArray'] != '' && $allData['newNutrient'] != '' && $allData['newAmount']!= '') {
        $newNutrient = [
            'nutrientId' => NUTRIENTS_NAME_TO_ID[$allData['newNutrient']],
            'name' => $allData['newNutrient'],
            'element' => NUTRIENTS_NAME_TO_ELEMENT[$allData['newNutrient']],
            'amount' => $allData['newAmount']
        ];
    }

    unset($allData['newNutrient']);
    unset($allData['newValue']);

    $noMoreStages = false;
    $index = 1;


    while(!$noMoreStages) {
        $nutrientName = "nutrientArray{$index}_newName";

        if(isset($allData[$nutrientName])) {
            $nutrientInfos = getAllFromNutrientArray($allData, "nutrientArray$index", $index);
            $nutrientArray = $nutrientInfos;
        } else {
            $noMoreStages = true;
        }
        $index++;
    }

    if(!empty($newNutrient)) {
        $nutrientArray = $newNutrient;
    }

    error_to_logFile(json_encode($nutrientArray, 128));

    return $nutrientArray;
}

function getAllFromNutrientArray(array $array, string $nutrientId, int $index): array {
    $nutrientInfos = [];

    foreach ($array as $key => $value) {
        if(str_contains($key, $nutrientId)) {

            if($key == "{$nutrientId}_newName") {
            } else if($key == "{$nutrientId}_newNutrient") {
                if($value != '') {
                    $nutrientInfos[] = [
                        'nutrientId' => NUTRIENTS_NAME_TO_ID[$value],
                        'name' => $value,
                        'element' => NUTRIENTS_NAME_TO_ELEMENT[$value],
                        'amount' => $array["{$nutrientId}_newAmount"]
                    ];
                }
            } else if($key == "{$nutrientId}_newAmount") {
                continue;
            } else {
                $nutrientName = explode('_', $key)[1];
                $nutrientInfos[] = [
                    'nutrientId' => NUTRIENTS_NAME_TO_ID[$nutrientName],
                    'name' => $nutrientName,
                    'element' => NUTRIENTS_NAME_TO_ELEMENT[$nutrientName],
                    'amount' => $value
                ];
            }
        }
    }
    return $nutrientInfos;
}