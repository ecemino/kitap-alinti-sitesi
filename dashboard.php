<?php
require 'db.php';
session_start();

if (!isset($_SESSION['user_id'])) {
    header("Location: login.php");
    exit;
}

$user_id = $_SESSION['user_id'];

$stmt = $pdo->prepare("SELECT * FROM quotes WHERE user_id = ? ORDER BY created_at DESC");
$stmt->execute([$user_id]);
$quotes = $stmt->fetchAll(PDO::FETCH_ASSOC);
?>

<!DOCTYPE html>
<html lang="tr">
<head>
    <meta charset="UTF-8" />
    <title>Alıntılarım</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet"/>
    
</head>
<body class="container mt-5" style = "background-color: #8A784E">

    <div class="text-center" style = "color:beige">
        <h2>Hoş geldin, <?= htmlspecialchars($_SESSION['alias']) ?>!</h2>
    </div>

    <a href="add_quote.php" class="btn btn-outline-dark mb-3 mt-3" style = "background-color: #B9B28A">Yeni Alıntı Ekle</a>
    <a href="logout.php" class="btn btn-outline-light mb-3 mt-3 float-end" style = "background-color:rgb(132, 41, 41)">Çıkış Yap</a>

    <?php if (count($quotes) === 0): ?>
        <div class="alert alert-info" style="background-color:rgb(190, 216, 227)">Henüz hiç alıntı eklemediniz.</div>
    <?php else: ?>

        <?php foreach ($quotes as $quote): ?>
            <div class="card mt-4" style = "background-color: #EBE5C2">
                <div class="card-body">

                    <h5 class="card-title"><?= htmlspecialchars($quote['book_title']) ?></h5>

                    <h6 class="card-subtitle mb-2 text-muted">Yazar: <?= htmlspecialchars($quote['author']) ?></h6>

                    <p class="card-text"><strong>Alıntı:</strong><br><em>"<?= nl2br(htmlspecialchars($quote['quote'])) ?>"</em></p>

                    <?php if (!empty($quote['comment'])): ?>
                        <p class="card-text"><strong>Yorum:</strong> <?= nl2br(htmlspecialchars($quote['comment'])) ?></p>
                    <?php endif; ?>

                    <small class="text-muted">Eklenme tarihi: <?= $quote['created_at'] ?></small>

                    <a href="edit_quote.php?id=<?= $quote['id'] ?>" class="btn btn-sm btn-light" style = "background-color:rgb(224, 187, 102)">Düzenle</a>
                    <a href="delete_quote.php?id=<?= $quote['id'] ?>" class="btn btn-close" aria-label="Close" onclick="return confirm('Bu alıntıyı silmek istediğinize emin misiniz?')"></a>

                </div>
            </div>
        <?php endforeach; ?>
    <?php endif; ?>
</body>
</html>
