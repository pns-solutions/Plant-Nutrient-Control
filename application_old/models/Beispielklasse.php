<?php

namespace PNS;

class Beispielklasse extends BaseModel{
    const TABLENAME = '`testTable`';

    protected $schema = [
        'ID'    => ['type' => BaseModel::TYPE_INT],
        'NAME'  => ['type' => BaseModel::TYPE_STRING, 'min' => 2, 'max' => 64]
    ];

    function validateRegistration(&$inputError){
        $isValid = $this->validate($inputError);

        if ($this->{'ID'} === null) {
            array_push($inputError, 'Das Objekt bracuht eine ID!');
        }

        if ($this->{'NAME'} === null) {
            array_push($inputError, 'Der Vorname muss ausgefüllt sein!');
        }else if (!preg_match('/^[a-zA-ZàáâäãåąčćęèéêëėįìíîïłńòóôöõøùúûüųūÿýżźñçšžÀÁÂÄÃÅĄĆČĖĘÈÉÊËÌÍÎÏĮŁŃÒÓÔÖÕØÙÚÛÜŲŪŸÝŻŹÑßÇŒÆŠŽ∂ð ,.\'-][a-zA-ZàáâäãåąčćęèéêëėįìíîïłńòóôöõøùúûüųūÿýżźñçšžÀÁÂÄÃÅĄĆČĖĘÈÉÊËÌÍÎÏĮŁŃÒÓÔÖÕØÙÚÛÜŲŪŸÝŻŹÑßÇŒÆŠŽ∂ð ,.\'-]*$/', $this->{'NAME'})) {
            array_push($inputError, 'Der Vorname darf nur aus Buchstaben bestehen');
        }

        if(empty($inputError) && $isValid) {
            return true;
        } else {
            return false;
        }
    }
}