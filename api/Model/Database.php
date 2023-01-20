<?php

class Database
{
    protected $connection = null;
    public function __construct()
    {
        try {
            $this->connection = new mysqli(DB_SERVER, DB_USERNAME, DB_PASSWORD, DB_NAME);

            if (mysqli_connect_errno()) {
                throw new Exception("Could not connect to database.");
            }
        } catch (Exception $e) {
            throw new Exception($e->getMessage());
        }
    }

    public function addParamTypePair(&$params, &$types, $param, $type, $checkNull = false){
        if (!$checkNull || ($checkNull && $param != null)) {
            $types .= $type;
            $params[] = $param;
        }
    }

    public function insert($query = "", $types = "", $params = [])
    {
        try {
            $stmt = $this->executeStatement($query, $types, $params);
            $stmt->close();
            return true;
        } catch (Exception $e) {
            throw new Exception($e->getMessage());
        }
        return false;
    }

    public function select($query = "", $types = "", $params = [], &$toRet = null, $function = null)
    {
        try {
            $stmt = $this->executeStatement($query, $types, $params);
            if (!isset($function) || !isset($toRet)) {
                $result = $stmt->get_result()->fetch_all(MYSQLI_ASSOC);
                $stmt->close();
                return $result;
            }

            if ($result = $stmt->get_result()) {
                while ($row = $result->fetch_assoc()) {
                    $toRet[] = $function($row);
                }
            }
            $stmt->close();
        } catch (Exception $e) {
            throw new Exception($e->getMessage());
        }
        return false;
    }

    public function update($query = "", $types = "", $params = [])
    {
        try {
            $stmt = $this->executeStatement($query, $types, $params);
            $stmt->close();
            return true;
        } catch (Exception $e) {
            throw new Exception($e->getMessage());
        }
        return false;
    }

    private function executeStatement($query = "", $types = "", $params = [])
    {
        try {
            $stmt = $this->connection->prepare($query);
            if ($stmt === false) {
                throw new Exception("Unable to do prepared statement: " . $query);
            }
            if ($params) {
                $stmt->bind_param($types, ...$params);
            }
            $stmt->execute();
            return $stmt;
        } catch (Exception $e) {
            throw new Exception($e->getMessage());
        }
    }
}
