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
        $this->_params['grafanaIp'] ="http://{$GLOBALS['server']}:3030";
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

        if(isset($_GET['plantId'])) {
            Culture::deleteWhere($_GET['plantId']);
            sleep(1);
            sendHeaderByControllerAndAction('pages', 'cultureManagement');
        }
    }

    /**
     * Dies ist die Abfolge, wenn die PlantManagement abgerufen wird.
     * Sie befüllt die Variablen und Felder im Frontend
     *
     * @return void
     */
    public function actionAddCulture() {
        $this->_params['title'] = 'Pflanze anlegen';
        $time = new \DateTime('now');
        if(isset($_GET['plantId'])) {
            $cultur = Culture::find(['_id' => $_GET['plantId']])[0];
            $this->_params['plant'] = $cultur;

            if(isset($_POST['submitAddPlant'])) {
                $growthStages = getGrowthStages($_POST);

                $params = [ // start culture
                    'plantId'       => null,
                    'name'          => $_POST['plantName'] ?? '',
                    'growthStages'  => $growthStages, // end stage array
                    'createdAt'     => $cultur['createdAt'],
                    'updatedAt'     => $time->format('Y-m-d H:i:s')
                ]; // end culture

                $newCulture = new Culture($params);

                $error = $newCulture->save();

                if(empty($error)) {
                    Culture::deleteWhere($_GET['plantId']);
                    sleep(2);
                    sendHeaderByControllerAndAction('pages', 'addCulture&plantId=' . $GLOBALS['lastInsertedId']);
                } else {
                    $this->_params['inputError'] = $error;
                }
            }
        }

        if(isset($_POST['submitAddPlantNewCulture'], $_POST['plantName'])) {
            $params = [ // start culture
                'plantId'       => null,
                'name'          => $_POST['plantName'],
                'growthStages'  => [], // end stage array
                'createdAt'     => $time->format('Y-m-d H:i:s'),
                'updatedAt'     => $time->format('Y-m-d H:i:s')
            ]; // end culture

            $newCulture = new Culture($params);
            $error = $newCulture->save();
            sleep(1);

            if(empty($error)) {
                sendHeaderByControllerAndAction('pages', 'addCulture&plantId=' . $GLOBALS['lastInsertedId']);
            } else {
                $this->_params['inputError'] = $error;
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
        $this->_params['fertilizers'] = Fertilizer::find();

        if(isset($_GET['fertilizerId'])) {
            Fertilizer::deleteWhere($_GET['fertilizerId']);
            sleep(1);
            sendHeaderByControllerAndAction('pages','fertilizerManagement');
        }
    }

    /**
     * Dies ist die Abfolge, wenn die FertilizerManagement abgerufen wird.
     * Sie befüllt die Variablen und Felder im Frontend
     *
     * @return void
     */
    public function actionAddFertilizer() {
        $this->_params['title'] = 'Dünger anlegen';
        $time = new \DateTime('now');
        if(isset($_GET['fertilizerId'])) {
            $fertilizer = Fertilizer::find(['_id' => $_GET['fertilizerId']])[0];
            $this->_params['fertilizer'] = $fertilizer;

            if(isset($_POST['submitAddFertilizer'])) {
                $nutrientArray = getNutrientArray($_POST);

                $params = [ // start fertilizer
                    'fertilizerId'  => null,
                    'name'          => $_POST['fertilizerName'] ?? '',
                    'nutrientArray' => $nutrientArray, // end stage array
                    'tabledId'      => 1,             // normally add  tableId
                    'createdAt'     => $fertilizer['createdAt'],
                    'updatedAt'     => $time->format('Y-m-d H:i:s')
                ]; // end fertilizer

                $newFertilizer = new Fertilizer($params);

                $error = $newFertilizer->save();

                if(empty($error)) {
                    Fertilizer::deleteWhere($_GET['fertilizerId']);
                    sleep(2);
                    sendHeaderByControllerAndAction('pages', 'addFertilizer&fertilizerId=' . $GLOBALS['lastInsertedId']);
                } else {
                    $this->_params['inputError'] = $error;
                }
            }
        }

        if(isset($_POST['submitAddNewFertilizer'], $_POST['fertilizerName'])) {
            $params = [ // start fertilizer
                'fertilizerId'  => null,
                'name'          => $_POST['fertilizerName'],
                'nutrientArray' => [], // end nutrient array
                'tabledId'      => 1,  // normally add tableId
                'createdAt'     => $time->format('Y-m-d H:i:s'),
                'updatedAt'     => $time->format('Y-m-d H:i:s')
            ]; // end fertilizer

            $newFertilizer = new Fertilizer($params);
            $error = $newFertilizer->save();
            sleep(1);

            if(empty($error)) {
                sendHeaderByControllerAndAction('pages', 'addFertilizer&fertilizerId=' . $GLOBALS['lastInsertedId']);
            } else {
                $this->_params['inputError'] = $error;
            }
        }
    }

    /**
     * Dies ist die Abfolge, wenn der Solver abgerufen wird.
     *
     *
     * @return void
     */
    public function actionSolver() {
        $this->_params['title'] = 'Solver';
        if(isset($_GET['newResult'])) {
            $this->_params['solverResult'] = SolverResult::solveNutrientSolution();
        }
    }
}