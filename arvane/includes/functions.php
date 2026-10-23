<?php
function calculatePrice($note_type, $strength) {
    $base_price = 50;
    
    switch($note_type) {
        case 'floral': $note_price = 30; break;
        case 'woody': $note_price = 40; break;
        case 'fruity': $note_price = 25; break;
        case 'oriental': $note_price = 45; break;
        default: $note_price = 30;
    }
    
    switch($strength) {
        case 'light': $strength_price = 0; break;
        case 'medium': $strength_price = 15; break;
        case 'strong': $strength_price = 30; break;
        default: $strength_price = 15;
    }
    
    return $base_price + $note_price + $strength_price;
}

function sanitize_input($data) {
    $data = trim($data);
    $data = stripslashes($data);
    $data = htmlspecialchars($data);
    return $data;
}
?>