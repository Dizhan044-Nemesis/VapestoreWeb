<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Order;
use App\Http\Resources\OrderResource;  // Sesuaikan dengan resource yang Anda buat
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class OrderController extends Controller
{
    /**
     * index
     *
     * @return void
     */
    public function index()
    {
        // Get all orders
        $orders = Order::latest()->paginate(5);

        // Return collection of orders as a resource
        return new OrderResource(true, 'List Data Orders', $orders);
    }

    /**
     * store
     *
     * @param  mixed $request
     * @return void
     */
    public function store(Request $request)
    {
        // Define validation rules
        $validator = Validator::make($request->all(), [
            'name'         => 'required|string|max:255',
            'email'        => 'required|email|max:255',
            'phone'        => 'required|string|max:20',
            'address'      => 'required|string|max:255',
            'category'     => 'required|string|max:255',
            'total_price'  => 'required|numeric|min:0',
            'status'       => 'required|string|in:pending,processing,completed,cancelled',
            'payment_method'=> 'required|string|max:50',
        ]);

        // Check if validation fails
        if ($validator->fails()) {
            return response()->json($validator->errors(), 422);
        }

        // Create order
        $order = Order::create([
            'name'         => $request->name,
            'email'        => $request->email,
            'phone'        => $request->phone,
            'address'      => $request->address,
            'category'     => $request->category,
            'total_price'  => $request->total_price,
            'status'       => $request->status,
            'payment_method'=> $request->payment_method,
        ]);

        // Return response
        return new OrderResource(true, 'Order Berhasil Ditambahkan!', $order);
    }

    /**
     * show
     *
     * @param  int $id
     * @return void
     */
    public function show($id)
    {
        // Find order by ID
        $order = Order::find($id);

        if (!$order) {
            return response()->json(['error' => 'Order not found'], 404);
        }

        // Return order details as a resource
        return new OrderResource(true, 'Detail Order', $order);
    }

    /**
     * update
     *
     * @param  mixed $request
     * @param  int $id
     * @return void
     */
    public function update(Request $request, $id)
    {
        // Define validation rules
        $validator = Validator::make($request->all(), [
            'name'         => 'required|string|max:255',
            'email'        => 'required|email|max:255',
            'phone'        => 'required|string|max:20',
            'address'      => 'required|string|max:255',
            'category'     => 'required|string|max:255',
            'total_price'  => 'required|numeric|min:0',
            'status'       => 'required|string|in:pending,processing,completed,cancelled',
            'payment_method'=> 'required|string|max:50',
        ]);

        // Check if validation fails
        if ($validator->fails()) {
            return response()->json($validator->errors(), 422);
        }

        // Find order by ID
        $order = Order::find($id);

        if (!$order) {
            return response()->json(['error' => 'Order not found'], 404);
        }

        // Update order
        $order->update([
            'name'         => $request->name,
            'email'        => $request->email,
            'phone'        => $request->phone,
            'address'      => $request->address,
            'category'     => $request->category,
            'total_price'  => $request->total_price,
            'status'       => $request->status,
            'payment_method'=> $request->payment_method,
        ]);

        // Return response
        return new OrderResource(true, 'Order Berhasil Diubah!', $order);
    }

    /**
     * delete
     *
     * @param  int $id
     * @return void
     */
    public function destroy($id)
    {
        // Find order by ID
        $order = Order::find($id);

        if (!$order) {
            return response()->json(['error' => 'Order not found'], 404);
        }

        // Delete order
        $order->delete();

        // Return response
        return new OrderResource(true, 'Order Berhasil Dihapus!', null);
    }  
}
