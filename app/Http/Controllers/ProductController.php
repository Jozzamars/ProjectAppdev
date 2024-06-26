<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class ProductController extends Controller
{
    private $products = [
        [
            'id' => 1,
            'name' => 'Product 1',
            'description' => 'This is product 1',
        ],
        [
            'id' => 2,
            'name' => 'Product 2',
            'description' => 'This is product 2',
        ],
        [
            'id' => 3,
            'name' => 'Product 3',
            'description' => 'This is product 3',
        ],
    ];

    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return response()->json($this->products);
        //this keyword peretains to this class
    }
    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        return response()->json([
            "message" => "Product clear"
        ]);
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
      // Find the product with the specified ID
    $product = collect($this->products)->firstWhere('id', $id);

    // Check if the product exists
    if ($product && $product['id'] == 3) {
        // Return a JSON response indicating the display of the product
        return response()->json($product);
    } else {
        // Return this if the product was not found
        return response()->json([
            'message' => "Product with ID $id not found"
        ], );
    }
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $product = collect($this->products)->firstWhere('id', $id);

        if ($product) {
    
            // Return a JSON response indicating the successful update
            return response()->json([
                'message' => "Product with ID: $id updated successfully."
            ]);
        } else {
            // Return a JSON response indicating that the product was not found
            return response()->json([
                'message' => "Product with ID $id not found"
            ],);
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $productKey = array_search($id, array_column($this->products, 'id'));

    if ($productKey !== false) {
        unset($this->products[$productKey]);

        // Return a JSON response indicating the successful deletion
        return response()->json([
            'message' => "Product with ID: $id deleted successfully."
        ]);
    } else {
        // Return a JSON response indicating that the product was not found
        return response()->json([
            'message' => "Product with ID $id not found"
        ],);
    }
    }
}
