<?php

require_once $_SERVER['DOCUMENT_ROOT'] . '/vendor/autoload.php';


/********** СТИЛИ ************/

use ScssPhp\ScssPhp\Compiler;
use ScssPhp\ScssPhp\OutputStyle;

$scssFile = $_SERVER['DOCUMENT_ROOT'] . "/assets/styles.scss";
$scss = new Compiler();
$scss->addImportPath(dirname($scssFile));
$scss->setOutputStyle(OutputStyle::COMPRESSED);

$scss->setSourceMap(Compiler::SOURCE_MAP_INLINE);

$scss->setSourceMapOptions([
	'sourceMapWriteTo'  => $_SERVER['DOCUMENT_ROOT'] . "/assets/styles.map",
	'sourceMapURL'      => "/assets/styles.map",
	'sourceMapFilename' => 'styles.scss',
	'sourceMapBasepath' => $_SERVER['DOCUMENT_ROOT'],
	'sourceRoot'        => '/',
]);

$scssContent = file_get_contents($scssFile);
$style = $scss->compileString($scssContent, $scssFile);

file_put_contents($_SERVER['DOCUMENT_ROOT'] . "/assets/styles.min.css", $style->getCss());

$stylesArray = [];
$stylesArray[] = "/assets/fonts.css";
$stylesArray[] = "/assets/styles.min.css";


/********** СКРИПТЫ ************/

$scriptsArray = [];
$scriptsArray[] = "/vendor/components/jquery/jquery.min.js";
$scriptsArray[] = "/assets/scripts.js";


/********** ШАБЛОН ************/

$loader = new \Twig\Loader\FilesystemLoader(__DIR__ . '/templates');
$twig = new \Twig\Environment($loader, [
    'cache' => __DIR__ . '/var/cache',
	'debug' => true,
]);

echo $twig->render('index.html.twig', ['stylesArray' => $stylesArray, 'scriptsArray' => $scriptsArray, ]);
