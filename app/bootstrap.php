<?php
# 定義したクラスの読み込みを行う（オートロード機能を実装）

require_once __DIR__ . '/core/Autoloader.php';

$autoloader = new Autoloader(__DIR__);

$autoloader->registerDir('/Core');
$autoloader->registerDir('/Models');
$autoloader->registerDir('/Controllers');
$autoloader->registerDir('/Services');

$autoloader->autoload();