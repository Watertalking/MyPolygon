<?php
require_once "index.php"; // предполагаю, что там исправленная validateEmail()

$lang = $_GET["lang"] ?? '';
$greet = match($lang) {
    'en' => "Hello!",
    'fr' => "Bonjour!",
    default => "Добро пожаловать!"
};

$errors = [];
$name = $email = $age = ''; // объявляем переменные для хранения введённых данных

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Получаем данные без экранирования
    $name = trim($_POST['name'] ?? '');
    $email = trim($_POST['email'] ?? '');
    $age = $_POST['age'] ?? '';

    // Валидация
    if (empty($name)) {
        $errors['name'] = 'Поле имя не заполнено';
    }

    if (!validateEmail($email)) {
        $errors['email'] = 'Ошибка в заполнении поля email';
    }

    if (!is_numeric($age) || $age < 1 || $age > 120) {
        $errors['age'] = 'Поле age должно быть числом от 1 до 120';
    } else {
        $age = (int)$age;
    }

    // Если нет ошибок — показываем успех
    if (empty($errors)) {
        echo "<h2>$greet, $name!</h2>";
        echo "<p>Ваш email: $email</p>";
        echo "<p>Вам $age лет</p>";
        // Можно очистить поля формы после успеха
        $name = $email = $age = '';
    }
}
?>


<!-- Форма -->
<form action="" method="post">
    <div>
        <label>Имя:</label>
        <input type="text" name="name"
               value="<?= htmlspecialchars($name) ?>">
        <?php if (isset($errors['name'])): ?>
            <span style="color: red;"><?= $errors['name'] ?></span>
        <?php endif; ?>
    </div>

    <div>
        <label>Email:</label>
        <input type="email" name="email"
               value="<?= htmlspecialchars($email) ?>">
        <?php if (isset($errors['email'])): ?>
            <span style="color: red;"><?= $errors['email'] ?></span>
        <?php endif; ?>
    </div>

    <div>
        <label>Возраст:</label>
        <input type="text" name="age"
               value="<?= htmlspecialchars($age) ?>">
        <?php if (isset($errors['age'])): ?>
            <span style="color: red;"><?= $errors['age'] ?></span>
        <?php endif; ?>
    </div>

    <button type="submit">Отправить</button>
</form>

<a href="?lang=ru">Приветствие на русском</a>
<a href="?lang=en">Приветствие на английском</a>
<a href="?lang=fr">Приветствие на французском</a>