<?php

function dd(...$terms)
{
    echo '<pre>';
    foreach ($terms as $term) {
        var_dump($term);
    }
    echo '</pre>';
    die;
}
