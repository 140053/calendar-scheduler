<?php
require_once '_room.php';

  $stmt = $db->prepare('SELECT * FROM events WHERE NOT ((end <= :start) OR (start >= :end)) and room = "AVR"');
  $stmt->bindParam(':start', $_GET['start']);
  $stmt->bindParam(':end', $_GET['end']);
  $stmt->execute();
  $result = $stmt->fetchAll();
  class Event {}
  $events = array();
  foreach($result as $row) {
    $e = new Event();
    $e->id = $row['id'];
    $e->text = $row['name'];
    $e->start = $row['start'];
    $e->end = $row['end'];
    $e->barColor = $row['color'];
    $e->status = $row['status'];
    $e->rtype =$row['rtype'];
    $e->text1 = $row['persona'];
    $e->room = $row['room'];    
    $events[] = $e;
  }

header('Content-Type: application/json');
echo json_encode($events);
