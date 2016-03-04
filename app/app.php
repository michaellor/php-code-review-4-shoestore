<?php
    require_once __DIR__."/../vendor/autoload.php";
    require_once __DIR__."/../src/Store.php";
    require_once __DIR__."/../src/Brand.php";

    $app = new Silex\Application();

    $server = 'mysql:host=localhost;dbname=shoes';
    $username = 'root';
    $password = 'root';
    $DB = new PDO($server, $username, $password);

    $app->register(new Silex\Provider\TwigServiceProvider(), array(
    'twig.path' => __DIR__.'/../views'
    ));

    $app->get("/", function() use ($app) {
        return $app['twig']->render("index.html.twig");
    });

    $app->get("/stores", function() use ($app) {
        return $app['twig']->render("store_index.html.twig");
    });

    $app->get("/brands", function() use ($app) {
        return $app['twig']->render("brand_index.html.twig", array('brands' => Brand::getAll()));
    });

    $app->post("/add_brand", function() use ($app) {
        $new_brand = new Brand($_POST['new_brand']);
        $new_brand->save();
        return $app['twig']->render("brand_index.html.twig", array('brands' => Brand::getAll()));
    });

    $app->get("/brand/{id}", function($id) use ($app) {
        $brand = Brand::find($id);
        return $app['twig']->render("brand.html.twig", array('brand' => $brand, 'stores' => Store::getAll()));
    });

    return $app;


?>
