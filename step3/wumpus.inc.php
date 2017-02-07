<?php

/**
 * Create an array that represents the cave
 * @returns Array
 */
function cave_array() {
    $cave = array(1 => array(5, 6, 2),
        2 => array(1, 8, 3),
        3 => array(2, 10, 4),
        4 => array(3, 12, 5),
        5 => array(4, 14, 1),
        6 => array(1, 15, 7),
        7 => array(6, 8, 16),
        8 => array(2, 7, 9),
        9 => array(8, 17, 10),
        10 => array(3, 9, 11),
        11 => array(10, 18, 12),
        12 => array(4, 11, 13),
        13 => array(12, 19, 14),
        14 => array(13, 5, 15),
        15 => array(6, 14, 20),
        16 => array(7, 17, 20),
        17 => array(9, 16, 18),
        18 => array(11, 17, 19),
        19 => array(13, 18, 20),
        20 => array(19, 15, 16));
    return $cave;
}



?>