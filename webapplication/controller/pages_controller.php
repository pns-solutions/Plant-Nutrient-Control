<?php

namespace PNS;

class PagesController extends Controller{

    /**
     * Dies ist die Abfolge, wenn die Startseite abgerufen wird.
     * Sie befüllt die Variablen und Felder im Frontend
     *
     * @return void
     */
    public function actionStart() {
        $this->_params['title'] = 'Startseite';
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
            error_to_logFile(json_encode($_POST, 128));
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