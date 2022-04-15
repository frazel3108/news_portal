<?php

require('connect.php');

function tt($value)
{
    echo '<pre>';
    print_r($value);
    echo '</pre>';
}

function selectAll($table, $argumentName = NULL, $params = [], $LIMIT = null, $sortOrder = null, $sortTime = false, $OFFSET = null)
{
    global $conn;
    if (!empty($argumentName)) {
        $sql = "SELECT $argumentName FROM $table";
        if (!empty($params)) {
            $i = 0;
            foreach ($params as $key => $value) {
                if ($i === 0) {
                    $sql = $sql . " WHERE $key = '$value'";
                } else {
                    $sql = $sql . " AND $key = '$value'";
                }
                $i++;
            }
        }
    } else if (empty($argumentName) && !empty($params)) {
        $sql = "SELECT * FROM $table";
        $i = 0;
        foreach ($params as $key => $value) {
            if ($i === 0) {
                $sql = $sql . " WHERE $key = '$value'";
            } else {
                $sql = $sql . " AND $key = '$value'";
            }
            $i++;
        }
    } else {
        $sql = "SELECT * FROM $table";
    }

    if ($sortTime == true && !empty($sortOrder)) {
        $sql = $sql . " ORDER BY " . $sortOrder . " DESC, STR_TO_DATE(datePublication, '%Y-%m-%d %H:%i') DESC";
    } else if ($sortTime == true && empty($sortOrder)) {
        $sql = $sql . " ORDER BY STR_TO_DATE(datePublication, '%Y-%m-%d %H:%i') DESC";
    } else if ($sortTime == false && !empty($sortOrder)) {
        $sql = $sql . " ORDER BY " . $sortOrder . " DESC";
    }

    if (!empty($LIMIT)) {
        $sql = $sql . " LIMIT " . $LIMIT;
    }
    if (!empty($LIMIT) && !empty($OFFSET)) {
        $sql = $sql . " OFFSET " . $OFFSET;
    }

    $query = $conn->query($sql);
    return $query->fetch_all(MYSQLI_ASSOC);
}

function selectOne($table, $params = [])
{
    global $conn;
    $sql = "SELECT * FROM $table";

    if (!empty($params)) {
        $i = 0;
        foreach ($params as $key => $value) {
            if ($i === 0) {
                $sql = $sql . " WHERE $key = '$value'";
            } else {
                $sql = $sql . " AND $key = '$value'";
            }
            $i++;
        }
    }

    $sql = $sql . " LIMIT 1";

    $query = $conn->query($sql);
    return $query->fetch_assoc();
}

function numRows($table, $params = [])
{
    global $conn;
    $sql = "SELECT * FROM $table";

    if (!empty($params)) {
        $i = 0;
        foreach ($params as $key => $value) {
            if ($i === 0) {
                $sql = $sql . " WHERE $key = '$value'";
            } else {
                $sql = $sql . " AND $key = '$value'";
            }
            $i++;
        }
    }
    return $conn->query($sql)->num_rows;
}

function addingViews($id)
{
    global $conn;
    $views = selectOne('news', ['id' => $id])['views'] + 1;
    $sql = "UPDATE `news` SET `views` = '$views' WHERE `id` = $id";
    $conn->query($sql);
}

function sumViews($id = null)
{
    global $conn;
    if (empty($id)) {
        $sql = "SELECT sum(views) as views FROM `news`";
    } else {
        $sql = "SELECT sum(views) as views FROM `news` WHERE idUsers = $id";
    }
    $query = $conn->query($sql);
    return $query->fetch_assoc();
}

function countMain()
{
    global $conn;
    $sql = "SELECT sum(mainNews) as main FROM `news`";
    $query = $conn->query($sql);
    return $query->fetch_assoc();
}

function avg($table, $argumentName)
{
    global $conn;
    $sql = "SELECT AVG($argumentName) as avg FROM $table";
    $query = $conn->query($sql);
    return ceil($query->fetch_assoc()['avg']);
}

function selectAVG($table, $argumentName, $operator)
{
    global $conn;
    $avg = avg($table, $argumentName);
    $sql = "SELECT * FROM $table WHERE $argumentName $operator $avg";
    $query = $conn->query($sql);
    return $query->fetch_all(MYSQLI_ASSOC);
}

function getData($idContract)
{
    global $conn;
    $sql = "SELECT * FROM contract WHERE id = $idContract";
    $query = $conn->query($sql);
    return $query->fetch_assoc();
}

function getAdv()
{
    global $conn;
    $sql = "SELECT img,href FROM advertisement WHERE used = 1";
    $query = $conn->query($sql);
    return $query->fetch_assoc();
}

function signUp($login, $password)
{
    global $conn;
    $stmt = $conn->prepare("SELECT * FROM users WHERE login = ? AND password = ?");
    $stmt->bind_param("ss", $login, $password);
    $stmt->execute();
    $result = $stmt->get_result();
    if ($result->num_rows === 1) {
        while ($row = $result->fetch_assoc()) {
            $res = $row;
        }
        return $res;
    } else {
        return null;
    }
}

function validateUser($login, $email, $idContract)
{
    global $conn;
    $count_valid = 0;
    $stmt = $conn->prepare("SELECT * FROM users WHERE login = ?");
    $stmt->bind_param("s", $login);
    $stmt->execute();
    $stmt->store_result();
    if ($stmt->num_rows == 0) {
        $count_valid++;
    } else {
        return 0;
    }
    $stmt = $conn->prepare("SELECT * FROM users WHERE email = ?");
    $stmt->bind_param("s", $email);
    $stmt->execute();
    $stmt->store_result();
    if ($stmt->num_rows == 0) {
        $count_valid++;
    } else {
        return 0;
    }
    $stmt = $conn->prepare("SELECT * FROM users WHERE idContract = ?");
    $stmt->bind_param("i", $idContract);
    $stmt->execute();
    $stmt->store_result();
    if ($stmt->num_rows == 0) {
        $count_valid++;
    } else {
        return 0;
    }
    if ($count_valid == 3) {
        return true;
    }
}