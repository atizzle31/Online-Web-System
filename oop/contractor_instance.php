

<?php

use oop\contractor;

require_once "contractor.php";
$contract = new contractor('name','last','1234','123 street');

$contract->setEmail('email@email.com');
$contract->setSpecialty('0123456789');

echo($contract);
?>

<pre>
    <?php var_dump($contract); ?>
</pre>
