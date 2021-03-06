<?php
class Brand
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
        $GLOBALS['DB']->exec("INSERT INTO brands (name) VALUES ('{$this->getName()}');");
        $this->id = $GLOBALS['DB']->lastInsertId();
    }

    static function find($search_id)
    {
        $found_brand = null;
        $brands = Brand::getAll();
        foreach($brands as $brand)
        {
            $brand_id = $brand->getId();
            if ($brand_id == $search_id)
            {
                $found_brand = $brand;
            }
        }
        return $found_brand;
    }

    static function getAll()
    {
        $returned_brands = $GLOBALS['DB']->query("SELECT * FROM brands");
        $brands = array();
        foreach($returned_brands as $brand)
            {
                $name = $brand['name'];
                $id = $brand['id'];
                $new_brand = new Brand($name, $id);
                array_push($brands, $new_brand);
            }
            return $brands;
    }

    function addStore($store)
    {
        $GLOBALS['DB']->exec("INSERT INTO distributions (brand_id, store_id) VALUES ({$this->getId()}, {$store->getId()});");
    }

    function getStores()
    {
        $matching_stores = $GLOBALS['DB']->query("SELECT stores.* FROM brands
                            JOIN distributions ON (brands.id = distributions.brand_id)
                            JOIN stores ON (distributions.store_id = stores.id)
                            WHERE brands.id = {$this->getId()}");

        $stores = array();
        foreach($matching_stores as $store)
            {
                $name = $store['name'];
                $id = $store['id'];
                $new_store = new Store($name, $id);
                array_push($stores, $new_store);
            }
            return $stores;
    }

    static function deleteAll()
    {
        $GLOBALS['DB']->exec("DELETE FROM brands;");
    }


}
?>
