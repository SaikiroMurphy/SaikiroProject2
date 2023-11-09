<?php

namespace App\Http\Controllers;

use App\Models\Field;
use App\Models\FieldType;
use App\Models\Order;
use App\Models\OrderDetail;
use App\Http\Requests\StoreOrderDetailRequest;
use App\Http\Requests\UpdateOrderDetailRequest;
use App\Models\Time;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Arr;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Session;

class OrderDetailController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
//        $details = OrderDetail::with('fields')
//            ->with('orders')
//            ->with('times');
//
//        return view('dashboard.orders', [
//            'details' =>  $details
//        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \App\Http\Requests\StoreOrderDetailRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreOrderDetailRequest $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\OrderDetail  $orderDetail
     * @return \Illuminate\Http\Response
     */
    public function show(OrderDetail $orderDetail)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\OrderDetail  $orderDetail
     * @return \Illuminate\Http\Response
     */
    public function edit(OrderDetail $details)
    {
//        dd($details);
        $times = Time::all();
        $types = FieldType::all();
        $fields = Field::all();
        $orders = Order::all();
        $datenow = Carbon::now('Asia/Ho_Chi_Minh')->format('Y-m-d');
//        dd($orders->date);
        return view('orders.edit', [
            'orders' => $orders,
            'details' => $details,
            'times' => $times,
            'types' => $types,
            'fields' => $fields,
            'datenow' => $datenow
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\UpdateOrderDetailRequest  $request
     * @param  \App\Models\OrderDetail  $orderDetail
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateOrderDetailRequest $request, OrderDetail $details, Order $orders)
    {
        // Đẩy order_details lên database
        $array2 =[];
        $array2 = Arr::add($array2, 'order_id', $request -> order_id);
        $array2 = Arr::add($array2, 'field_id', $request -> fields);
        $array2 = Arr::add($array2, 'time_id', $request -> times);
        $array2 = Arr::add($array2, 'date', $request -> date);
//        dd($array2);
        $details->update($array2);
//        OrderDetail::where('id', $request -> order_id)->update(['field_id' => $request -> fields]);

        // Đẩy orders lên database
//        $array = [];
//        $array = Arr::add($array, 'order_note', $request -> order_note);
//        dd($array);
//        $orders->update($array);
        Order::where('id', $request -> order_id)->update([
            'order_note' => $request -> order_note,
            'payment' => $request -> payment
        ]);

        return Redirect::route('dashboard.orders');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\OrderDetail  $orderDetail
     * @return \Illuminate\Http\Response
     */
    public function destroy(OrderDetail $orderDetail)
    {
        //
    }
}
