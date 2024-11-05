<?php

$sections = [];
$currentSection = null;

function startSection($name)
{
    global $sections, $currentSection;

    $currentSection = $name;
    ob_start();
}

function endSection()
{
    global $sections, $currentSection;

    $sections[$currentSection] = ob_get_clean();
    $currentSection = null;
}

function yieldSection($name)
{
    global $sections;

    return $sections[$name] ?? '';
}

function view($view, $data = [])
{
    extract($data);
    ob_start();
    require __DIR__ . "/../resources/views/{$view}.php";
    return ob_get_clean();
}

function extend($layout)
{
    global $sections;

    include __DIR__ . "/../../resources/views/{$layout}.php";
}
