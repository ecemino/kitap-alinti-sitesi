<?php
require 'db.php';
session_start();

if(!isset($_SESSION['user_id']) || !isset($_GET['id'])){
    header("Location: login.php");
    exit;
}

$user_id = $_SESSION['user_id'];
$quote_id = $_GET['id'];


$stmt = $pdo -> prepare("SELECT * FROM quotes WHERE id = ? AND user_id = ?"); 
$stmt -> execute([$quote_id, $user_id]);
$quote = $stmt->fetch(PDO::FETCH_ASSOC); 

if(!$quote){
    echo "Alıntı bulunamadı.";
    exit;
}

$errors = [];

if($_SERVER['REQUEST_METHOD'] === 'POST'){
    $book_title= trim($_POST['book_title']);
    $author = trim($_POST['author']);
    $quote_text = trim($_POST['quote']);  
    $comment = trim($_POST['comment']);

    if(empty($book_title) || empty($author) || empty($quote_text)){
        $errors[] = "Kitap adı, Yazar ve Alıntı alanları boş bırakılamaz."; 

    }else{
        $stmt=$pdo->prepare("UPDATE quotes SET book_title = ?, author = ?, quote = ?, comment = ? WHERE id = ? AND user_id = ?");
        $stmt->execute([$book_title, $author, $quote_text, $comment, $quote_id, $user_id]);

        header("Location: dashboard.php");
        exit;
    }
}
?>

<!DOCTYPE html>
<html lang="tr">
<head>
    <meta charset="UTF-8">
    <title>Alıntıyı Düzenle</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet" />
</head>

<body class="container mt-5" style = "background-color: #8A784E">

    <div class="d-flex justify-content-center align-items-center" style = "color:azure">
    <h2>Alıntıyı Düzenle</h2>
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

    <form method="post">
        <div class="mb-4">
            <label for="book_title" class="form-label" style="color:azure">Kitap Adı</label>
            <input type="text" name="book_title" id="book_title" class="form-control" style="background-color: #EBE5C2" value="<?= htmlspecialchars($quote['book_title']) ?>" required>
        </div>

        <div class="mb-4">
            <label for="author" class="form-label" style="color:azure">Yazar</label>
            <input type="text" name="author" id="author" class="form-control" style="background-color: #EBE5C2" value="<?= htmlspecialchars($quote['author']) ?>" required>
        </div>

        <div class="mb-4">
            <label for="quote" class="form-label" style="color:azure">Alıntı</label>
            <textarea name="quote" id="quote" class="form-control" style="background-color: #EBE5C2" rows="4" required><?= htmlspecialchars($quote['quote']) ?></textarea>
        </div>

        <div class="mb-4">
            <label for="comment" class="form-label" style="color:azure">Yorum (İsteğe bağlı)</label>
            <textarea name="comment" id="comment" class="form-control" style="background-color: #EBE5C2" rows="2"><?= htmlspecialchars($quote['comment']) ?></textarea>
        </div>

        <button class="btn btn-outline-dark" style="background-color:rgb(202, 215, 151)">Kaydet</button>
        <a href="dashboard.php" class="btn btn-light"style= "background-color:rgb(87, 75, 63); color:beige">İptal</a>

    </form>
</body>
</html>
