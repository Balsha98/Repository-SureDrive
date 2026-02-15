<?php

class Database extends PDO
{
    private static Database $db;

    private function __construct($dbName, $username, $password)
    {
        parent::__construct("mysql:hostname=localhost;dbname={$dbName};", $username, $password);
    }

    public static function getInstance()
    {
        if (!isset(self::$db)) {
            self::$db = new Database('sure_drive', 'root', '');
        }

        return self::$db;
    }

    // ***** USER ***** //

    public function verifyUserLogin($username, $password)
    {
        $data = $this->getUserData($username);

        if (is_array($data)) {
            if ($data['username'] === $username) {
                return hash_equals($data['password'], md5($password));
            }
        }

        return false;
    }

    public function userSignup($data)
    {
        $query = '
            INSERT INTO users (role_id, username, password, user_email) 
            VALUES (:role_id, :username, :password, :user_email);
        ';

        $statement = self::$db->prepare($query);
        $params = ['role_id', 'username', 'password', 'user_email'];

        for ($i = 0; $i < count($params); $i++) {
            $param = $params[$i];

            $type = PDO::PARAM_STR;
            if (is_numeric($param)) {
                $type = PDO::PARAM_INT;
            }

            if ($param === 'password') {
                $data[$param] = hash('md5', $data[$param]);
            }

            $statement->bindParam(":{$param}", $data[$param], $type);
        }

        $statement->execute();
    }

    public function getAllUsers()
    {
        $query = '
            SELECT * FROM users 
            INNER JOIN roles
            ON users.role_id = roles.role_id
            ORDER BY user.user_id ASC;
        ';

        $array = self::$db->query($query);

        if ($array->execute()) {
            return $array->fetchAll(PDO::FETCH_ASSOC);
        }

        return null;
    }

    public function getUserData($username)
    {
        $query = "
            SELECT * FROM users
            INNER JOIN roles 
            ON users.role_id = roles.role_id 
            WHERE user.username = '{$username}';
        ";

        $statement = self::$db->query($query);

        if ($statement->execute()) {
            return $statement->fetch(PDO::FETCH_ASSOC);
        }

        return null;
    }

    public function getUserTypeData($table, $userID)
    {
        $query = "SELECT * FROM {$table} WHERE user_id = {$userID};";
        $statement = self::$db->query($query);

        if ($statement->execute()) {
            return $statement->fetchAll(PDO::FETCH_ASSOC);
        }

        return null;
    }

    public function getSellersAndOwners()
    {
        $query = '
            SELECT user_id, username 
            FROM users 
            WHERE role_id = 3 
            OR role_id = 4;
        ';

        $statement = self::$db->query($query);

        if ($statement->execute()) {
            return $statement->fetchAll(PDO::FETCH_ASSOC);
        }

        return null;
    }

    public function insertNewUser($data)
    {
        $query = '
            INSERT INTO users (
                role_id, username, password,
                user_email, user_phone, location
            ) VALUES (
                :role_id, :username, :password,
                :email, :phone, :location
            );
        ';

        $this->alterUserHelper('add', $data, $query);
    }

    public function updateUserByID($id, $data)
    {
        $query = "
            UPDATE users SET 
            role_id = :role_id, username = :username, 
            user_email = :email, user_phone = :phone, location = :location
            WHERE user_id = {$id};
        ";

        $this->alterUserHelper('edit', $data, $query);
    }

    public function updateUserProfile($id, $data)
    {
        $query = "
            UPDATE users SET 
            username = :username, user_email = :email, 
            user_phone = :phone, location = :location
            WHERE user_id = {$id};
        ";

        $statement = self::$db->prepare($query);
        $params = ['username', 'email', 'phone', 'location'];

        for ($i = 0; $i < count($params); $i++) {
            $param = $params[$i];

            $type = PDO::PARAM_STR;
            if (is_numeric($param)) {
                $type = PDO::PARAM_INT;
            }

            $statement->bindParam(":{$param}", $data["edit_profile_{$param}"], $type);
        }

        $statement->execute();
    }

    // ***** CAR ***** //

    public function getAllCars()
    {
        $query = '
            SELECT * FROM cars 
            INNER JOIN descriptions 
            ON cars.car_id = descriptions.car_id 
            ORDER BY car.car_id ASC;
        ';

        $array = self::$db->query($query);

        if ($array->execute()) {
            return $array->fetchAll(PDO::FETCH_ASSOC);
        }

        return null;
    }

    public function getBoughtCarsByUserID($buyerID)
    {
        $query = "SELECT * FROM cars_bought WHERE user_id = {$buyerID};";
        $statement = self::$db->query($query);

        if ($statement->execute()) {
            return $statement->fetchAll(PDO::FETCH_ASSOC);
        }

        return null;
    }

