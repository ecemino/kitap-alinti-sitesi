<?php
require 'db.php'; 

$errors = [];

if($_SERVER['REQUEST_METHOD'] === 'POST'){
    $username = trim($_POST['username']);
    $password = $_POST['password'];

    if(empty($username) || empty($password)){
        $errors[] = "Lütfen tüm alanları doldurun.";

    }else{
        $stmt = $pdo->prepare("SELECT * FROM users WHERE username = ?");
        $stmt->execute([$username]);
        $user = $stmt->fetch(PDO::FETCH_ASSOC);

        if($user && password_verify($password, $user['password'])){
            
            session_start();
            $_SESSION['user_id'] = $user['id'];
            $_SESSION['username'] = $user['username'];
            $_SESSION['alias'] = $user['alias'];

            header("Location: /kitap_alintilari/dashboard.php");
            exit;

        }else{
            $errors[] = "Kullanıcı adı veya şifre yanlış.";
        }
    }
}
?>

<!DOCTYPE html>
<html lang="tr">
<head>
    <meta charset="UTF-8" />
    <title>Giriş Yap</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet" />
</head>
<body class="container mt-5" style = "background-color: #8A784E">
    <div class="d-flex justify-content-center align-items-center">
        <div class="text-center" style="color:azure">
            <h2>Giriş Yap</h2>
        </div>

        <?php if(!empty($errors)): ?>
            <div class="alert alert-danger">
                <ul>
                    <?php foreach ($errors as $error): ?>
                        <li><?= htmlspecialchars($error) ?></li>
                    <?php endforeach; ?>
                </ul>
            </div>
        <?php endif; ?>

    </div>


    <div class="d-flex justify-content-center align-items-center">
        <div class= "card p-4 shadow" style="background-color: #E7EFC7; width: 100%; max-width: 500px;">

        <form method="post" class="mt-3">
            <div class="mb-3">
                <label for="username" class="form-label">Kullanıcı Adı</label>
                <input type="text" name="username" id="username" class="form-control" required/>
            </div>

            <div class="mb-3">
                <label for="password" class="form-label">Şifre</label>
                <input type="password" name="password" id="password" class="form-control" required />
            </div>
            
            <button class="btn btn-outline-light" style = "background-color: #AEC8A4">Giriş Yap</button>
            <a href="/kitap_alintilari/register.php" class="btn btn-link text-muted" >Üye değil misin? Kayıt ol</a>
        </form>

    </div>
    </div>
</body>
</html>
