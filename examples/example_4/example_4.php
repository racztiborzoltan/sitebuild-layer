<?php
use Z\SiteBuildLayer\MustacheFileSiteBuildLayer;

/**
 * Example
 *
 * Simple plain PHP based sitebuild layer
 */

require_once '../../vendor/autoload.php';

// sitebuild object initialization:
$sitebuild = new MustacheFileSiteBuildLayer();
$sitebuild->setMustacheFilePath(__DIR__ . '/templates/template.mustache');
$sitebuild->setVariable('hello_name', 'Bob');

// set global variable:
$sitebuild->setVariable('global_hello_name', 'Global Garry', true);

// set some translation as global sitebuild variable:
$language = $_GET['language'] ?? 'en';
$translations = [
    // english translations:
    'en' => [
        'Title' => 'Title',
        'Director' => 'Director',
        'Year' => 'Year',
    ],
    // hungarian translations:
    'hu' => [
        'Title' => 'Cím',
        'Director' => 'Rendező',
        'Year' => 'Év',
    ],
];
if (!isset($translations[$language])) {
    $language = 'en';
}
$sitebuild->setVariable('translations', $translations[$language], true);

// small content sitebuild layer:
$content = new MustacheFileSiteBuildLayer();
$content->setMustacheFilePath(__DIR__ . '/templates/content.mustache');
$content->setVariable('table_data', [
    [
        'title' => 'Rear Window',
        'director' => 'Alfred Hitchcock',
        'year' => 1954
    ],
    [
        'title' => 'Full Metal Jacket',
        'director' => 'Stanley Kubrick',
        'year' => 1987
    ],
    [
        'title' => 'Mean Streets',
        'director' => 'Martin Scorsese',
        'year' => 1973
    ],
]);

// rewrite global variable from other sitebuild layer instance:
$content->setVariable('global_hello_name', 'Global Gumby', true);


// attach content to main layer:
$sitebuild->setVariable('content', $content);

// rendering:
echo $sitebuild->render();
