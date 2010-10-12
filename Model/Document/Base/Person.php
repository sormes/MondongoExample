<?php

namespace Model\Document\Base;

/**
 * Base class of Person document.
 */
abstract class Person extends \Mondongo\Document\Document
{


    protected $data = array (
  'fields' => 
  array (
    'name' => NULL,
    'surname' => NULL,
  ),
);


    protected $fieldsModified = array (
);


    static protected $map = array (
  'name' => 'Name',
  'surname' => 'Surname',
);

    /**
     * Returns the Mondongo of the document.
     *
     * @return Mondongo\Mondongo The Mondongo of the document.
     */
    public function getMondongo()
    {
        return \Mondongo\Container::getForDocumentClass('Model\Document\Person');
    }

    /**
     * Returns the repository of the document.
     *
     * @return Mondongo\Repository The repository of the document.
     */
    public function getRepository()
    {
        return $this->getMondongo()->getRepository('Model\Document\Person');
    }

    /**
     * Returns the fields map.
     *
     * @return array The fields map.
     */
    static public function getMap()
    {
        return self::$map;
    }

    /**
     * Set the data in the document (hydrate).
     *
     * @return void
     */
    public function setDocumentData($data)
    {
        $this->id = $data['_id'];

        if (isset($data['name'])) {
            $this->data['fields']['name'] = (string) $data['name'];
        }
        if (isset($data['surname'])) {
            $this->data['fields']['surname'] = (string) $data['surname'];
        }


        
    }

    /**
     * Convert an array of fields with data to Mongo values.
     *
     * @param array $fields An array of fields with data.
     *
     * @return array The fields with data in Mongo values.
     */
    public function fieldsToMongo($fields)
    {
        if (isset($fields['name'])) {
            $fields['name'] = (string) $fields['name'];
        }
        if (isset($fields['surname'])) {
            $fields['surname'] = (string) $fields['surname'];
        }


        return $fields;
    }

    /**
     * Set the "name" field.
     *
     * @param mixed $value The value.
     *
     * @return void
     */
    public function setName($value)
    {
        if (!array_key_exists('name', $this->fieldsModified)) {
            $this->fieldsModified['name'] = $this->data['fields']['name'];
        } elseif ($value === $this->fieldsModified['name']) {
            unset($this->fieldsModified['name']);
        }

        $this->data['fields']['name'] = $value;
    }

    /**
     * Returns the "name" field.
     *
     * @return mixed The name field.
     */
    public function getName()
    {
        return $this->data['fields']['name'];
    }

    /**
     * Set the "surname" field.
     *
     * @param mixed $value The value.
     *
     * @return void
     */
    public function setSurname($value)
    {
        if (!array_key_exists('surname', $this->fieldsModified)) {
            $this->fieldsModified['surname'] = $this->data['fields']['surname'];
        } elseif ($value === $this->fieldsModified['surname']) {
            unset($this->fieldsModified['surname']);
        }

        $this->data['fields']['surname'] = $value;
    }

    /**
     * Returns the "surname" field.
     *
     * @return mixed The surname field.
     */
    public function getSurname()
    {
        return $this->data['fields']['surname'];
    }


    public function preInsertExtensions()
    {

    }


    public function postInsertExtensions()
    {

    }


    public function preUpdateExtensions()
    {

    }


    public function postUpdateExtensions()
    {

    }


    public function preSaveExtensions()
    {

    }


    public function postSaveExtensions()
    {

    }


    public function preDeleteExtensions()
    {

    }


    public function postDeleteExtensions()
    {

    }
}