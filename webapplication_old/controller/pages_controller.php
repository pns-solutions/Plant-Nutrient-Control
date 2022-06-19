<?php

namespace PNS;

use Elasticsearch\ClientBuilder;

class PagesController extends Controller{

    /**
     * Dies ist die Abfolge, wenn die Startseite abgerufen wird.
     * Sie befüllt die Variablen und Felder im Frontend
     *
     * @return void
     */
    public function actionStart() {
        $this->_params['title'] = 'Test';

//        header('Content-Type: application/json; charset=utf-8');;
//
//        $client = ClientBuilder::create()->setHosts(['51.75.64.177'])->build();
//
//        $params = [
//            'index' => 'test_table'
//        ];
//
//        $result = $client->search($params);

//        $this->_params['test'] = json_encode($result['hits']['hits'][0]['_source']);
    }

    /**
     * Dies ist die Abfolge, wenn die Errorseite abgerufen wird.
     * Sie befüllt die Variablen und Felder im Frontend
     *
     * @return void
     */
    public function actionErrorPage() {
        $this->_params['title'] = 'Startseite';
    }

    /**
     * Dies ist die Abfolge, wenn die PlantManagement abgerufen wird.
     * Sie befüllt die Variablen und Felder im Frontend
     *
     * @return void
     */
    public function actionPlantManagement() {
        $this->_params['title'] = 'Pflanzenmanagement';

        if(isset($_GET['plantId'])) {
            Plant::deleteWhere('ID = ' . base64_decode(urldecode($_GET['plantId'])));
        }

        $this->_params['plants'] = Plant::getPlantsWithNutrition();
    }

    /**
     * Dies ist die Abfolge, wenn die PlantManagement abgerufen wird.
     * Sie befüllt die Variablen und Felder im Frontend
     *
     * @return void
     */
    public function actionAddPlant() {
        $this->_params['title'] = 'Pflanze anlegen';
        if(isset($_GET['plantId'])) {
            $this->_params['plant'] = Plant::getPlantsWithNutritionAsArray('ID = ' . base64_decode(urldecode($_GET['plantId'])));
        }

        if(isset($_POST['submitAddPlant'])) {
            $params = [
                'ID'            => (isset($_GET['plantId'])) ? base64_decode(urldecode($_GET['plantId'])) : null,
                'NAME'          => ($_POST['plantName']    === '') ? null : $_POST['plantName'],
                'GROWTHSTAGES'  => ($_POST['growthStages']     === '') ? null : $_POST['growthStages']
            ];

            $newPlant = new Plant($params);

            $inputError = array();
            if(!$newPlant->validatePlant($newPlant, $inputError)) {
                $this->_params['inputError'] = $inputError;
                $this->_params['oldValues'] = $params;
                return;
            }

            $errors = $newPlant->save();

            if(empty($errors)) {
                $message = 'Pflanze erfolgreich gespeichert!';
                sendHeaderByControllerAndAction('pages', 'addPlant&plantId=' . base64_encode(urlencode($GLOBALS['lastInsertedID'] ?? $params['ID'])) . '&success=true&msg=' . $message);
            } else {
                $message = 'Fehler beim Speichern der Pflanze!';
                sendHeaderByControllerAndAction('pages', 'addPlant&success=false&msg=' . $message);
            }
        }
    }

    /**
     * Dies ist die Abfolge, wenn die FertilizerManagement abgerufen wird.
     * Sie befüllt die Variablen und Felder im Frontend
     *
     * @return void
     */
    public function actionFertilizerManagement() {
        $this->_params['title'] = 'Düngermanagement';
    }

}