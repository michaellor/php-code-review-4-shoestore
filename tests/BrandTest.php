<?php

    /**
    * @backupGlobals disabled
    * @backupStaticAttributes disabled
    */

    require_once "src/Brand.php";

    $server = 'mysql:host=localhost;dbname=shoes_test';
    $username = 'root';
    $password = 'root';
    $DB = new PDO($server, $username, $password);


    class BrandTest extends PHPUnit_Framework_TestCase
    {

        protected function tearDown()
        {
            Brand::deleteAll();
        }

        function test_getName()
        {
            //Arrange
            $name = "Nike";
            $id = 1;
            $new_store = new Brand($id, $name);

            //Act
            $result = $new_store->getName($name);

            //Assert
            $this->assertEquals("Nike", $result);
        }

        function test_getId()
        {
            //Arrange
            $name = "Nike";
            $id = 1;
            $store = new Brand($id, $name);
            var_dump($store);

            //Act
            $result = $store->getId($id);

            //Assert
            $this->assertEquals(1, $result);
        }


    }

?>
