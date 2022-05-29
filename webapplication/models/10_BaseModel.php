<?php

namespace PNS;

use PDOException;

abstract class BaseModel {
    const TYPE_INT = 'int';
    const TYPE_FLOAT = 'float';
    const TYPE_STRING = 'string';
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
        error_to_logFile($message);
        throw new \Exception($message);
    }

    /**
     * Checks if ID is set, then update, when not then insert
     *
     * @return array
     */
    public function save() {
        $errors = array();

        if ($this->ID === null || $this->ID === '') {
            $this->insert($errors);
        } else {
            $this->update($errors);
        }
        return $errors;
    }

    /**
     * Inserts data into database
     *
     * @param $errors - array with error messages
     * @return bool
     */
    protected function insert(&$errors) {
        $db = $GLOBALS['db'];

        $successfullyInserted = false;

        try {
            $sql = 'INSERT INTO ' . self::tableName() . ' (';
            $valueString = ' VALUES (';


            foreach ($this->schema as $key => $schemaOptions) {
                $sql .= '`' . $key . '`,';

                if ($this->data[$key] === null) {
                    $valueString .= 'DEFAULT,';
                } else {
                    $valueString .= $db->quote($this->data[$key]) . ',';
                }
            }

            $sql = trim($sql, ',');
            $valueString = trim($valueString, ',');
            $sql .= ')' . $valueString . ');';

            sql_to_logFile($sql);

            $statement = $db->prepare($sql);
            $db->beginTransaction();
            $statement->execute();

            $GLOBALS['lastInsertedID'] = $db->lastInsertId();

            $db->commit();
            $successfullyInserted = true;
        } catch (PDOException $e) {
            $errors[0] = 'Error updating ' . get_called_class();
            $errors[1] = $e->getMessage();
            $db->rollBack();
        }
        return $successfullyInserted;
    }

    /**
     * Update data in database
     *
     * @param $errors - array with error messages
     * @return bool
     */
    protected function update(&$errors) {
        $db = $GLOBALS['db'];

        $successfullyUpdated = false;

        try {
            $sql = 'UPDATE ' . self::tableName() . ' SET ';

            foreach ($this->schema as $key => $schemaOptions) {
                if ($this->data[$key] !== null) {
                    $sql .= $key . ' = ' . $db->quote($this->data[$key]) . ',';
                } else if(isset($schemaOptions['allowNull']) && $schemaOptions['allowNull']) {
                    $sql .= $key . ' = null,';
                }
            }

            $sql = trim($sql, ',');
            $sql .= ' WHERE id = ' . $this->data['ID'];

            sql_to_logFile($sql);

            $statement = $db->prepare($sql);
            $db->beginTransaction();
            $statement->execute();
            $db->commit();

            $successfullyUpdated = true;
        } catch (PDOException $e) {
            $errors[] = 'Error updating ' . get_called_class();
            $errors[1] = $e->getMessage();
            $db->rollBack();
        }

        return $successfullyUpdated;
    }

    /**
     * Delete data from database
     *
     * @param $where - without WHERE string
     * @return array - empty when successfully delete
     */
    public static function deleteWhere($where) {
        $db = $GLOBALS['db'];

        $errors = [];

        try {
            $sql = 'DELETE FROM ' . self::tableName() . ' WHERE ' . $where;

            sql_to_logFile($sql);

            $db->beginTransaction();
            $db->exec($sql);
            $db->commit();

        } catch (PDOException $e) {
            $errors[] = 'Error deleting ' . get_called_class();
            $errors[1] = $e->getMessage();
            $db->rollBack();
        }

        return $errors;
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

    /**
     * Returns alle data from database
     *
     * @param $where - without WHERE string
     * @param $viewName - When data comes from view
     * @param $orderBy - with ORDER BY string
     * @return array
     */
    public static function find($where = '', $viewName = null, $orderBy = '') {
        $db = $GLOBALS['db'];

        try {
            if(!$viewName) {
               $viewName = self::tableName();
            }

            $sql = 'SELECT * FROM ' . $viewName;

            if(!empty($where)) {
                $sql .= ' WHERE ' . $where . ';';
            }

            $sql .= ' ' . $orderBy;

            sql_to_logFile($sql);

            $result = $db->query($sql)->fetchAll();
        } catch(PDOException $e) {
            $message = 'Select statment failed: ' . $e->getMessage();
            die($message);
        }

        return $result;
    }


    /**
     * Returns one object from database
     *
     * @param $where - without WHERE string
     * @param $viewName - When data comes from view
     * @return array
     */
    public static function findOne($where = '', $viewName = null) {
        $db = $GLOBALS['db'];

        try {

            if (!$viewName) {
                $viewName = self::tableName();
            }

            $sql = 'SELECT * FROM ' . $viewName;
            if (!empty($where)) {
                $sql .= ' WHERE ' . $where . ';';
            }

            sql_to_logFile($sql);

            return $db->query($sql)->fetch();
        } catch (PDOException $e) {
            $message = 'Select statment failed: ' . $e->getMessage();
            die($message);
        }
    }
}