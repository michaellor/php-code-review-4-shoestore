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


    }

?>
