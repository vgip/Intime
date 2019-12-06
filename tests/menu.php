<?php

foreach ($partAvailable AS $part => $name) {
    $menuPart[] = '<a href="index.php?part='.$part.'">'.$name.'</a>';
}

echo '<div style="padding-bottom: 20px;">'.join(' ', $menuPart).'</div>';
