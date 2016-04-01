<?php

exec('wmic COMPUTERSYSTEM Get UserName', $user);
print_r($user[1]); 

echo '<br>' . getenv("REMOTE_ADDR");
