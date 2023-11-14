<?php

namespace App\Http\Controllers\Store\Product;

use App\Http\Controllers\Controller;
use App\Models\Catigory;
use App\Models\product;
use App\Models\Product_Catigory;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

class ProductController extends Controller
{
    public function index()
    {
        $products = product::where('store_id', Auth::guard('store')->user()->id)->with('store')->get();
        return view('Store.Product.index', compact('products'));
    }

    public function create()
    {
        $catigories = Catigory::where('type', '0')->get();
        return view('Store.Product.create', compact('catigories'));
    }

    public function store(Request $request)
    {
        $storeID = Auth::guard('store')->user()->id;
        $product_name = $request->input('name');
        $image = $request->file('img')->getClientOriginalName();
        $path = $request->file('img')->storeAs('ProductImage', $image, 'productImage');

        $check_product_exists = product::where('name', $product_name)->where('store_id', $storeID)->first();

        if ($check_product_exists) {
            return redirect()->back()->with('error_message', 'Product Already Exists');
        }

        $product = product::create([
            'name' => $product_name,
            // 'category' => $request->input('category'),
            'status' => $request->input('status'),
            'price' => $request->input('price'),
            'details' => $request->input('details'),
            'img' => $path,
            'store_id' => $storeID,
        ]);

        $catigoryIDs = $request->input('catigoryID');

        foreach ($catigoryIDs as $catigoryID) {
            Product_Catigory::create([
                'product_id' => $product->id,
                'catigory_id' => $catigoryID
            ]);
        }

        return redirect()->route('store.product.index')->with('success_message', 'Product Created Successfully');
    }

    public function edit($id)
    {
        $product = product::findOrFail($id);
        $catigories = Catigory::where('type', '0')->get();
        $productCatigoryIDs = Product_Catigory::where('product_id', $product->id)->pluck('catigory_id');
        return view('Store.Product.edit', compact('product', 'catigories', 'productCatigoryIDs'));
    }

    public function update(Request $request, $id)
    {
        $product = product::findOrFail($id);


        if ($request->file('img') == null) {
            $product->update([
                'name' => $request->input('name'),
                // 'category' => $request->input('category'),
                'status' => $request->input('status'),
                'price' => $request->input('price'),
                'details' => $request->input('details'),
            ]);

            $productCatigory = Product_Catigory::where('product_id', $product->id)->get();
            $productCatigory->each->delete();
            $catigoryIDs = $request->input('catigoryID');
            foreach ($catigoryIDs as $catigoryID) {
                Product_Catigory::create([
                    'product_id' => $product->id,
                    'catigory_id' => $catigoryID
                ]);
            }
            return redirect()->route('store.product.index')->with('success_message', 'Product Updated Successfully');
        } else {
            if ($product->img != null) {
                Storage::disk('productImage')->delete($product->img);
                $image = $request->file('img')->getClientOriginalName();
                $path = $request->file('img')->storeAs('ProductImage', $image, 'productImage');;

                $product->update([
                    'name' => $request->input('name'),
                    // 'category' => $request->input('category'),
                    'status' => $request->input('status'),
                    'price' => $request->input('price'),
                    'details' => $request->input('details'),
                    'img' => $path,
                ]);
                $productCatigory = Product_Catigory::where('product_id', $product->id)->get();
                $productCatigory->each->delete();
                $catigoryIDs = $request->input('catigoryID');
                foreach ($catigoryIDs as $catigoryID) {
                    Product_Catigory::create([
                        'product_id' => $product->id,
                        'catigory_id' => $catigoryID
                    ]);
                }
                return redirect()->route('store.product.index')->with('success_message', 'Product Updated Successfully');
            } else {
                $image = $request->file('img')->getClientOriginalName();
                $path = $request->file('img')->storeAs('ProductImage', $image, 'productImage');;

                $product->update([
                    'name' => $request->input('name'),
                    // 'category' => $request->input('category'),
                    'status' => $request->input('status'),
                    'price' => $request->input('price'),
                    'details' => $request->input('details'),
                    'img' => $path,
                ]);
                $productCatigory = Product_Catigory::where('product_id', $product->id)->get();
                $productCatigory->each->delete();
                $catigoryIDs = $request->input('catigoryID');
                foreach ($catigoryIDs as $catigoryID) {
                    Product_Catigory::create([
                        'product_id' => $product->id,
                        'catigory_id' => $catigoryID
                    ]);
                }
                return redirect()->route('store.product.index')->with('success_message', 'Product Updated Successfully');
            }
        }
    }

    public function archive()
    {
        $products = product::onlyTrashed()->with('store')->get();
        return view('Store.Product.archive', compact('products'));
    }

    public function soft_delete($id)
    {
        $product = product::findOrFail($id);

        $product->delete();

        return redirect()->route('store.product.index')->with('success_message', 'Product Deleted Successfully');
    }

    public function force_delete($id)
    {
        $product = product::withTrashed()->where('id', $id)->first();
        if ($product) {
            Storage::disk('productImage')->delete($product->img);

            $product->forceDelete();

            return redirect()->route('store.product.archive')->with('success_message', 'Product Deleted Successfully');
        } else {
            return redirect()->back()->with('error_message', 'Product  Not Found');
        }
    }

    public function restore($id)
    {
        product::withTrashed()->where('id', $id)->restore();

        return redirect()->route('store.product.archive')->with('success_message', 'Product Restored Successfully');
    }
}
