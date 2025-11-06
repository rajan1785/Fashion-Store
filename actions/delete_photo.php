<?php
$photo = 'image.png';
        if ($photo && file_exists('../assets/product-photo/' . $photo)) {
            $result = unlink('../assets/product-photo/' . $photo);
            echo 'deleted';
            echo $result;
        } else {
            echo 'failed';
        }
        ?>