    public function getFilteredCars($filters)
    {
        $query = '
            SELECT cars.car_id FROM cars 
            INNER JOIN descriptions 
            ON cars.car_id = descriptions.car_id 
            WHERE {CLAUSE};
        ';

        $strip = 4;
        $clause = '';
        foreach ($filters as $filter => $values) {
            if ($filter === 'make' || $filter === 'fuel' || $filter === 'shift') {
                foreach ($values as $value) {
                    $table = $filter === 'make' ? 'car' : 'description';
                    $clause .= "{$table}.{$filter} = '{$value}' OR ";
                }
            } else {
                $table = $filter === 'year' ? 'car' : 'description';
                $clause .= "{$table}.{$filter} >= {$values[0]} AND {$table}.{$filter} <= {$values[1]} AND ";
                $strip = 5;
            }
        }

        $clause = substr($clause, 0, strlen($clause) - $strip);
        $query = str_replace('{CLAUSE}', $clause, $query);

        $statement = self::$db->query($query);
        if ($statement->execute()) {
            return $statement->fetchAll(PDO::FETCH_ASSOC);
        }

        return null;
    }

    public function getDistinctCarMakes()
    {
        $query = 'SELECT DISTINCT make FROM car;';
        $statement = self::$db->query($query);

        if ($statement->execute()) {
            return $statement->fetchAll(PDO::FETCH_ASSOC);
        }

        return null;
    }

    public function getCarsForUserID($userType, $userID)
    {
        $query = "
            SELECT * FROM cars 
            INNER JOIN descriptions 
            ON cars.car_id = descriptions.car_id 
            WHERE descriptions.{$userType}_id = {$userID} 
            ORDER BY cars.car_id ASC;
        ";

        $array = self::$db->query($query);

        if ($array->execute()) {
            return $array->fetchAll(PDO::FETCH_ASSOC);
        }

        return null;
    }

    public function getCarDetailsByID($car_id)
    {
        $query = "
            SELECT * FROM cars 
            INNER JOIN descriptions
            ON cars.car_id = descriptions.car_id 
            INNER JOIN users 
            ON descriptions.seller_id = users.user_id 
            WHERE cars.car_id = {$car_id};
        ";

        $array = self::$db->query($query);

        if ($array->execute()) {
            return $array->fetch(PDO::FETCH_ASSOC);
        }

        return null;
    }

    public function insertNewCar($data)
    {
        $this->insertNewCarDetails($data);
        $data['add_car_id'] = $this->getLastAddedItemID('car')['id'];
        $this->insertNewCarDescription($data);
    }

    private function insertNewCarDetails($data)
    {
        $query = '
            INSERT INTO cars (make, model, year) 
            VALUES (:make, :model, :year);
        ';

        $params = [
            'make', 'model', 'year'
        ];

        $this->alterCarHelper('add', $data, $query, $params);
    }

    private function insertNewCarDescription($data)
    {
        $query = '
            INSERT INTO descriptions (
                car_id, seller_id, owner_id, note, mileage, horse_power, 
                fuel, color, shift, original_price, final_price
            ) VALUES (
                :id, :seller_id, :owner_id, :note, :mileage, :horse_power, 
                :fuel, :color, :shift, :original_price, :final_price
            );
        ';

        $params = [
            'id', 'seller_id', 'owner_id', 'note', 'mileage', 'horse_power',
            'fuel', 'color', 'shift', 'original_price', 'final_price'
        ];

        $this->alterCarHelper('add', $data, $query, $params);
    }

    public function insertNewBoughtCar($data)
    {
        $query = '
            INSERT INTO cars_bought (
                user_id, year, make, model, 
                mileage, shift, final_price
            ) VALUES (
                :user_id, :year, :make, :model, 
                :mileage, :shift, :final_price
            );
        ';

        $params = [
            'user_id', 'year', 'make', 'model',
            'mileage', 'shift', 'final_price'
        ];

        $this->insertCheckoutHelper($data, $query, $params);
    }

    public function updateCarByID($id, $data)
    {
        $query = "
            UPDATE cars 
            INNER JOIN descriptions 
            ON cars.car_id = descriptions.car_id SET 
            cars.make = :make, cars.model = :model, cars.year = :year,
            descriptions.seller_id = :seller_id, descriptions.owner_id = :owner_id, descriptions.note = :note, 
            descriptions.mileage = :mileage, descriptions.horse_power = :horse_power, 
            descriptions.fuel = :fuel, descriptions.color = :color, descriptions.shift = :shift, 
            descriptions.original_price = :original_price, descriptions.final_price = :final_price 
            WHERE cars.car_id = {$id};
        ";

        $params = [
            'make', 'model', 'year', 'seller_id', 'owner_id', 'note', 'mileage',
            'horse_power', 'fuel', 'color', 'shift', 'original_price', 'final_price'
        ];

        $this->alterCarHelper('edit', $data, $query, $params);
    }

    // ***** SALES ***** //

    public function getAllSales()
    {
        $query = 'SELECT * FROM sales;';
        $statement = self::$db->query($query);

        if ($statement->execute()) {
            return $statement->fetchAll(PDO::FETCH_ASSOC);
        }

        return null;
    }

