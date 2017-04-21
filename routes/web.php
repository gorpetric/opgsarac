<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', [
    'uses' => 'HomeController@index',
    'as' => 'home',
]);

Route::get('/kontakt', [
    'uses' => 'HomeController@contact',
    'as' => 'contact.index',
]);
Route::post('/kontakt', [
    'uses' => 'HomeController@postContact',
]);

// plants
Route::get('biljke', [
    'uses' => 'PlantsController@index',
    'as' => 'plants.index',
]);
Route::get('biljke/nova', [
    'uses' => 'PlantsController@getNewPlant',
    'as' => 'plants.new',
    'middleware' => 'roles',
    'roles' => ['Admin', 'Moderator'],
]);
Route::post('biljke/nova', [
    'uses' => 'PlantsController@postNewPlant',
    'middleware' => 'roles',
    'roles' => ['Admin', 'Moderator'],
]);
Route::get('biljke/obrisi/{plant}', [
    'uses' => 'PlantsController@getDeletePlant',
    'as' => 'plants.deletePlant',
    'middleware' => 'roles',
    'roles' => ['Admin', 'Moderator'],
]);
Route::get('biljke/{plant}/uredi', [
    'uses' => 'PlantsController@getEditPlant',
    'as' => 'plants.edit',
    'middleware' => 'roles',
    'roles' => ['Admin', 'Moderator'],
]);
Route::post('biljke/{plant}/uredi', [
    'uses' => 'PlantsController@postEditPlant',
    'middleware' => 'roles',
    'roles' => ['Admin', 'Moderator'],
]);

// products
Route::get('proizvodi', [
    'uses' => 'ProductsController@index',
    'as' => 'products.index',
]);
Route::get('proizvodi/novi', [
    'uses' => 'ProductsController@getNewProduct',
    'as' => 'products.new',
    'middleware' => 'roles',
    'roles' => ['Admin', 'Moderator'],
]);
Route::post('proizvodi/novi', [
    'uses' => 'ProductsController@postNewProduct',
    'middleware' => 'roles',
    'roles' => ['Admin', 'Moderator'],
]);
Route::get('proizvodi/{product}', [
    'uses' => 'ProductsController@getProduct',
    'as' => 'products.product',
]);
Route::get('proizvodi/{product}/obrisi', [
    'uses' => 'ProductsController@getDeleteProduct',
    'as' => 'products.deleteProduct',
    'middleware' => 'roles',
    'roles' => ['Admin', 'Moderator'],
]);
Route::get('proizvodi/{product}/uredi', [
    'uses' => 'ProductsController@getEditProduct',
    'as' => 'products.editProduct',
    'middleware' => 'roles',
    'roles' => ['Admin', 'Moderator'],
]);
Route::post('proizvodi/{product}/uredi', [
    'uses' => 'ProductsController@postEditProduct',
    'middleware' => 'roles',
    'roles' => ['Admin', 'Moderator'],
]);
Route::post('proizvodi/{product}/nova-slika', [
    'uses' => 'ProductsController@postOtherImage',
    'as' => 'products.newOtherImage',
    'middleware' => 'roles',
    'roles' => ['Admin', 'Moderator'],
]);
Route::get('proizvodi/{product}/obrisi-sliku/{other_image_id}', [
    'uses' => 'ProductsController@getDeleteOtherImage',
    'as' => 'products.deleteOtherImage',
    'middleware' => 'roles',
    'roles' => ['Admin', 'Moderator'],
]);
Route::post('proizvodi/{product}/novo-pakiranje', [
    'uses' => 'ProductsController@postNewPackage',
    'as' => 'products.newPackage',
    'middleware' => 'roles',
    'roles' => ['Admin', 'Moderator'],
]);
Route::get('proizvodi/{product}/obrisi-pakiranje/{package_id}', [
    'uses' => 'ProductsController@getDeletePackage',
    'as' => 'products.deletePackage',
    'middleware' => 'roles',
    'roles' => ['Admin', 'Moderator'],
]);

// basket
Route::get('kosarica', [
    'uses' => 'BasketController@index',
    'as' => 'basket.index',
]);
Route::post('kosarica/dodaj-pakiranje/{productPackage}', [
    'uses' => 'BasketController@addProductPackage',
    'as' => 'basket.addProductPackage',
]);
Route::get('kosarica/obrisi-pakiranje/{productPackageID}', [
    'uses' => 'BasketController@removeProductPackage',
    'as' => 'basket.removeProductPackage',
]);
Route::post('kosarica/osvjezi-pakiranje/{productPackageID}', [
    'uses' => 'BasketController@updateProductPackage',
    'as' => 'basket.updateProductPackage',
]);

// gallery
Route::get('galerija', [
    'uses' => 'GalleryController@index',
    'as' => 'gallery.index',
]);
Route::post('galerija/nova-slika', [
    'uses' => 'GalleryController@postNewImage',
    'as' => 'gallery.newImage',
    'middleware' => 'roles',
    'roles' => ['Admin', 'Moderator'],
]);
Route::get('galerija/obrisi/{image}', [
    'uses' => 'GalleryController@getDeleteImage',
    'as' => 'gallery.deleteImage',
    'middleware' => 'roles',
    'roles' => ['Admin', 'Moderator'],
]);

// auth
Route::get('prijava', [
    'uses' => 'HomeController@getLogin',
    'as' => 'auth.login',
    'middleware' => 'guest',
]);
Route::get('odjava', [
    'uses' => 'HomeController@getLogout',
    'as' => 'auth.logout',
    'middleware' => 'auth',
]);
Route::post('prijava', [
    'uses' => 'HomeController@postLogin',
]);
Route::get('registracija', [
    'uses' => 'HomeController@getRegister',
    'as' => 'auth.register',
    'middleware' => 'guest',
]);
Route::post('registracija', [
    'uses' => 'HomeController@postRegister',
]);

// Admin
Route::get('admin', [
    'uses' => 'AdminController@index',
    'as' => 'admin.index',
    'middleware' => 'roles',
    'roles' => ['Admin'],
]);
Route::post('admin/users/{user}/update-roles', [
    'uses' => 'AdminController@postUpdateRoles',
    'as' => 'admin.updateRoles',
    'middleware' => 'roles',
    'roles' => ['Admin'],
]);
Route::get('admin/users/new', [
    'uses' => 'AdminController@getNewUser',
    'as' => 'admin.newUser',
    'middleware' => 'roles',
    'roles' => ['Admin'],
]);
Route::post('admin/users/new', [
    'uses' => 'AdminController@postNewUser',
    'middleware' => 'roles',
    'roles' => ['Admin'],
]);
Route::get('admin/users/{user}/delete', [
    'uses' => 'AdminController@getDeleteUser',
    'as' => 'admin.deleteUser',
    'middleware' => 'roles',
    'roles' => ['Admin'],
]);
