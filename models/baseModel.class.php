<?php 

// @author Molhal Al-Khodari, Jessica Eckardtsberg
// @version 1.0.1
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

        /*
        public function save(&$errors = null)
        {
            if($this->id===null)
            {
                $this->insert($errors);
            }
            else
            {
                $this->update($errors);
            }
        }
        */

        public function insert(&$errors)
        {
            $db = $GLOBALS['db'];

            try
            {
                $sql = 'INSERT INTO ' . self::tableName() . ' (';
                $valueString = ' VALUES (';

                foreach($this->schema as $key => $schemaOptions)
                {
                    $sql .= '`'.$key.'`,';

                    if($this->data[$key]=== null)
                    {
                        $valueString .= 'NULL,';
                    }
                    else
                    {
                        $valueString .= $db->query($this->data[$key]).',';
                    }
                }

                $sql            = trim($sql, ',');
                $valueString    = trim($valueString, ',');
                $sql           .= ')'.$valueString. ');';

                $statement = $db->prepare($sql);
                $statement->execute();

                return true;
            }
            catch(\PDOException $e)
            {
                $errors[] = 'Error inerting '.get_called_class();
            }
            return false;
        }

        public function update(&$errors)
        {
            $db = $GLOBALS['db'];

            try
            {
                $sql = 'UPDATE ' . self::tableName() . ' SET';

                foreach($this->schema as $key => $schemaOptions)
                {
                    if($this->data[$key]!== null)
                    {
                        $sql .= $key . ' = ' . $db->quote($this->data[$key]);
                    }
                }

                $sql  = trim($sql, ',');
                $sql .= 'WHERE id = '.$this->data['id'];

                $statement = $db->prepare($sql);
                $statement->execute();

                return true;
            }
            catch(\PDOException $e)
            {
                $errors[] = 'Error updateing '.get_called_class();
            }
            return false;
        }

        public function delete(&$errors = null)
        {
            $db = $GLOBALS['db'];

            try
            {
                $sql = 'DELETE FROM ' . self::tableName() . ' WHERE id = ' .$this->id;
                $db->exec($sql);
                return true;
            }
            catch(\PDOException $e)
            {
                $errors[] = 'Error deleting '.get_called_class();
            }
            return false;
        }

        public function validate(&$errors = null)
        {
            foreach($this->schema as $key => $schemaOptions)
            {
                if(isset($this->data[$key]) && is_array($schemaOptions))
                {
                    $valueErrors = $this->validateValue($key, $this->data[$key], $schemaOptions);

                    if($valueErrors !== true)
                    {
                        array_push($errors, ...$valueErrors);
                    }

                }
            }

            return (count($errors) === 0) ? true : false;
        }

        protected function  validateValue($attribute, &$value,&$schemaOptions)
        {

            $type = $schemaOptions['type'];
            $errors = [];

            switch ($type)
            {
                case BaseModel::TYPE_INT:
                break;
                case BaseModel::TYPE_FLOAT:
                break;
                case BaseModel::TYPE_STRING:
                    {
                        if(isset($schemaOptions['min']) && mb_strlen($value) < $schemaOptions['min']) 
                        {
                            $errors[] = $attribute. ': String need min '.$schemaOptions['min']. ' characters!';
                        }

                        if(isset($schemaOptions['max']) && mb_strlen($value) > $schemaOptions['max']) 
                        {
                            $errors[] = $attribute. ': String can have max. '.$schemaOptions['min']. ' characters!';
                        }
                    }
                break;
            }
            return count($errors) > 0 ? $errors : true;
        }

        public static function tableName()
        {
            $class = get_called_class();
            if(defined($class. '::TABLENAME'))
            {
                return $class::TABLENAME;
            }
            return null;
        }

        public static function find($condition, $tabel)
        {
            $db = $GLOBALS['db'];
            $result = null;
    
            try {
                $sql = 'SELECT * FROM ' . $tabel;
    
                if(!empty($where) && !empty($value))
                {
                    $sql .= ' WHERE ' . $condition;
                }
    
                $result = $db->query($sql)->fetchAll();
            }
            catch(\PDOException $e) {
                die('Selct statment failed: ' . $e->getMessage());
            }
    
            return $result;
        }

        // $what is what we are searching for.
        // This time where is an array of rownames depending on the tabel.
        // $values has to be at the same lenght as $where.
        public static function findOne($what, $where = [], $values = []) {
            // Check if $where and $values have the same lenght.
            if (count($where) != count($values)) {
                die('Übergabe Parameter inkorrekt.');
            }

            $db = $GLOBALS['db'];
            $result = self::tableName();

            for ($idx = 0; $idx < count($where); $idx++) {
                $result = self::find("$where[$idx] = $values[$idx]", $result);
            }

            try {
                $result = 'SELECT ' . $what . ' FROM ' . $result;
            }
            catch(\PDOException $e)
            {
                die('Selct statment failed: ' . $e->getMessage());
            }

            return $result;
        }
    }
?>