    public function getSalesForUserID($userID)
    {
        $query = "SELECT * FROM sales WHERE user_id = {$userID};";
        $statement = self::$db->query($query);

        if ($statement->execute()) {
            return $statement->fetchAll(PDO::FETCH_ASSOC);
        }

        return null;
    }

    public function insertNewSale($data)
    {
        $query = '
            INSERT INTO sales (
                user_id, car_name, buyer, 
                seller, owner, commission, total_price
            ) VALUES (
                :user_id, :car_name, :buyer, 
                :seller, :owner, :commission, :total_price
            );
        ';

        $params = [
            'user_id', 'car_name', 'buyer',
            'seller', 'owner', 'commission', 'total_price'
        ];

        $this->insertCheckoutHelper($data, $query, $params);
    }

    public function insertNewShipment($data)
    {
        $query = '
            INSERT INTO shipments (
                sale_id, first_name, last_name, 
                order_email, order_phone, shipping_address, 
                apt_number, country, city, zip
            ) VALUES (
                :sale_id, :first_name, :last_name, 
                :order_email, :order_phone, :shipping_address, 
                :apt_number, :country, :city, :zip
            );
        ';

        $params = [
            'sale_id', 'first_name', 'last_name',
            'order_email', 'order_phone', 'shipping_address',
            'apt_number', 'country', 'city', 'zip'
        ];

        $this->insertCheckoutHelper($data, $query, $params);
    }

    // ***** HELPER ***** //

    private function alterUserHelper($action, $data, $query)
    {
        $statement = self::$db->prepare($query);

        $params = ['role_id', 'username', 'email', 'phone', 'location'];
        for ($i = 0; $i < count($params); $i++) {
            $param = $params[$i];

            $type = PDO::PARAM_STR;
            if (is_numeric($param)) {
                $type = PDO::PARAM_INT;
            }

            $statement->bindParam(":{$param}", $data["{$action}_user_{$param}"], $type);
        }

        $statement->execute();
    }

    private function alterCarHelper($action, $data, $query, $params)
    {
        $statement = self::$db->prepare($query);

        for ($i = 0; $i < count($params); $i++) {
            $param = $params[$i];

            $type = PDO::PARAM_STR;
            if (is_numeric($param)) {
                $type = PDO::PARAM_INT;
            }

            $statement->bindParam(":{$param}", $data["{$action}_car_{$param}"], $type);
        }

        // Execute query.
        $statement->execute();
    }

    private function insertCheckoutHelper($data, $query, $params)
    {
        // Prepare query.
        $statement = self::$db->prepare($query);

        // Bind params.
        for ($i = 0; $i < count($params); $i++) {
            $param = $params[$i];

            $type = PDO::PARAM_STR;
            if (is_numeric($param)) {
                $type = PDO::PARAM_INT;
            }

            $statement->bindParam(":{$param}", $data["{$param}"], $type);
        }

        // Execute query.
        $statement->execute();
    }

    // ***** DYNAMIC ***** //

    public function getMaxValue($column, $table)
    {
        $query = "SELECT MAX({$column}) AS max FROM {$table};";
        $statement = self::$db->query($query);

        if ($statement->execute()) {
            return $statement->fetch(PDO::FETCH_ASSOC);
        }

        return null;
    }

    public function getLastAddedItemID($table)
    {
        $query = "SELECT MAX({$table}_id) AS id FROM {$table};";
        $statement = self::$db->query($query);

        if ($statement->execute()) {
            return $statement->fetch(PDO::FETCH_ASSOC);
        }

        return 0;
    }

    public function getValueForUserType($column, $table, $userID)
    {
        $query = "SELECT {$column} FROM {$table} WHERE {$table}_id = {$userID};";
        $statement = self::$db->query($query);

        if ($statement->execute()) {
            return $statement->fetch(PDO::FETCH_ASSOC);
        }

        return null;
    }

    public function updateValueForUserType($column, $table, $value, $userID)
    {
        $query = "
            UPDATE {$table} 
            SET {$column} = :{$column} 
            WHERE user_id = {$userID};
        ";

        $statement = self::$db->prepare($query);
        $statement->bindParam(":{$column}", $value, PDO::PARAM_INT);
        $statement->execute();
    }

    public function updateItemImage($table, $column, $image, $id)
    {
        $query = "
            UPDATE {$table} SET 
            {$column}_image = :image 
            WHERE {$column}_id = :id;
        ";

        $statement = self::$db->prepare($query);
        $statement->bindParam(':image', $image, PDO::PARAM_STR);
        $statement->bindParam(':id', $id, PDO::PARAM_INT);
        $statement->execute();
    }

    public function deleteItem($table, $id)
    {
        $query = "DELETE FROM {$table} WHERE {$table}_id = {$id};";
        $statement = self::$db->query($query);
        $statement->execute();
    }
}
