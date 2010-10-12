<?php

namespace Model\Repository\Base;

/**
 * Base class of repository of Person document.
 */
abstract class Person extends \Mondongo\Repository
{


    protected $documentClass = 'Model\\Document\\Person';


    protected $connectionName = NULL;


    protected $collectionName = 'person';
}