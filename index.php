<?php
// Налаштування відображення помилок для розробки
error_reporting(E_ALL);
ini_set('display_errors', '1');

// 1. Оголошення масиву даних (Каталог рослин - Варіант 18)
$plants = [
    [
        'name' => 'Монстера Деліціоза',
        'wateringIntervalDays' => 7,
        'daysSinceWatered' => 8
    ],
    [
        'name' => 'Фікус Еластіка',
        'wateringIntervalDays' => 5,
        'daysSinceWatered' => 3
    ],
    [
        'name' => 'Заміокулькас',
        'wateringIntervalDays' => 14,
        'daysSinceWatered' => 14
    ],
    [
        'name' => 'Сукулент Ечеверія',
        'wateringIntervalDays' => 10,
        'daysSinceWatered' => 2
    ],
    [
        'name' => 'Спатіфілум',
        'wateringIntervalDays' => 4,
        'daysSinceWatered' => 5
    ],
    [
        'name' => 'Сансевієрія',
        'wateringIntervalDays' => 12,
        'daysSinceWatered' => 6
    ],
];

// 2. Типізована функція форматування короткого опису рослини
function formatPlant(array $plant): string 
{
    return "<strong>{$plant['name']}</strong> • інтервал поливу: кожні {$plant['wateringIntervalDays']} дн.";
}

// 3. Обчислення агрегатного показника
$needsWaterCount = 0;
foreach ($plants as $plant) {
    if ($plant['daysSinceWatered'] >= $plant['wateringIntervalDays']) {
        $needsWaterCount++;
    }
}
?>
<!DOCTYPE html>
<html lang="uk">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>FloraCare — Dark Mode</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>

    <div class="app-container">
        <!-- Шапка -->
        <header class="header">
            <div class="header-icon">
                <img src="alocasia.png" alt="FloraCare" class="header-icon-img">
            </div>
            <div>
                <h1>FloraCare</h1>
                <p class="subtitle">Каталог догляду за домашніми рослинами</p>
            </div>
        </header>

        <!-- Блок підсумку (Агрегатний показник) -->
        <div class="summary-card">
            <div class="summary-info">
                <span class="summary-label">Сьогодні потребують поливу</span>
                <div class="summary-value">
                    <span><?= $needsWaterCount ?></span>
                    <small>із <?= count($plants) ?> рослин</small>
                </div>
            </div>
            <div class="summary-status-icon">
                <?= $needsWaterCount > 0 ? '<img src="watering-can.png" alt="Полив" class="summary-icon-img">' : '✨' ?>
            </div>
        </div>

        <!-- Список рослин -->
        <div class="plant-grid">
            <?php foreach ($plants as $plant): ?>
                <?php 
                    // Умовна логіка за варіантом 18
                    $needsWater = $plant['daysSinceWatered'] >= $plant['wateringIntervalDays'];
                    $statusText = $needsWater ? 'Потребує поливу' : 'Зволожена';
                    $badgeClass = $needsWater ? 'badge-alert' : 'badge-ok';
                    $cardClass = $needsWater ? 'card-alert' : '';
                ?>
                <div class="plant-card <?= $cardClass ?>">
                    <div class="plant-card-header">
                        <div class="plant-avatar">
                            <img src="tropical-leaves.png" alt="FloraCare" class="plant-avatar-img">
                        </div>
                        <span class="badge <?= $badgeClass ?>">
                            <?= $statusText ?>
                        </span>
                    </div>

                    <div class="plant-card-body">
                        <h3 class="plant-name"><?= $plant['name'] ?></h3>
                        <p class="plant-desc"><?= formatPlant($plant) ?></p>
                    </div>

                    <div class="plant-card-footer">
                        <div class="metric">
                            <span class="metric-label">Минуло днів</span>
                            <span class="metric-value"><?= $plant['daysSinceWatered'] ?></span>
                        </div>
                        <div class="metric">
                            <span class="metric-label">Норма (днів)</span>
                            <span class="metric-value"><?= $plant['wateringIntervalDays'] ?></span>
                        </div>
                    </div>
                </div>
            <?php endforeach; ?>
        </div>
    </div>

</body>
</html>