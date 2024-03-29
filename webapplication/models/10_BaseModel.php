<?php

namespace PNS;

abstract class BaseModel {
    const TYPE_INT = 'int';
    const TYPE_FLOAT = 'float';
    const TYPE_STRING = 'string';
    const TYPE_ARRAY = 'array';
    const TYPE_DEFAULT = 'DEFAULT';

    protected $schema = []; // schema for the database table (attribute names from the Table)
    protected $data = [];  // data which goes into the table

    // baseModel constructor
    public function __construct($params) {
        foreach ($this->schema as $key => $value) {
            if (isset($params[$key])) {
                $this->{$key} = $params[$key];
            } else {
                $this->{$key} = null;
            }
        }
    }

    // magic method to get $data files
    public function __get($key) {
        if (array_key_exists($key, $this->data)) {
            return $this->data[$key];
        }
        $message = 'You can not access to property "' . $key . '"" for the class "' . get_called_class();
        throw new \Exception($message);
    }

    // megic method to set $data files
    public function __set($key, $value) {
        if (array_key_exists($key, $this->schema)) {
            $this->data[$key] = $value;
            return;
        }
        $message = 'You can not access to property "' . $key . '"" for the class "' . get_called_class();
        throw new \Exception($message);
    }

    /**
     * Checks if ID is set, then update, when not then insert
     *
     * @return array
     */
    public function save() {
        $errors = array();

        $this->insert($errors);

        return $errors;
    }

    /**
     * Inserts data into database
     *
     * @param $errors - array with error messages
     * @return bool
     */
    protected function insert(&$errors) {
        $client = $GLOBALS['elasticsearchConnection'];

        try {
            $params = [
                'index' => INDEX,
                'body' => json_encode([
                    'timestamp' => date('c'),
                    self::tableName() => $this->data
                ])
            ];

            $id = $client->index($params)['_id'];
            $GLOBALS['lastInsertedId'] = $id;
        } catch (\Throwable $e) {
            $errors[0] = 'Error updating ' . get_called_class();
            $errors[1] = $e->getMessage();
        }
    }

    /**
     * Returns alle data from database
     *
     * @param $where - without WHERE string
     * @param $orderBy - with ORDER BY string
     * @return array
     */
    public static function find(array $where = [], array $orderBy = []) {
        $client = $GLOBALS['elasticsearchConnection'];

        if(empty($where)) {
            $params = [
                'index' => 'pns',
                'body'  => [
                    'query' => [
                        'exists' => [
                            'field' => self::tableName()
                        ]
                    ]
                ]
            ];
        } else {
            $params = [
                'index' => INDEX,
                'body' => [
                    "query" => [
                        'match' => $where
                    ],
                ],
            ];
        }

        $results = $client->search($params);

        if(!empty($results)) {
            $objectArray = [];
            foreach ($results['hits']['hits'] as $result) {
                $object = $result['_source'][self::tableName()];
                $object['id'] = $result['_id'];

                $objectArray[] = $object;
            }

            return $objectArray;
        } else {
            return $results;
        }
    }

    /**
     * Delete data from database
     *
     * @param $where - without WHERE string als array angeben => Bsp.: ['id' => 45]
     * @return array - empty when successfully delete
     */
    public static function deleteWhere($where) {
        $client = $GLOBALS['elasticsearchConnection'];
        $response = [];
        if(!empty($where)) {
            $params = [
                'index' => INDEX,
                'id'    => $where
            ];
            // Delete doc at /my_index/_doc_/my_id
            $response = $client->delete($params);
        }
        return $response;
    }

    /**
     * Returns true when validation is correct, flase when not
     *
     * @param $errors - array with error messages
     * @return bool
     */
    public function validate(&$errors) {
        foreach ($this->schema as $key => $schemaOptions) {
            if (isset($this->data[$key]) && is_array($schemaOptions)) {
                $valueErrors = $this->validateValue($key, $this->data[$key], $schemaOptions);

                if (is_array($valueErrors)) {
                    array_push($errors, ...$valueErrors);
                }
            }
        }

        if (count($errors ?? []) == 0) {
            return true;
        } else {
            return false;
        }
    }

    /**
     * Checks if types and lengths are correct
     *
     * @param $attribute - attribute to check
     * @param $value - value to check
     * @param $schemaOptions - options to compare with
     * @return array|bool
     */
    protected function validateValue($attribute, &$value, &$schemaOptions) {
        $type = $schemaOptions['type'];
        $errors = [];

        switch ($type) {
            case BaseModel::TYPE_INT:
            case BaseModel::TYPE_FLOAT:
                if(!is_numeric($value) && $value != null) {
                    $errors[] = $attribute . ': Ist keine Zahl oder ein numerischer String';
                }
                break;
            case BaseModel::TYPE_STRING:
                {
                    if (isset($schemaOptions['min']) && mb_strlen($value) < $schemaOptions['min']) {
                        $errors[] = $attribute . ': Eingabe muss mindestens aus ' . $schemaOptions['min'] . ' Zeichen bestehen!';
                    }
                    if (isset($schemaOptions['max']) && mb_strlen($value) > $schemaOptions['max']) {
                        $errors[] = $attribute . ': Eingabe darf maximal aus ' . $schemaOptions['max'] . ' Zeichen bestehen!';
                    }
                }
                break;
        }

        return count($errors) > 0 ? $errors : true;
    }

    /**
     * Returns the table name of the class
     * @return null | string
     */
    public static function tableName(){
        $class = get_called_class();
        if (defined($class . '::TABLENAME')) {
            return $class::TABLENAME;
        }
        return null;
    }
}