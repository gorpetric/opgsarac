<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Product;
use App\ProductPackage;

class BasketController extends Controller
{
    private $sessionKey = 'basket_products';

    public function index()
    {
        $basketItems = [];
        $stuff = session($this->sessionKey);
        if(count($stuff)) {
            foreach(array_keys($stuff) as $s) {
                $basketItems[] = [
                    'productPackage' => ProductPackage::where('id', $s)->first(),
                    'quantity' => $stuff[$s],
                ];
            }
        } else {
            $basketItems = null;
        }

        return view('basket.index')->with('basketItems', $basketItems);
    }

    public function addProductPackage(Request $request, ProductPackage $productPackage)
    {
        $this->validate($request, [
            'quantity' . $productPackage->id => 'required|integer|min:1|digits_between:1,2',
        ]);

        if(!session()->has($this->sessionKey)) {
            session([
                $this->sessionKey => [
                    $productPackage->id => $request->input('quantity' . $productPackage->id)
                ]
            ]);

            notify()->flash('Proizvod dodan u košaricu', 'success', [
                'timer' => 2000,
                'noConfirm' => true,
            ]);
            return redirect()->back();
        }

        $keys = array_keys(session($this->sessionKey));

        if(!in_array($productPackage->id, $keys)) {
            $currentItemsInSession = session($this->sessionKey);
            $currentItemsInSession[$productPackage->id] = $request->input('quantity' . $productPackage->id);
            session([$this->sessionKey => $currentItemsInSession]);
        } else {
            $currentItemsInSession = session($this->sessionKey);
            $currentItemsInSession[$productPackage->id] += $request->input('quantity' . $productPackage->id);
            session([$this->sessionKey => $currentItemsInSession]);
        }

        notify()->flash('Proizvod dodan u košaricu', 'success', [
            'timer' => 2000,
            'noConfirm' => true,
        ]);
        return redirect()->back();
    }

    public function removeProductPackage($productPackageID)
    {
        $currentItemsInSession = session($this->sessionKey);
        $keys = array_keys($currentItemsInSession);
        if(!in_array($productPackageID, $keys)) {
            return redirect()->back();
        }
        unset($currentItemsInSession[$productPackageID]);
        session([$this->sessionKey => $currentItemsInSession]);

        notify()->flash('Proizvod maknut iz košarice', 'success', [
            'timer' => 2000,
            'noConfirm' => true,
        ]);
        return redirect()->back();
    }

    public function updateProductPackage(Request $request, $productPackageID)
    {
        $currentItemsInSession = session($this->sessionKey);
        $keys = array_keys($currentItemsInSession);
        if(!in_array($productPackageID, $keys)) {
            return redirect()->back();
        }

        $this->validate($request, [
            'quantity' . $productPackageID => 'required|integer|min:1|digits_between:1,2',
        ]);

        $currentItemsInSession[$productPackageID] = $request->input('quantity' . $productPackageID);
        session([$this->sessionKey => $currentItemsInSession]);

        return redirect()->back();
    }
}
