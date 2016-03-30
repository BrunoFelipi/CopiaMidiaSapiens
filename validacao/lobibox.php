<?php

session_start();

$script_js = "";

if (isset($_SESSION['status'])) {
    $type = $_SESSION['status']['type'];
    $text = $_SESSION['status']['text'];
    $script_js = "Lobibox.notify('$type', {
                        size: 'mini',
                        img: 'resources/sa.png',
                        msg: '$text',
                        delay: false,
                        sound: false
                    });";
    unset($_SESSION['status']);
}