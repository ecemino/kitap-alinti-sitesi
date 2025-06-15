<?php
require 'db.php';
session_start();

$errors = [];

$book_title = '';
$author = '';
$quote = '';
$comment = '';

if($_SERVER['REQUEST_METHOD'] === 'POST'){
    $book_title = trim($_POST['book_title'] ?? ''); 
    $author = trim($_POST['author']?? '');
    $quote = trim($_POST['quote']?? '');  
    $comment = trim($_POST['comment'] ??'');

    if(empty($book_title) || empty($author) || empty($quote)){
        $errors[] = "Kitap adı, Yazar ve Alıntı alanları boş bırakılamaz.";
    }else{
        $stmt = $pdo->prepare("INSERT INTO quotes (book_title, user_id, quote, comment, author) VALUES (?,?,?,?,?)");
        
        $stmt->execute([
            $book_title,
            $_SESSION['user_id'],
            $quote,
            $comment,
            $author
        ]);

        header("Location: dashboard.php");
        exit;
    }
}
?>

<!DOCTYPE html>
<html lang="tr">
<head>
    <meta charset="UTF-8" />
    <title>Alıntı Ekle</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet" />
</head>

<body class="container mt-5" style = "background-color: #8A784E">
    <div class="d-flex justify-content-center align-items-center" style = "color:azure">
    <h2>Yeni Alıntı Ekle</h2>
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

    <form method="post" class="mt-3">
        <div class="mb-4">
            <label for="book_title" class="form-label" style="color:azure">Kitap Adı</label>
            <input type="text" name="book_title" id="book_title" class="form-control" style="background-color: #EBE5C2" value="<?= htmlspecialchars($book_title) ?>" required />
        </div>

        <div class="mb-4">
            <label for="author" class="form-label" style="color:azure">Yazar</label>
            <input type="text" name="author" id="author" class="form-control" style="background-color: #EBE5C2" value="<?= htmlspecialchars($author) ?>" required />
        </div>

        <div class="mb-4">
            <label for="quote" class="form-label" style="color:azure">Alıntı</label>
            <textarea name="quote" id="quote" class="form-control" rows="4" style="background-color: #EBE5C2" required><?= htmlspecialchars($quote) ?></textarea>
        </div>
        
        <div class="mb-4">
            <label for="comment" class="form-label" style="color:azure">Yorum (isteğe bağlı)</label>
            <textarea name="comment" id="comment" class="form-control" style="background-color: #EBE5C2" rows="3"><?= htmlspecialchars($comment) ?></textarea>
        </div>
        
        <button class="btn btn-outline-dark" style="background-color:rgb(202, 215, 151)">Alıntıyı Kaydet</button>
        <a href="dashboard.php" class="btn btn-light"style= "background-color:rgb(87, 75, 63); color:beige">İptal</a>
    </form>
</body>
</html>
