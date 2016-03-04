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

    use Symfony\Component\HttpFoundation\Request;
    Request::enableHttpMethodParameterOverride();

    $app->get("/", function() use ($app) {
        return $app['twig']->render("index.html.twig");
    });

    $app->get("/stores", function() use ($app) {
        return $app['twig']->render("store_index.html.twig", array('stores' => Store::getAll()));
    });

    $app->post("/add_store", function() use ($app) {
        $new_store = new Store($_POST['new_store']);
        $new_store->save();
        return $app['twig']->render("store_index.html.twig", array('stores' => Store::getAll()));
    });

    $app->get("/store/{id}", function($id) use ($app) {
        $store = Store::find($id);
        return $app['twig']->render("store.html.twig", array('store' => $store, 'store_brand' => $store->getBrands(), 'brands' => Brand::getAll()));
    });

    $app->post("/add_brand/{id}", function($id) use ($app) {
        $store = Store::find($id);
        $brand = Brand::find($_POST['brand']);
        $store->addBrand($brand);
        return $app['twig']->render("store.html.twig", array('store' => $store, 'store_brand' => $store->getBrands(), 'brands' => Brand::getAll()));
    });

    $app->patch("/update_store/{id}", function ($id) use ($app) {
        $store = Store::find($id);
        $new_name = $_POST['new_name'];
        $store->update($new_name);
        return $app['twig']->render("store.html.twig", array('store' => $store, 'store_brand' => $store->getBrands(), 'brands' => Brand::getAll()));
    });

    $app->delete("/delete_store/{id}", function ($id) use ($app) {
        $store = Store::find($id);
        $store->delete();
        return $app['twig']->render("store_index.html.twig", array('stores' => Store::getAll()));
    });

    $app->delete("/delete_all_stores", function() use ($app) {
        Store::deleteAll();
        return $app['twig']->render("index.html.twig", array('stores' => Store::getAll()));
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
        return $app['twig']->render("brand.html.twig", array('brand' => $brand, 'store_brand' => $brand->getStores(), 'stores' => Store::getAll()));
    });

    $app->post("/add_store/{id}", function($id) use ($app) {
        $brand = Brand::find($id);
        $store = Store::find($_POST['store']);
        $brand->addStore($store);
        return $app['twig']->render("brand.html.twig", array('brand' => $brand, 'store_brand' => $brand->getStores(), 'stores' => Store::getAll()));
    });

    return $app;


?>
