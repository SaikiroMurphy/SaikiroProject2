<?php

namespace App\Http\Controllers;

use App\Models\Customer;
use App\Http\Requests\StoreCustomerRequest;
use App\Http\Requests\UpdateCustomerRequest;
use App\Models\Field;
use App\Models\FieldType;
use App\Models\Order;
use App\Models\OrderDetail;
use App\Models\Time;
use Illuminate\Http\Client\Request;
use Illuminate\Support\Arr;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Session;
use PhpParser\Node\Stmt\Return_;
use function Laravel\Prompts\alert;

class CustomerController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('customers.index');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('customers.register');
    }

    public function history()
    {
        if (Session::exists('customers')) {
            $details = null;
            $customers = Session::get('customers')['id'];
            $orders = Order::where('customer_id', '=', $customers)->pluck('id');
            $details = OrderDetail::whereIn('order_id', $orders)->get();
        }
        return view('customers.history', [
            'details' => $details
        ]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param \App\Http\Requests\StoreCustomerRequest $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreCustomerRequest $request)
    {
        $password = bcrypt($request->password);
        $array = [];
        $array = Arr::add($array, 'email', $request->email);
        $array = Arr::add($array, 'address', $request->address);
        $array = Arr::add($array, 'phonenumber', $request->phonenumber);
        $array = Arr::add($array, 'name', $request->name);
        $array = Arr::add($array, 'password', $password);
        Customer::create($array);
        return Redirect::route('customers.login');
    }

    /**
     * Display the specified resource.
     *
     * @param \App\Models\Customer $customers
     * @return \Illuminate\Http\Response
     */
    public function show(Customer $customers)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param \App\Models\Customer $customers
     * @return \Illuminate\Http\Response
     */
    public function edit(Customer $customers)
    {
        return view('customers.edit', [
            'customers' => $customers
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param \App\Http\Requests\UpdateCustomerRequest $request
     * @param \App\Models\Customer $customers
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateCustomerRequest $request, Customer $customers)
    {
        $password = bcrypt($request->password);
        $array = [];
        $array = Arr::add($array, 'name', $request->name);
        $array = Arr::add($array, 'address', $request->address);
        $array = Arr::add($array, 'phonenumber', $request->phonenumber);
        $array = Arr::add($array, 'email', $request->email);
        $array = Arr::add($array, 'password', $password);
        $customers->update($array);
        return Redirect::route('customers.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param \App\Models\Customer $customers
     * @return \Illuminate\Http\Response
     */
    public function destroy(Customer $customers, \Illuminate\Http\Request $request)
    {
        $del_cust = new Customer();
        $del_cust->id = $request->id;
        $del_cust->destroyCustomer();
        return Redirect::route('dashboard.customers');
    }

    public function login()
    {
        return view('customers.login');
    }

    public function loginProcess(\Illuminate\Http\Request $request)
    {
        $account = $request->except('_token');
        // Xác thực đăng nhập
        if (Auth::guard('customers')->attempt($account)) {
//        dd($check);
            // Cho login
            // Lấy thông tin customers
            $customers = Auth::guard('customers')->user();
            Auth::guard('customers')->login($customers);
            session(['customers' => $customers]);
            return Redirect::route('customers.index');
        } else {
            // Quay về trang login
            return Redirect::back();
        }
    }

    public function logout()
    {
        Auth::guard('customers')->logout();
        session()->forget('customers');
        return Redirect::route('customers.login');
    }


}
