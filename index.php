<?php

$tasks = [
    'побриться',
    'позавтракать',
    'прогреть авто',
    'зарядить смартфон',
    'проверить почту',
];

$tasks_with_priority = [
    [
        'title' =>'побриться',
        'priority' => 2
    ],
    [
        'title' =>'позавтракать',
        'priority' => 3
    ],
    [
        'title' =>'прогреть авто',
        'priority' => 2
    ],
    [
        'title' =>'зарядить смартфон',
        'priority' => 3
    ],
    [
        'title' =>'проверить почту',
        'priority' => 1
    ],
];

?>
<ul>
    <?php foreach ($tasks as $task):?>
        <li><?=$task?></li>
    <?php endforeach;?>
</ul>

<table>
    <tr><th>Задача</th><th>Приоритет</th></tr>
    <?php foreach ($tasks_with_priority as $task):?>
    <tr>
        <td><?=$task['title']?></td>
        <?php
        $priority_map = [
            1 => 'Низкий',
            2 => 'Средний',
            3 => 'Высокий'
        ];

        $priority = $priority_map[$task['priority']] ?? 'Без приоритета';
        ?>
        <td><?=$priority?></td>
    </tr>
    <?php endforeach;?>
</table>
