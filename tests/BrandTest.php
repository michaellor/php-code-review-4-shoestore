<?php

    /**
    * @backupGlobals disabled
    * @backupStaticAttributes disabled
    */

    require_once "src/Store.php";
    require_once "src/Brand.php";

    $server = 'mysql:host=localhost;dbname=shoes_test';
    $username = 'root';
    $password = 'root';
    $DB = new PDO($server, $username, $password);


    class BrandTest extends PHPUnit_Framework_TestCase
    {

        protected function tearDown()
        {
            Store::deleteAll();
            Brand::deleteAll();
        }

        function test_getName()
        {
            //Arrange
            $name = "Nike";
            $id = 1;
            $new_brand = new Brand($name, $id);

            //Act
            $result = $new_brand->getName($name);

            //Assert
            $this->assertEquals("Nike", $result);
        }

        function test_getId()
        {
            //Arrange
            $name = "Nike";
            $id = 1;
            $brand = new Brand($name, $id);

            //Act
            $result = $brand->getId($id);

            //Assert
            $this->assertEquals(1, $result);
        }

        function test_save()
        {
            //Arrange
            $name = "Nike";
            $id = 1;
            $store = new Brand($name, $id);

            //Act
            $store->save();
            $result = Brand::getAll();

            //Assert
            $this->assertEquals([$store], $result);
        }

        function test_getAll()
        {
            //Arrange
            $name = "Nike";
            $id = 1;
            $brand = new Brand($name, $id);
            $brand->save();
            $name2 = "Adidas";
            $id2 = 2;
            $brand2 = new Brand($name2, $id2);
            $brand2->save();

            //Act
            $result = Brand::getAll();

            //Assert
            $this->assertEquals([$brand, $brand2], $result);
        }

        function test_addStore()
        {
          //Arrange
          $name = "Nike";
          $id = 1;
          $brand = new Brand($name, $id);
          $brand->save();

          $store_name = "Adidas";
          $store_id = 1;
          $store = new Store($store_name, $store_id);
          $store->save();

          //Act
          $brand->addStore($store);

          //Assert
          $this->assertEquals([$store], $brand->getStores());
        }



    }

?>
