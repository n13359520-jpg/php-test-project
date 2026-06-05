<?php
$host = 'db';
$dbname = 'todo';
$user = 'todo_user';
$pass = 'todo_pass';

try {
    $pdo = new PDO("mysql:host=$host;dbname=$dbname;charset=utf8mb4", $user, $pass, [
        PDO::MYSQL_ATTR_INIT_COMMAND => "SET NAMES utf8mb4"
    ]);
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch (PDOException $e) {
    die("Ошибка подключения: " . $e->getMessage());
}

// Добавление задачи
if ($_SERVER['REQUEST_METHOD'] === 'POST' && !empty($_POST['title'])) {
    $stmt = $pdo->prepare("INSERT INTO tasks (title) VALUES (:title)");
    $stmt->execute(['title' => $_POST['title']]);
    header("Location: /");
    exit;
}

// Получение задач
$tasks = $pdo->query("SELECT * FROM tasks ORDER BY created_at DESC")->fetchAll(PDO::FETCH_ASSOC);
?>
<!DOCTYPE html>
<html lang="ru">
<head>
    <meta charset="UTF-8">
    <title>TODO List</title>
    <style>
        body { font-family: Arial; max-width: 600px; margin: 50px auto; }
        .task { padding: 10px; margin: 5px 0; background: #f5f5f5; border-radius: 5px; }
        .time { color: #888; font-size: 0.9em; }
        form { margin-bottom: 30px; }
        input[type="text"] { padding: 8px; width: 70%; border: 1px solid #ddd; border-radius: 4px; }
        button { padding: 8px 20px; background: #4CAF50; color: white; border: none; border-radius: 4px; cursor: pointer; }
        h1 { color: #333; }
        .success { color: #4CAF50; font-size: 0.9em; margin-top: 20px; }
    </style>
</head>
<body>
    <h1>📝 TODO List</h1>
    
    <form method="POST">
        <input type="text" name="title" placeholder="Новая задача..." required>
        <button type="submit">Добавить</button>
    </form>

    <?php foreach ($tasks as $task): ?>
        <div class="task">
            <?= htmlspecialchars($task['title']) ?>
            <div class="time"><?= $task['created_at'] ?></div>
        </div>
    <?php endforeach; ?>

    <div class="success">Deployment successful! PHP <?= phpversion() ?></div>
</body>
</html>
