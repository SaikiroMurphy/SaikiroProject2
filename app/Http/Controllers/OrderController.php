<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreOrderDetailRequest;
use App\Models\Admin;
use App\Models\Field;
use App\Models\FieldType;
use App\Models\Order;
use App\Http\Requests\StoreOrderRequest;
use App\Http\Requests\UpdateOrderRequest;
use App\Models\OrderDetail;
use App\Models\Time;
use Carbon\Carbon;
use Illuminate\Support\Arr;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Session;

class OrderController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $details = OrderDetail::simplePaginate(5);
//        $datenow = Carbon::now()->format('d/m/y');
//        $now = Carbon::now()->format('H:i:s');
//        dd($datenow);
//        dd()
        return view('dashboard.orders', [
            'details'=> $details
        ]);
    }

    public function order() {
        $types = FieldType::all();
        $fields = Field::all();
        $datenow = Carbon::now('Asia/Ho_Chi_Minh')->format('Y-m-d');
//        $timenow = Carbon::now('Asia/Ho_Chi_Minh')->format('H:i:s');
//        $times = Time::where('timeStart', '>', $timenow)->get();
//        dd($datenow);

        return view('customers.orders', [
//            'times' => $times,
            'types' => $types,
            'fields' => $fields,
            'datenow' => $datenow
        ]);
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
     * @param  \App\Http\Requests\StoreOrderRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreOrderRequest $request)
    {
        // Đẩy orders lên database
        $customers = Session::get('customers')['id'];

        $array = [];
        $array = Arr::add($array, 'admin_id', random_int(1, Admin::count()));
        $array = Arr::add($array, 'customer_id', $customers);
        $array = Arr::add($array, 'order_note', $request -> order_note);
        $array = Arr::add($array, 'status', 0);
        $array = Arr::add($array, 'payment', $request -> payment);
        Order::create($array);

        // Đẩy order_details lên database
        $orders = Order::max('id');
        $array2 =[];
        $array2 = Arr::add($array2, 'order_id', $orders);
        $array2 = Arr::add($array2, 'field_id', $request -> fields);
        $array2 = Arr::add($array2, 'time_id', $request -> times);
        $array2 = Arr::add($array2, 'date', $request -> date);

        OrderDetail::create($array2);

        return Redirect::route('customers.history');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Order  $order
     * @return \Illuminate\Http\Response
     */
    public function show(Order $order)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Order  $order
     * @return \Illuminate\Http\Response
     */
    public function edit(Order $order)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\UpdateOrderRequest  $request
     * @param  \App\Models\Order  $order
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateOrderRequest $request, Order $order)
    {
        //
    }

    public function acceptOrder(Order $order)
    {
        // Cập nhật trạng thái đơn hàng
        $array = [];
        $array = Arr::add($array, 'status', 3);
        $order->update($array);
        return Redirect::route('dashboard.orders');
    }

    public function confirmOrder(Order $order)
    {
        // Cập nhật trạng thái đơn hàng
        $array = [];
        $array = Arr::add($array, 'status', 2);
        $order->update($array);
        return Redirect::route('dashboard.orders');
    }

    public function deniedOrder(Order $order)
    {
        // Cập nhật trạng thái đơn hàng
        $array = [];
        $array = Arr::add($array, 'status', 1);
        $order->update($array);
        return Redirect::route('dashboard.orders');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Order  $order
     * @return \Illuminate\Http\Response
     */
    public function destroy(Order $order)
    {
        //
    }

    public function getFields(\Illuminate\Http\Request $request) {
        $id  = $request -> id;
        $fields = Field::where('type_id', $id)->get();
        return response()->json($fields);
    }

    public function getImg(\Illuminate\Http\Request $request) {
        $id = $request -> id;
        $field = Field::where('id', '=', $id)->get();
        return response()->json($field);
    }

    public function getTimes2Day() {
        $timenow = Carbon::now('Asia/Ho_Chi_Minh')->format('H:i:s');
        $times = Time::where('timeStart', '>', $timenow)->get();
        return response()->json($times);
    }

    public function getTimesNextDay() {
        $times = Time::all();
        return response()->json($times);
    }

    public function getPrices(\Illuminate\Http\Request $request) {
        $id = $request -> id;
        $prices = FieldType::where('id', '=', $id)->get();
        return response()->json($prices);
    }

    public function checkTime(\Illuminate\Http\Request $request) {
        $field = $request -> field;
        $date = $request -> date;
        $time = $request -> time;
        $details = OrderDetail::where('field_id', '=', $field)
            ->where('time_id', '=', $time)
            ->where('date', '=', $date)
            ->get();
//        dd($details);
        return response()->json($details);
    }
}

//where('field_id', '=', $field)
//    -> with('orders') -> where('date', '=', $date)
//    -> where('time_id', '=', $time)
