<?php

namespace PNS;

class Plant extends BaseModel {

    const TABLENAME = '`PLANTS`';

    protected $schema = [
        'ID'            => ['type' => BaseModel::TYPE_INT],
        'NAME'          => ['type' => BaseModel::TYPE_STRING, 'min' => 2, 'max' => 64],
        'GROWTHSTAGES'  => ['type' => BaseModel::TYPE_INT]
    ];

    /**
     * @param Plant $newPlant
     * @param $inputError
     * @return bool
     */
    public function validatePlant($newPlant, &$inputError) {
        $newPlant->validate($inputError);

        if ($newPlant->__get('NAME') === null) {
            $inputError[] = 'Der Name muss ausgefüllt sein!';
        } else if (!preg_match('/^[a-zA-ZàáâäãåąčćęèéêëėįìíîïłńòóôöõøùúûüųūÿýżźñçšžÀÁÂÄÃÅĄĆČĖĘÈÉÊËÌÍÎÏĮŁŃÒÓÔÖÕØÙÚÛÜŲŪŸÝŻŹÑßÇŒÆŠŽ∂ð ,.\'-][a-zA-ZàáâäãåąčćęèéêëėįìíîïłńòóôöõøùúûüųūÿýżźñçšžÀÁÂÄÃÅĄĆČĖĘÈÉÊËÌÍÎÏĮŁŃÒÓÔÖÕØÙÚÛÜŲŪŸÝŻŹÑßÇŒÆŠŽ∂ð ,.\'-]*$/', $newPlant->__get('NAME'))) {
            $inputError[] = 'Der Name darf nur aus Buchstaben bestehen';
        }

        if ($newPlant->__get('GROWTHSTAGES') === null) {
            $inputError[] = 'Die Wachstumsphasen müssen ausgefüllt sein!';
        } else if (!preg_match('/^[0-9]*$/', $newPlant->__get('GROWTHSTAGES'))) {
            $inputError[] = 'Die Phasen dürfen nur aus Zahlen bestehen';
        }

        if(empty($inputError)) {
            return true;
        } else {
            return false;
        }
    }

    /**
     * Returns plants with nutrition
     *
     * @param string $where
     * @return array
     */
    public static function getPlantsWithNutrition(string $where = ''){
        $plants = Plant::find($where);
        $fertilizers = Fertilizer::find();

        foreach ($plants as &$plant) {
            // Plant ID with nutrition ID with plant ID
           $nutritionPlantTable = BaseModel::find('PLANTID = "' . $plant['ID'] . '"', 'PLANTNUTRITION');
            $plant['NUTRITIONINFO'] = '';
           foreach ($nutritionPlantTable as $entry) {
               foreach ($fertilizers as $fertilizer) {
                    if($fertilizer['ID'] == $entry['FERTILIZERID']) {
                        $plant['NUTRITIONINFO'] .= $fertilizer['NAME'] . "<br>";
                    }
               }
           }
        }

        return $plants;
    }

    /**
     * Returns plants with nutrition
     *
     * @param string $where
     * @return array
     */
    public static function getPlantsWithNutritionAsArray(string $where = ''){
        $plant = Plant::findOne($where);
        $fertilizers = Fertilizer::find();

        // Plant ID with nutrition ID with plant ID
        $nutritionPlantTable = BaseModel::find('PLANTID = "' . $plant['ID'] . '"', 'PLANTNUTRITION');
        foreach ($nutritionPlantTable as $entry) {
            foreach ($fertilizers as $fertilizer) {
                if($fertilizer['ID'] == $entry['FERTILIZERID']) {
                    $plant['NUTRITION'][] = array(
                        'NAME'      => $fertilizer['NAME'],
                        'AMOUNT'    => $entry['AMOUNT'],
                        'UNIT'      => $entry['UNIT']
                    );
                }
            }
        }

        return $plant;
    }
}