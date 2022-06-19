<?php

namespace PNS;

//require_once '../assets/composer/vendor/autoload.php';

use PDOException;
use Elasticsearch\ClientBuilder;

abstract class BaseModelEs
{
    public function __construct(){
    }

    public static function insert($json) {
        $client = ClientBuilder::create()->build();
        $successfullyInserted = false;

        try {
            $params = [
                'index' => 'ok',
                'body'  => $json
            ];

            $client->index($params);
            $successfullyInserted = true;
        } catch (PDOException $e) {
            $errors[0] = 'Error updating ' . get_called_class();
            $errors[1] = $e->getMessage();
        }
        return $successfullyInserted;
    }

    public static function find($docType) {
        $client = ClientBuilder::create()->build();

        try {
            $json = '{
                "query": {
                    "exists" : { "field" : "' . $docType . '" }
                    }
                }';

            $params = [
                'index' => 'tester',
                'body'  => $json
            ];

            $result = $client->search($params);
        } catch(PDOException $e) {
            $message = 'Select statment failed: ' . $e->getMessage();
            die($message);
        }

        return $result;
    }
}