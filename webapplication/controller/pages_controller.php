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
    public function actionCultureManagement() {
        $this->_params['title'] = 'Pflanzenmanagement';

        $this->_params['plants'] = Culture::find();
    }

    /**
     * Dies ist die Abfolge, wenn die PlantManagement abgerufen wird.
     * Sie befüllt die Variablen und Felder im Frontend
     *
     * @return void
     */
    public function actionAddCulture() {
        $this->_params['title'] = 'Pflanze anlegen';
        if(isset($_GET['plantId'])) {
            $this->_params['plant'] = Culture::find(['_id' => $_GET['plantId']])[0];
//            var_dump($this->_params['plant']);
        }

        if(isset($_POST['submitAddPlant'])) {
            $params = [
                'ID'            => (isset($_GET['plantId'])) ? base64_decode(urldecode($_GET['plantId'])) : null,
                'NAME'          => ($_POST['plantName']    === '') ? null : $_POST['plantName'],
                'GROWTHSTAGES'  => ($_POST['growthStages']     === '') ? null : $_POST['growthStages']
            ];

            $newPlant = new CUlture($params);

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