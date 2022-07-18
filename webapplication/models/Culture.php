<?php

namespace PNS;

class Culture extends BaseModel {

    const TABLENAME = 'culture';

    protected $schema = [
        'plantId'       => ['type' => BaseModel::TYPE_INT   ],
        'name'          => ['type' => BaseModel::TYPE_STRING, 'min' => 1, 'max' => 32],
        'growthStages'  => ['type' => BaseModel::TYPE_ARRAY],
        'createdAt'     => ['type' => BaseModel::TYPE_STRING],
        'updatedAt'     => ['type' => BaseModel::TYPE_STRING]
    ];

    public function validateCulture(): array {
        // Leerer Fehler-Array
        $error = [];

        // Die validate Funktion prüft auf Datentyp und z.B.: min und max Attribute
        // Die Funktion gibt ein Array mit alles gefunden Fehlermeldung zurück (in das "error"-Array, da dieses als Referenz übergeben wird)
        $this->validate($error);

       if(!preg_match('/^[a-zA-ZàáâäãåąčćęèéêëėįìíîïłńòóôöõøùúûüųūÿýżźñçšžÀÁÂÄÃÅĄĆČĖĘÈÉÊËÌÍÎÏĮŁŃÒÓÔÖÕØÙÚÛÜŲŪŸÝŻŹÑßÇŒÆŠŽ∂ð ,.\'-][a-zA-ZàáâäãåąčćęèéêëėįìíîïłńòóôöõøùúûüųūÿýżźñçšžÀÁÂÄÃÅĄĆČĖĘÈÉÊËÌÍÎÏĮŁŃÒÓÔÖÕØÙÚÛÜŲŪŸÝŻŹÑßÇŒÆŠŽ∂ð ,.\'-]*$/', $this->name)) {
           $error[] = 'Der Name darf nur aus Buchstaben bestehen';
       }/* else if(...) {
            array_push($error, '.....');
        }*/

       return $error;
    }
}