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


    class StoreTest extends PHPUnit_Framework_TestCase
    {

        protected function tearDown()
        {
            Store::deleteAll();
            Brand::deleteAll();
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

        function test_addBrand()
        {
          //Arrange
          $name = "Bargain Shoes";
          $id = 1;
          $store = new Store($name, $id);
          $store->save();

          $brand_name = "Adidas";
          $brand_id = 1;
          $brand = new Brand($brand_name, $brand_id);
          $brand->save();

          //Act
          $store->addBrand($brand);

          //Assert
          $this->assertEquals([$brand], $store->getBrands());
        }

        function test_update()
        {
            //Arrange
            $name = "Bargain Shoes";
            $id = 1;
            $store = new Store($name, $id);
            $store->save();
            $new_name = "Wholesale Shoes";

            //Act
            $store->update($new_name);

            //Assert
            $this->assertEquals("Wholesale Shoes", $store->getName());
        }

        function test_delete()
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
          $store->delete();
          $result = Store::getAll();

          //Assert
          $this->assertEquals([$store2], $result);
        }

        function test_deleteAll()
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
          Store::deleteAll();
          $result = Store::getAll();

          //Assert
          $this->assertEquals([], $result);
        }


    }

?>
