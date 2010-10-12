<?php

require(__DIR__.'/mondongo/lib/vendor/symfony/src/Symfony/Component/HttpFoundation/UniversalClassLoader.php');

use Symfony\Component\HttpFoundation\UniversalClassLoader;

$loader = new UniversalClassLoader();

$loader->registerNamespaces(array(
    'Mondongo'        => __DIR__.'/mondongo/lib',
    'Model'           => __DIR__,
));

$loader->register();
$mondongo = new Mondongo\Mondongo();
$mondongo->setConnection("connection_1", new Mondongo\Connection("localhost", "test"));
Mondongo\Container::setDefault($mondongo);
?>


<?php


/*************** ACTIONS **************/
$action = $_GET['action'];

switch($action)
{
  case "add":

    $Person = new Model\Document\Person();
    $Person->setName($_POST['name']);
    $Person->setSurname($_POST['surname']);
    $Person->save();
    
    break;

  case "delete":

    $repository = $mondongo->getRepository("Model\Repository\Person");

    $Person = $repository->findOneById(new MongoId($_GET['id']));

    $Person->delete();
    

    break;

  case "modify":
    
    $repository = $mondongo->getRepository("Model\Repository\Person");

    $Person = $repository->findOneById(new MongoId($_GET['id']));

    $Person->setName($_POST['name']);
    $Person->setSurname($_POST['surname']);

    $Person->save();

    break;

}

?>


<?php
/********** add new document *******/
?>
<form action="admin.php?action=add" method="post">
  <input type="text" name="name"/>
  <input type="text" name="surname"/>
  <input type="submit" value="save"/>
</form>


<?php
/******  show documents     *****/

$repository = $mondongo->getRepository("Model\Repository\Person");

$documents = $repository->find();

if(!$documents) $documents = array();
?>


<ul>
<?php foreach($documents as $document):?>
  <?php if($document->getId() == $_GET['id']):?>
  <li>
    <form action="admin.php?action=modify&id=<?php echo $document->getId() ?>" method="post">
      <input type="text" value="<?php echo $document->getName() ?>" name="name"/>
      <input type="text" value="<?php echo $document->getSurName() ?>" name="surname"/>
      <input type="submit" value="save" />
    </form>
  </li>
  <?php else: ?>
  <li><?php echo $document->getName() ?> <?php echo $document->getSurName() ?> <a href="admin.php?action=edit&id=<?php echo $document->getId() ?>">Edit</a> <a href="admin.php?action=delete&id=<?php echo $document->getId() ?>">Delete</a></li>
  <?php endif; ?>
  <?php endforeach; ?>
</ul>




