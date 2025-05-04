<?php
    
namespace App\Http\Controllers;
    
use App\Models\Product;
use Illuminate\Http\RedirectResponse;
use Illuminate\View\View;
use App\Http\Requests\ProductStoreRequest;
use App\Http\Requests\ProductUpdateRequest;
use Illuminate\Support\Facades\Auth;
class ProductController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        if(Auth::check()){
            $products = Product::latest()->paginate(5);
          
            return view('products.index', compact('products'))
                        ->with('i', (request()->input('page', 1) - 1) * 5);
        }
        return redirect("typo3")->withSuccess('Opps! You do not have access');
    }
    
    /**
     * Show the form for creating a new resource.
     */
    public function create(): View
    {
        return view('products.create');
    }
    
    /**
     * Store a newly created resource in storage.
     */
    public function store(ProductStoreRequest $request): RedirectResponse
    {   
      // Validation rules (without accept_terms validation)
      $validatedData = $request->validate([
        'name' => 'required|string|max:255',
        'dob' => 'required|date',
        'gender' => 'required|in:Male,Female',
        'country' => 'required|string',
        'detail' => 'nullable|string', // assuming 'detail' is optional
        'image' => 'image|mimes:jpg,jpeg,png|max:2048'
    ]);

    // Add a value for the accept_terms field manually
    $validatedData['accept_terms'] = $request->has('accept_terms') ? true : false;
        // Handle file upload
        if ($request->hasFile('image')) {
            $imagePath = $request->file('image')->store('products', 'public');
            $validatedData['image'] = $imagePath;
        }


    // Use the validated data in the create method
    Product::create($validatedData);
           
        return redirect()->route('products.index')
                         ->with('success', 'Product created successfully.');
    }
  
    /**
     * Display the specified resource.
     */
    public function show($id)
    {
        $product = Product::find($id);
    
        if (!$product) {
            return response()->json(['error' => 'Product not found'], 404);
        }
    
        return response()->json($product);
    }
  
    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Product $product): View
    {
        return view('products.edit',compact('product'));
    }
  
    /**
     * Update the specified resource in storage.
     */
    public function update(ProductUpdateRequest $request, Product $product): RedirectResponse
    {
        $product->update($request->validated());
          
        return redirect()->route('products.index')
                        ->with('success','Product updated successfully');
    }
  
    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Product $product): RedirectResponse
    {
        $product->delete();
           
        return redirect()->route('products.index')
                        ->with('success','Product deleted successfully');
    }
}