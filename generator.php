<?php


require(__DIR__.'/mondongo/lib/vendor/symfony/src/Symfony/Component/HttpFoundation/UniversalClassLoader.php');


use Symfony\Component\HttpFoundation\UniversalClassLoader;


$loader = new UniversalClassLoader();
$loader->registerNamespaces(array(
    'Mondongo'        => __DIR__.'/mondongo/lib',
    'Model'           => __DIR__,
));

$loader->register();


use \Mondongo\Mondator\Mondator;
use \Mondongo\Mondator\Output;


$classes = array(
    'Person' => array(
        'fields' => array(
            'name' => 'string',
            'surname' => 'string'
        )
    )
);

foreach ($classes as &$class) {
    $class['namespaces'] = array(
        'document'   => 'Model\Document',
        'repository' => 'Model\Repository',
    );
}


$mondator = new Mondator();
$mondator->setConfigClasses($classes);
$mondator->setExtensions(array(
    new Mondongo\Extension\CoreStart(),
    new Mondongo\Extension\CoreEnd(),
));

$mondator->setOutputs(array(
    'document'        => new Output(__DIR__.'/Model/Document'),
    'document_base'   => new Output(__DIR__.'/Model/Document/Base', true),
    'repository'      => new Output(__DIR__.'/Model/Repository'),
    'repository_base' => new Output(__DIR__.'/Model/Repository/Base', true),
));


$mondator->process();


