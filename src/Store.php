<?php
class Store
{
    private $name;
    private $id;

    function __construct($name, $id)
    {
        $this->name = $name;
        $this->id = $name;
    }

    function setName($new_name)
    {
        $this->name = $new_name;
    }

    function getName()
    {
        
    }

  }
?>
