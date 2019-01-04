<?php
use Z\SiteBuildLayer\PhpFileSiteBuildLayer;
use Z\SiteBuildLayer\SiteBuild;
use Z\SiteBuildLayer\AbstractSiteBuildLayer;
use Z\SiteBuildLayer\MustacheFileSiteBuildLayer;

/**
 * Example
 *
 * sitebuild with different page types
 */

require_once '../../vendor/autoload.php';

$page_type = $_GET['page_type'] ?? 'index';

// sitebuild object initialization:
$sitebuild = new SiteBuild();

$sitebuild->setValidPageTypes([
    'index',
    'contact',
]);
$sitebuild->setPageType($page_type);
$sitebuild->setSiteBuild('index', getIndexSiteBuild());
$sitebuild->setSiteBuild('contact', getContactSiteBuild());

// rendering:
echo $sitebuild->render();
exit();


function factorySiteBuild()
{
    // sitebuild object initialization:
    $index_sitebuild = new PhpFileSiteBuildLayer();
    $index_sitebuild->setPhpFilePath(__DIR__ . '/templates/template.php');
    $index_sitebuild->setVariable('hello_name', 'Bob');

    // set global variable:
    $index_sitebuild->setVariable('global_hello_name', 'Global Garry', true);

    return $index_sitebuild;
}

function getIndexSiteBuild(): AbstractSiteBuildLayer
{
    $index_sitebuild = factorySiteBuild();

    // small content sitebuild layer:
    $index_content = new PhpFileSiteBuildLayer();
    $index_content->setPhpFilePath(__DIR__ . '/templates/content_index.php');
    $index_content->setVariable('table_data', [
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
    $index_content->setVariable('global_hello_name', 'Global Gumby', true);

    // attach content to main layer:
    $index_sitebuild->setVariable('content', $index_content);

    return $index_sitebuild;
}

function getContactSiteBuild(): AbstractSiteBuildLayer
{
    $index_sitebuild = factorySiteBuild();

    // contact content sitebuild layer:
    $contact_content = new MustacheFileSiteBuildLayer();
    $contact_content->setMustacheFilePath(__DIR__ . '/templates/content_contact.mustache');
    $contact_content->setVariable('name', 'John Doe');
    $contact_content->setVariable('phone', '+1-541-754-3010');
    $contact_content->setVariable('email', 'email@example.com');

    // rewrite global variable from other sitebuild layer instance:
    $contact_content->setVariable('global_hello_name', 'Global Gumby', true);

    // attach content to main layer:
    $index_sitebuild->setVariable('content', $contact_content);

    return $index_sitebuild;
}

