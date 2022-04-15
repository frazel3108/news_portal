<?php
session_start();
include("../database/db.php");

if (!empty($_POST['login']['login'])) {
    $login    = trim($_POST['login']['login']);
    $password = trim($_POST['login']['password']);

    $user = signUp($login, md5($password));
    if (empty($user)) {
        $user = signUp($login, $password);
    }

    if (!empty($user)) {
        if ($user['type'] != 'admin') {
            $data = getData($user['idContract']);
            $_SESSION['auth'] = [
                'id'            => $user['id'],
                'login'         => $login,
                'password'      => $password,
                'email'         => $user['email'],
                'idContract'    => $user['idContract'],
                'type'          => $user['type'],
                'img'           => $user['img'],
                'data'          => [
                    'surname'           => $data['surname'],
                    'firstName'         => $data['firstName'],
                    'middleName'        => $data['middleName'],
                    'gender'            => $data['gender'],
                    'phoneNumber'       => $data['phoneNumber'],
                    'dateOfBirthday'    => $data['dateOfBirthday']
                ]
            ];
        } else {
            $_SESSION['auth'] = [
                'id'            => $user['id'],
                'login'         => $login,
                'password'      => $password,
                'email'         => $user['email'],
                'idContract'    => $user['idContract'],
                'type'          => $user['type'],
                'img'           => $user['img']
            ];
        }
        header('Location: ../../index.php');
    } else {
        header('Location: ../../index.php');
    }
} else if (!empty($_GET['login'])) {
    $login    = trim($_GET['login']);
    $password = trim($_GET['password']);

    $user = signUp($login, $password);
    if (!empty($user)) {
        if ($user['type'] != 'admin') {
            $data = getData($user['idContract']);
            $_SESSION['auth'] = [
                'id'            => $user['id'],
                'login'         => $login,
                'password'      => $password,
                'email'         => $user['email'],
                'idContract'    => $user['idContract'],
                'type'          => $user['type'],
                'img'           => $user['img'],
                'data'          => [
                    'surname'           => $data['surname'],
                    'firstName'         => $data['firstName'],
                    'middleName'        => $data['middleName'],
                    'gender'            => $data['gender'],
                    'phoneNumber'       => $data['phoneNumber'],
                    'dateOfBirthday'    => $data['dateOfBirthday']
                ]
            ];
        } else {
            $_SESSION['auth'] = [
                'id'            => $user['id'],
                'login'         => $login,
                'password'      => $password,
                'email'         => $user['email'],
                'idContract'    => $user['idContract'],
                'type'          => $user['type'],
                'img'           => $user['img']
            ];
        }
        header('Location: ../../index.php');
    } else {
        header('Location: ../../index.php');
    }
} else {
    header('Location: ../../index.php');
}
