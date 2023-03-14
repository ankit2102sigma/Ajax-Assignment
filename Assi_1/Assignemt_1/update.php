<?php
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $newText = $_POST['text'];
    echo $newText ; 
    }
