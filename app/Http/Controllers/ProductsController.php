<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;
use App\Product;

class ProductsController extends Controller
{
    public function index()
    {
        $products = Product::orderBy('created_at', 'desc')->get();
        return view('products.index')->with('products', $products);
    }

    public function getNewProduct()
    {
        return view('products.new');
    }

    public function postNewProduct(Request $request)
    {
        $this->validate($request, [
            'name' => 'required',
            'description' => 'required',
            'image' => 'required|image'
        ]);

        $path = 'img/products';
        $name = uniqid() .'.'. $request->file('image')->guessClientExtension();
        $image = $path .'/'. $name;

        $request->file('image')->move($path, $name);

        $slug = $this->generateSlug($request->input('name'));

        $newProduct = Product::create([
            'name' => $request->input('name'),
            'slug' => $slug,
            'description' => $request->input('description'),
        ]);

        $newProduct->images()->create([
            'name' => $image,
        ]);

        notify()->flash('Proizvod uspješno dodan', 'success', [
            'timer' => 2000,
            'noConfirm' => true,
        ]);
        return redirect()->route('products.product', $newProduct);
    }

    public function getProduct(Product $product)
    {
        return view('products.product')->with('product', $product);
    }

    public function getDeleteProduct(Product $product)
    {
        foreach($product->images as $image){
            if(file_exists(public_path($image->name))) unlink(public_path($image->name));
            $image->delete();
        }
        $product->delete();

        notify()->flash('Proizvod uspješno obrisan', 'success', [
            'timer' => 2000,
            'noConfirm' => true,
        ]);
        return redirect()->route('products.index');
    }

    public function getEditProduct(Product $product)
    {
        return view('products.edit')->with('product', $product);
    }

    public function postEditProduct(Request $request, Product $product)
    {
        $this->validate($request, [
            'name' => 'required',
            'description' => 'required',
            'image' => 'image',
        ]);

        if($request->hasFile('image')){
            if(file_exists(public_path($product->mainImage()->name))) unlink(public_path($product->mainImage()->name));
            $path = 'img/products';
            $name = uniqid() .'.'. $request->file('image')->guessClientExtension();
            $image = $path .'/'. $name;
            $request->file('image')->move($path, $name);
        } else {
            $image = $product->mainImage()->name;
        }

        //$slug = $this->generateSlug($request->input('name'));

        $product->mainImage()->update([
            'name' => $image,
        ]);
        $product->update([
            'name' => $request->input('name'),
            //'slug' => $slug,
            'description' => $request->input('description'),
        ]);

        notify()->flash('Proizvod uspješno uređen', 'success', [
            'timer' => 2000,
            'noConfirm' => true,
        ]);
        return redirect()->route('products.product', $product);
    }

    public function postOtherImage(Request $request, Product $product)
    {
        $this->validate($request, [
            'image' => 'required|image',
        ]);

        $path = 'img/products';
        $name = uniqid() .'.'. $request->file('image')->guessClientExtension();
        $image = $path .'/'. $name;

        $request->file('image')->move($path, $name);

        $product->images()->create([
            'name' => $image,
        ]);

        notify()->flash('Slika uspješno dodana', 'success', [
            'timer' => 2000,
            'noConfirm' => true,
        ]);
        return redirect()->route('products.product', $product);
    }

    public function getDeleteOtherImage(Product $product, $other_image_id)
    {
        $other_image = $product->images()->where('id', $other_image_id)->first();
        if(!$other_image || $other_image->id == $product->mainImage()->id){
            notify()->flash('Radnja onemogućena!', 'error', [
                'timer' => 2000,
                'noConfirm' => true,
            ]);
            return redirect()->route('home');
        }

        if(file_exists(public_path($other_image->name))) unlink(public_path($other_image->name));
        $other_image->delete();

        notify()->flash('Slika uspješno obrisana', 'success', [
            'timer' => 2000,
            'noConfirm' => true,
        ]);
        return redirect()->route('products.product', $product);
    }

    public function postNewPackage(Request $request, Product $product)
    {
        $this->validate($request, [
            'package' => 'required',
            'kune' => 'required|integer',
            'lipe' => 'required|numeric|digits_between:2,2',
        ]);

        $priceHRK = $request->input('kune') . '.' . $request->input('lipe');

        $product->packages()->create([
            'package' => $request->input('package'),
            'priceHRK' => $priceHRK,
        ]);

        return redirect()->route('products.editProduct', $product);
    }

    public function getDeletePackage(Product $product, $package_id)
    {
        $productPackage = $product->packages()->where('id', $package_id)->first();
        if(!$productPackage) {
            notify()->flash('Radnja onemogućena!', 'error', [
                'timer' => 2000,
                'noConfirm' => true,
            ]);
            return redirect()->route('home');
        }

        $productPackage->delete();

        notify()->flash('Pakiranje uspješno obrisano', 'success', [
            'timer' => 2000,
            'noConfirm' => true,
        ]);
        return redirect()->route('products.editProduct', $product);
    }

    protected function generateSlug($inputSlug)
    {
        $slugInit = str_slug($inputSlug);
        $slugDB = Product::where('slug', $slugInit)->first();
        if($slugDB || $slugInit == 'novi'){
            $slug = $slugInit . '-' . uniqid();
        } else {
            $slug = $slugInit;
        }

        return $slug;
    }
}
