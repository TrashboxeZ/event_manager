<?php
header('Content-Type: application/json');
require '../connection.php';

$title = filter_input(INPUT_POST, 'title');
$date = filter_input(INPUT_POST, 'date');
$event = filter_input(INPUT_POST,'event');
$description = filter_input(INPUT_POST, 'desc');

$title = mysqli_escape_string($link, $title);
$description = mysqli_escape_string($link, $description);
$date = mysqli_escape_string($link, $date);
$event = mysqli_escape_string($link, $event);

$id = filter_input(INPUT_POST, 'id');
$id = mysqli_escape_string($link, $id);
echo $date;
$timestamp = strtotime($date);
$date =  date('Y-m-d',$timestamp);
echo $date;


if(!empty($title) && !empty($description)){
    
    # Обновление БД
    if(!empty($id)){
         if($query = mysqli_query($link, "UPDATE events SET title = '{$title}', icon = {$event}, description = '{$description}', date = '{$date}' WHERE id = {$id}")){
            echo json_encode([[ "id" => "{$id}", "title" => "{$title}", "description" => "{$description}", "icon" => "{$event}","date"=>"{$date}"]]);
        }
    
    }else{
    # Вставка в БД
        if($insQuery = mysqli_query($link, "INSERT INTO events VALUES (LAST_INSERT_ID(), '{$title}',{$event}, '{$description}', '{$date}')")){
            if($selQuery = mysqli_query($link, "SELECT id, title, description, icon, date FROM events WHERE id = LAST_INSERT_ID()")){

            $events = [];  

            while ($row = mysqli_fetch_assoc($selQuery)){
                $events[] = $row;
            };

            echo json_encode($events);
            }

        };

    };
}
else{
    echo json_encode([ "status" => "error", "msg" => "fill the field!" ]);
}
