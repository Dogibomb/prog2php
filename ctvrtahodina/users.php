<?php
include "../databaze/databaze.php";

function get($table, $ID){
    global $db;
    $sql = "SELECT * FROM $table WHERE id = :id";
    $stmt = $db->prepare($sql);
    $stmt->execute(['id' => $ID]);
    return $stmt->fetch(PDO::FETCH_ASSOC);
}

function getAll($table){
    global $db;
    $sql = "SELECT * FROM $table";
    $stmt = $db->prepare($sql);
    $stmt->execute();
    return $stmt->fetchAll(PDO::FETCH_ASSOC);
}

function register($name, $password, $email){
    global $db;

    $errors = [];

    if(empty($name)){
        $errors[] = "Jméno nesmí být prázdné.";
    } elseif(strlen($name) < 3 || strlen($name) > 30){
        $errors[] = "Jméno musí mít 3–30 znaků.";
    }

    if(empty($email)){
        $errors[] = "Email nesmí být prázdný.";
    } elseif(!filter_var($email, FILTER_VALIDATE_EMAIL)){
        $errors[] = "Email není platný.";
    } else {
        $stmt = $db->prepare("SELECT id FROM users WHERE email = :email");
        $stmt->execute(['email' => $email]);
        if($stmt->fetch()){
            $errors[] = "Tento email je již zaregistrován.";
        }
    }

    if(empty($password)){
        $errors[] = "Heslo nesmí být prázdné.";
    } elseif(strlen($password) < 8){
        $errors[] = "Heslo musí mít alespoň 8 znaků.";
    }

    if(!empty($errors)){
        return ['success' => false, 'errors' => $errors];
    }

    $sql = "INSERT INTO users (name, password, email, created) VALUES (:name, :password, :email, NOW())";
    $stmt = $db->prepare($sql);
    $stmt->execute([
        'name'     => $name,
        'password' => $password,
        'email'    => $email
    ]);

    return ['success' => true, 'id' => $db->lastInsertId()];
}

$errors = [];
$success = false;

if($_SERVER['REQUEST_METHOD'] === 'POST'){
    $result = register(
        trim($_POST['uname'] ?? ''),
        trim($_POST['psw'] ?? ''),
        trim($_POST['email'] ?? '')
    );

    if($result['success']){
        header("Location: ../register/index.php?success=1");
        
        exit();
    } else {
        session_start();
        $_SESSION['errors'] = $result['errors'];
        echo "ahoj jak se mas";
        header("Location: ../register/index.php?error=1");
        
        exit();

    }
}
?>