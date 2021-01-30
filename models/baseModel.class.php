<?php 

// @author Molhal Al-Khodari, Jessica Eckardtsberg
// @version 1.1.0
    abstract class BaseModel
    {
        const TYPE_INT = 'int';
        const TYPE_FLOAT = 'float';
        const TYPE_STRING = 'string';

        protected $schema = [];
        protected $data = [];

        public function __construct($params)
        {
            foreach ($this->schema as $key => $value)
            {
                if(isset($params[$key]))
                {
                    $this->data[$key] = $params[$key];
                }
                else
                {
                    $this->{$key} = null;
                }
            }
        }

        public function __get($key) 
        {
            if(array_key_exists($key, $this->data))
            {
                return $this->data[$key];
            }

            throw new \Exception('You can not access to property "' .$key. '"" for the class "'.get_called_class());
        }

        public function __set($key, $value)  
        {
            if(array_key_exists($key, $this->schema))
            {
                $this->data[$key] = $value;
                return;
            }

            throw new \Exception('You can not write to property "' .$key. '"" for the class "'.get_called_class());
        }

        // The insert, update and delete methode will be implemented when they are needed. There isn't a method in this class for them.

        public static function tableName()
        {
            $class = get_called_class();
            if(defined($class. '::TABLENAME'))
            {
                return $class::TABLENAME;
            }
            return null;
        }

        public static function find($condition)
        {
            $db = $GLOBALS['db'];
            $result = null;
    
            try
            {
                $sql = 'SELECT * FROM ' . self::tableName() . ' WHERE ' . $condition;
                $result = $db->query($sql)->fetchAll();
            }
            catch(\PDOException $e)
            {
                die('Selct statment failed: ' . $e->getMessage());
            }
    
            return $result;
        }

        // Instead of selecting the entire row this will only select the table cell on the row of which the conditions are meet.
        public static function findOne($what, $condition)
        {
            $db = $GLOBALS['db'];
            $result = null;

            try
            {
                $sql = "SELECT $what FROM " . self::tableName() . ' WHERE ' . $condition;
                $result = $db->query($sql)->fetchAll();

            }
            catch(\PDOException $e)
            {
                die('Select statement failed: '. $e->getMessage());
            }

            return $result;
        }
    }
?>
