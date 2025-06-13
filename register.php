<?php
require 'db.php'; 

$errors = [];

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $username = trim($_POST['username']);
    $alias = trim($_POST['alias']);
    $password = $_POST['password'];

    
    if (empty($username) || empty($alias) || empty($password)) {
        $errors[] ="Lütfen tüm alanları doldurun.";
    }

    if (empty($errors)) {
        $hashed_password = password_hash($password, PASSWORD_DEFAULT); 

        try{
            $stmt = $pdo -> prepare("INSERT INTO users (username, alias, password) VALUES (?, ?, ?)");
            $stmt -> execute([$username, $alias, $hashed_password]);

            header("Location: login.php"); 
            exit;
        }catch(PDOException $e){
            if ($e->getCode() == 23000) {
                $errors[] = "Bu kullanıcı adı zaten kullanılıyor.";
            } else {
                $errors[] = "Bir hata oluştu: " . $e->getMessage();
            }
        }
    }
}
?>

<!DOCTYPE html>
<html lang="tr">
<head>
    <meta charset="UTF-8">
    <title>Kayıt Ol</title>

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>

<body class="container mt-5" style = "background-color: #8A784E">
    <div class="d-flex justify-content-center align-items-center">
        <div class="mb-5" style="width: 100%; max-width: 500px;">

            <div class="text-center" style="color:azure">
            <h2>Kayıt Ol</h2>
            </div>

            <?php if (!empty($errors)): ?>
                <div class="alert alert-danger">
                    <ul>
                        <?php foreach ($errors as $error): ?>
                            <li><?= htmlspecialchars($error) ?></li>
                        <?php endforeach; ?>
                    </ul>
                </div>
            <?php endif; ?>

        </div>
    </div>

    <form method="post" class="mt-3">
        <div class="d-flex justify-content-center align-items-center" style="min-height: 50vh;">
            <div class="card p-4 shadow" style="background-color: #E7EFC7; width: 100%; max-width: 500px;">
                
                <div class="mb-3" style="max-width:500px">
                    <label for="username" class="form-label">Kullanıcı Adı</label>
                    <input type="text" name="username" id="username" class="form-control" required>
                </div>
                <div class="mb-3" style="max-width:500px">
                    <label for="alias" class="form-label">Görünecek Ad (Alias)</label>
                    <input type="text" name="alias" id="alias" class="form-control" required>
                </div>
            
                <div class="mb-3" style="max-width:500px">
                    <label for="password" class="form-label">Şifre</label>
                    <input type="password" name="password" id="password" class="form-control" required>
                </div>
        
            <button class="btn btn-outline-light" style = "background-color: #AEC8A4">Kayıt Ol</button>
            <a href="/kitap_alintilari/login.php" class="btn btn-link text-muted">Zaten üye misin? Giriş yap</a>
        </div>
    </div>

            
    </form>
</body>
</html>
