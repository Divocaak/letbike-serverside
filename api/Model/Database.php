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

    public function saveImages($images, $folder, $folderIdentificator = null)
    {
        try {
            $pathToImages = PROJECT_ROOT_PATH . "/uploadedImgs/" . $folder . "/";
            if (isset($folderIdentificator)) {
                $pathToImages = $pathToImages . $folderIdentificator;
                if (!file_exists($pathToImages)) {
                    mkdir($pathToImages, 0775, true);
                }
            }

            $succ = true;
            for ($i = 0; $i < count($images); $i++) {
                if (!$succ) {
                    throw new Exception("failed to save image");
                }

                $succ = imagejpeg(imagecreatefromstring(base64_decode($images[$i])), $pathToImages . "/" . $i . ".jpg", 75);
            }
        } catch (Exception $e) {
            throw new Exception($e->getMessage());
        }
    }

    public function addParamTypePair(&$params, &$types, $param, $type, $checkNull = false)
    {
        if (!$checkNull || ($checkNull && $param != null)) {
            $types .= $type;
            $params[] = $param;
        }
    }

    public function insert($query = "", $types = "", $params = [])
    {
        try {
            $stmt = $this->executeStatement($query, $types, $params);
            if (!$stmt) {
                throw new ErrorException("stmt error");
            }

            $stmt->close();
        } catch (ErrorException $e) {
            throw new ErrorException($e->getMessage());
        }
        return true;
    }

    public function select($query = "", $types = "", $params = [], &$toRet = null, $function = null)
    {
        try {
            $stmt = $this->executeStatement($query, $types, $params);
            if (!$stmt) {
                throw new ErrorException("stmt error");
            }

            if (!isset($function) || !isset($toRet)) {
                $result = $stmt->get_result()->fetch_all(MYSQLI_ASSOC);
                $stmt->close();
                return $result;
            }

            if ($result = $stmt->get_result()) {
                $toRet = [];
                while ($row = $result->fetch_assoc()) {
                    $toRet[] = $function($row);
                }
                $stmt->close();
                return $toRet;
            }
        } catch (ErrorException $e) {
            throw new ErrorException($e->getMessage());
        }
    }

    public function update($query = "", $types = "", $params = [])
    {
        try {
            $stmt = $this->executeStatement($query, $types, $params);
            if (!$stmt) {
                throw new ErrorException("stmt error");
            }

            $stmt->close();
        } catch (ErrorException $e) {
            throw new ErrorException($e->getMessage());
        }
        return true;
    }

    private function executeStatement($query = "", $types = "", $params = [])
    {
        try {
            $stmt = $this->connection->prepare($query);
            if ($stmt === false) {
                throw new ErrorException("Unable to do prepared statement: " . $query);
            }

            if ($params) {
                $stmt->bind_param($types, ...$params);
            }

            if ($stmt->execute() === false) {
                throw new ErrorException("Prep stmt error: " . $query);
            }

            return $stmt;
        } catch (ErrorException $e) {
            throw new ErrorException($e->getMessage());
        }
    }
}
