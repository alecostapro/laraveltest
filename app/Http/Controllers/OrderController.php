<?php

namespace App\Http\Controllers;

use App\Models\Tag;
use App\Models\Order;
use App\Models\Customer;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;
use Illuminate\Support\Facades\Validator;

class OrderController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('orders.index')->withOrders(Order::paginate(10));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('orders.create', [
            'customers' => Customer::all(),
            'tags' => Tag::all()
        ])->withOrder(new Order);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {

        $validator = $this->validateOrder($request);

        if ($validator->fails()) {
            return back()->withErrors($validator)->withInput();
        }

        $order = new Order(request(['customer_id', 'title', 'description', 'cost']));
        $order->save();

        $order->tags()->attach(request('tags'));

        return redirect()->route('orders.edit', $order)->withMessage('Order created successfully.');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Order  $order
     * @return \Illuminate\Http\Response
     */
    public function show(Order $order)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Order  $order
     * @return \Illuminate\Http\Response
     */
    public function edit(Order $order)
    {
        return view('orders.edit', [
            'order' => $order,
            'customers' => Customer::all(),
            'tags' => Tag::all(),
            'extags' => $order->tags->pluck('id')->toArray()
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Order  $order
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Order $order)
    {
        $validator = $this->validateOrder($request);

        if ($validator->fails()) {
            return back()->withErrors($validator)->withInput();
        }
        $order->update(request(['customer_id', 'title', 'description', 'cost']));
        $order->tags()->sync(request('tags'));

        return view('orders.edit', [
            'order' => Order::whereId($order->id)->firstOrFail(),
            'customers' => Customer::all(),
            'tags' => Tag::all()
        ])->withMessage('Order updated successfully.');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Order  $order
     * @return \Illuminate\Http\Response
     */
    public function destroy(Order $order)
    {
        $order->delete();

        return redirect()->route('orders.index')->withMessage('Order deleted successfully');
    }

    protected function validateOrder(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'customer_id' => [
                'required',
                Rule::exists('customers', 'id')->where(function ($query) {
                    $query->where('deleted_at', null);
                }),
            ],
            'title' => 'min: 2 | max: 255 | required',
            'description' => 'required',
            'cost' => 'numeric | required',
            'tags' => 'exists:tags,id'
        ]);

        return $validator;

    }
}
