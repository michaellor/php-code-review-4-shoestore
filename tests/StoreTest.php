<?php

    /**
    * @backupGlobals disabled
    * @backupStaticAttributes disabled
    */

    require_once "src/Store.php";

    $server = 'mysql:host=localhost;dbname=shoes_test';
    $username = 'root';
    $password = 'root';
    $DB = new PDO($server, $username, $password);


    class StoreTest extends PHPUnit_Framework_TestCase
    {

        protected function tearDown()
        {
            Store::deleteAll();
        }

        function test_getName()
        {
            //Arrange
            $name = "Nu Value Shoes";
            $id = 1;
            $new_store = new Store($name, $id);

            //Act
            $result = $new_store->getName($name);

            //Assert
            $this->assertEquals("Nu Value Shoes", $result);
        }

        function test_getId()
        {
            //Arrange
            $name = "Bargain Shoes";
            $id = 1;
            $store = new Store($name, $id);

            //Act
            $result = $store->getId($id);

            //Assert
            $this->assertEquals(1, $result);
        }

        function test_save()
        {
          //Arrange
          $name = "Bargain Shoes";
          $id = 1;
          $store = new Store($name, $id);

          //Act
          $store->save();
          $result = Store::getAll();

          //Assert
          $this->assertEquals([$store], $result);
        }

        function test_getAll()
        {
          //Arrange
          $name = "Bargain Shoes";
          $id = 1;
          $store = new Store($name, $id);
          $store->save();
          $name2 = "Best Shoes";
          $id2 = 2;
          $store2 = new Store($name2, $id2);
          $store2->save();

          //Act
          $result = Store::getAll();

          //Assert
          $this->assertEquals([$store, $store2], $result);
        }


    }

?>
