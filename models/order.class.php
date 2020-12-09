<?

class Order {
    const TABLENAME = '`order`';
    private $data;

    //There should be a constructor here.

    //Here is the Getter-Function.
    public function __get($key) {
        if (isset($this->data[$key])) {
            return $this->data[$key];
        }
    }

    //Function to get Favorite Delivery-Address. To get the data we use the customerId.
    public static function favShipAdd($who = 0) {
        $db = $GLOBALS['db'];
        $result = null;

        try {
            $sql = 'SELECT street, number, zip, city FROM customer';

            if (!empty($who)) {
                $sql .= ' WHERE ' . $who . ';';
            }

            $result = $db->query($sql)->fetchAll();
        } catch(\PDOException $e) {
            die('Selected statement failed: ' . $e->getMessage());
        }

        return $result;
    }
}

?>