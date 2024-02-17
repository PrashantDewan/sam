<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Categories;
use App\Models\Product;


class AdminController extends Controller
{
    public function index()
    {
        return view('Admin.Home.index');
    }

    public function displayAdmin()
    {
        $users = User::where('role', 'admin')->paginate(10);
        return view('Admin.Pages.Users.admin', compact('users'));
    }

    public function displayUser()
    {
        $users = User::where('role', 'user')->paginate(10);
        return view('Admin.Pages.Users.user', compact('users'));
    }

    public function displayCategories()
    {
        $categories = Categories::all();
        return view('Admin.Pages.Categories.index', compact('categories'));
    }

    public function createCategories()
    {
        return view('Admin.Pages.Categories.create');
    }

    public function storeCategories(Request $request)
    {
        try {
            $request->validate([
                'name' => 'required',
                'description' => 'required'
            ]);
            $category = new Categories();
            $category->name = $request->name;
            $category->description = $request->description;
            $category->save();
            return redirect()->route('admin.categories')->with('success', 'Category created successfully');
        } catch (\Exception $e) {
            return redirect()->back()->with('error', $e->getMessage());
        }
    }

    public function editCategories($id)
    {
        try {
            $category = Categories::findOrFail($id);
            return view('Admin.Pages.Categories.edit', compact('category'));
        } catch (\Exception $e) {
            return redirect()->back()->with('error', $e->getMessage());
        }
    }

    public function updateCategories(Request $request, $id)
    {
        try {
            $request->validate([
                'name' => 'required',
                'description' => 'required'
            ]);
            $category = Categories::findOrFail($id);
            $category->name = $request->name;
            $category->description = $request->description;
            $category->save();
            return redirect()->route('admin.categories')->with('success', 'Category updated successfully');
        } catch (\Exception $e) {
            return redirect()->back()->with('error', $e->getMessage());
        }
    }

    public function deleteCategories($id)
    {
        try {
            $category = Categories::findOrFail($id);
            $category->delete();
            return redirect()->route('admin.categories')->with('success', 'Category deleted successfully');
        } catch (\Exception $e) {
            return redirect()->back()->with('error', $e->getMessage());
        }
    }


    public function displayProducts()
    {
        // Fetch products with pagination
        $products = Product::select('products.*', 'categories.name as category_name')
        ->join('categories', 'products.category', '=', 'categories.id')
        ->get();

    // Return view with products
    return view('Admin.Pages.Products.index', compact('products'));
    }

    public function createProducts()
    {
        $categories = Categories::all();
        return view('Admin.Pages.Products.create', compact('categories'));
    }

    public function storeProducts(Request $request)
    {
        try {

            $request->validate([
                'name' => 'required',
                'price' => 'required',
                'category_id' => 'required',
                'description' => 'required',
                'quantity' => 'required',
                'full_description' => 'required',
                'image' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg',
            ]);


            $image = $request->file('image');
            $image_name = time() . '.' . $image->getClientOriginalExtension();
            $image->move(public_path('images\product'), $image_name);
            $image_path = $image_name;


            $product = new Product();
            $product->name = $request->name;
            $product->price = $request->price;
            $product->category = $request->category_id;
            $product->description = $request->description;
            $product->quantity = $request->quantity;
            $product->full_description = $request->full_description;
            $product->image = $image_path;
            $product->save();
            return redirect()->route('admin.products')->with('success', 'Product updated successfully');
        } catch (\Exception $e) {
            return redirect()->back()->with('error', $e->getMessage());
        }
    }

    public function editProducts($id)
    {
        try {
            $product = Product::findOrFail($id);
            $categories = Categories::all();
            return view('Admin.Pages.Products.edit', compact('product', 'categories'));
        } catch (\Exception $e) {
            return redirect()->back()->with('error', $e->getMessage());
        }
    }

    public function updateProducts(Request $request, $id)
    {
        try {
            $request->validate([
                'name' => 'required',
                'price' => 'required',
                'category_id' => 'required',
                'description' => 'required',
                'quantity' => 'required',
                'full_description' => 'required',
                'image' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg',
            ]);

            $product = Product::findOrFail($id);
            $product->name = $request->name;
            $product->price = $request->price;
            $product->category = $request->category_id;
            $product->description = $request->description;
            $product->quantity = $request->quantity;
            $product->full_description = $request->full_description;

            if ($request->hasFile('image')) {
                $image = $request->file('image');
                $image_name = time() . '.' . $image->getClientOriginalExtension();
                $image->move(public_path('images\product'), $image_name);
                $image_path = $image_name;
                $product->image = $image_path;
            }

            $product->save();
            return redirect()->route('admin.products')->with('success', 'Product updated successfully');
        } catch (\Exception $e) {
            return redirect()->back()->with('error', $e->getMessage());
        }
    }


    public function deleteProducts($id)
    {
        try {
            $product = Product::findOrFail($id);
            $product->delete();
            return redirect()->route('admin.products')->with('success', 'Product deleted successfully');
        } catch (\Exception $e) {
            return redirect()->back()->with('error', $e->getMessage());
        }
    }


}
