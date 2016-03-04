<?php
class Store
{
    private $name;
    private $id;

    function __construct($name, $id = null)
    {
        $this->name = $name;
        $this->id = $id;
    }

    function setName($new_name)
    {
        $this->name = $new_name;
    }

    function getName()
    {
        return $this->name;
    }

    function getId()
    {
        return $this->id;
    }

    function save()
    {
        $GLOBALS['DB']->exec("INSERT INTO stores (name) VALUES ('{$this->getName()}');");
        $this->id = $GLOBALS['DB']->lastInsertId();
    }

    static function find($search_id)
    {
        $found_store = null;
        $stores = Store::getAll();
        foreach($stores as $store)
        {
            $store_id = $store->getId();
            if ($store_id == $search_id)
            {
                $found_store = $store;
            }
        }
        return $found_store;
    }

    static function getAll()
    {
        $returned_stores = $GLOBALS['DB']->query("SELECT * FROM stores");
        $stores = array();
        foreach($returned_stores as $store)
            {
                $name = $store['name'];
                $id = $store['id'];
                $new_store = new Store($name, $id);
                array_push($stores, $new_store);
            }
            return $stores;
    }

    function addBrand($brand)
    {
        $GLOBALS['DB']->exec("INSERT INTO distributions (store_id, brand_id) VALUES ({$this->getId()}, {$brand->getId()});");
    }

    function getBrands()
    {
        $matching_brands = $GLOBALS['DB']->query("SELECT brands.* FROM stores
                            JOIN distributions ON (stores.id = distributions.store_id)
                            JOIN brands ON (distributions.brand_id = brands.id)
                            WHERE stores.id = {$this->getId()}");

        $brands = array();
        foreach($matching_brands as $brand)
            {
                $name = $brand['name'];
                $id = $brand['id'];
                $new_brand = new Brand($name, $id);
                array_push($brands, $new_brand);
            }
            return $brands;
    }

    static function deleteAll()
    {
        $GLOBALS['DB']->exec("DELETE FROM stores");
    }


  }
?>
