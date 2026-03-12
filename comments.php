<?php
function getComments(string $filename): array
{
    if (!file_exists($filename)){
        return [];
    }
    return json_decode(file_get_contents($filename), true);
}

$filename = 'comments.json';
$allComments = getComments($filename);

$delComment = $_GET['delete'] ?? '';
if (!empty($delComment)){
    foreach ($allComments as $key => $comment){
        if ($comment['id'] === $delComment){
            unset($allComments[$key]);
            $allComments = array_values($allComments); // сброс индексов
            break;
        }
    }
    file_put_contents($filename, json_encode($allComments, JSON_UNESCAPED_UNICODE | JSON_PRETTY_PRINT));
    header('Location: comments.php');
    exit;
}

$name = $content = '';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $name = trim($_POST['name'] ?? '');
    $content = trim($_POST['content'] ?? '');

    if (empty($name) || empty($content)) {
        $errors['empty'] = 'Необходимо заполнить все поля';
    }

    if (empty($errors)) {
        $id = uniqid();
        $date = date("d.m.Y H:i");
        $comment = [
          'id' => $id,
          'name' => $name,
          'content' => $content,
          'date' => $date
        ];

        array_unshift($allComments, $comment);
        file_put_contents($filename, json_encode($allComments, JSON_UNESCAPED_UNICODE | JSON_PRETTY_PRINT));
        header('Location: comments.php');
        exit;
    }
}


?>
<?php if (isset($errors['empty'])): ?>
    <span style="color: red;"><?= $errors['empty'] ?></span>
<?php endif; ?>

<!-- Форма -->
<form action="" method="post">
    <div>
        <label>Имя:</label>
        <input type="text" name="name" value="<?= htmlspecialchars($name ?? '') ?>">
    </div>
    <div>
        <label>Комментарий:</label>
        <textarea name="content" ><?= htmlspecialchars($content ?? '') ?></textarea>
    </div>

    <button type="submit">Отправить</button>
</form>

<h3>=== Комментарии (<?= count($allComments) ?>) ===</h3>

<?php foreach ($allComments as $comment): ?>
<div style="margin-bottom: 40px">
    <p> <?= $comment['name']?> (<?= $comment['date']?>)</p>
    <p> <?= $comment['content']?> </p>
    <a href="?delete=<?= $comment['id']?>">Удалить</a>
</div>
<?php endforeach; ?>

