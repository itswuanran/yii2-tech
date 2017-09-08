<?php
use yii\web\JsExpression;

?>
<?= \yii2fullcalendar\yii2fullcalendar::widget([
    'events' => $events,
    'clientOptions' => [
        'timeFormat' => 'H(:mm)',
        'titleFormat' => 'MMMM YYYY',
        'columnFormat' => 'ddd',
        'customButtons' => [
            'myCb' => [
                'text' => 'custom!!',
                'click' => new JsExpression("function() {
                alert('clicked the custom button!');
            }")
            ],
        ],
        // 显示周数
        'weekNumbers' => true,
        'weekends' => true,
        'weekNumbersWithinDays' => true,
        'businessHours' => [
            'dow' => [1, 2, 3, 4, 5],
            'start' => '10:00',
            'end' => '18:00'
        ],
        'hiddenDays' => [] // hide Mondays, Wednesdays, and Fridays

    ],
    'header' => [
        'left' => 'prev,next,today,prevYear,nextYear,myCb',
        'center' => 'title',
        'right' => 'month,basicWeek,basicDay,agendaWeek,agendaDay,listYear,listMonth,listWeek,listDay'
    ]
]);