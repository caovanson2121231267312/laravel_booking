<?php

namespace App\Http\Controllers\Admins;

use Exception;
use App\Models\Order;
use App\Models\traffic;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
use function Laravel\Prompts\error;

use App\Http\Controllers\Controller;
use App\Models\CustomerType;
use App\Models\OrderDetail;
use Yajra\DataTables\Facades\DataTables;

class OrderController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        if ($request->ajax()) {
            $data = Order::with(['traffic'])->withCount('order_detail')->latest('id');



            return DataTables::of($data)
                ->addColumn('action', function ($row) {
                    return '';
                })
                ->editcolumn('created_at', function ($row) {
                    if ($row->created_at) {
                        return Carbon::parse($row->created_at)->format('H:i:s d-m-Y');
                    }
                })
                ->editcolumn('total_price', function ($row) {
                    if ($row->total_price) {
                        return number_format($row->total_price, 0, ',', '.') . " Đ";
                    }
                })
                ->editcolumn('price', function ($row) {
                    if ($row->price) {
                        return number_format($row->price, 0, ',', '.') . " Đ";
                    }
                })



                ->make(true);
        } else {
            $traffic = traffic::get();
            $customer_types = CustomerType::get();

            return view('admins.order.index', [
                'traffic' => $traffic,
                'customer_types' => $customer_types,
            ]);
        }
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        try {
            $data = [
                'start' => $request->start,
                'end' => $request->end,
                'price' => $request->price,
                'status_car' => $request->status_car,
                'status_payment' => $request->status_payment,
                'traffic_id' => $request->traffic
            ];
            $price = $request->price;

            $order = Order::create($data);

            $sum_price = 0;


            $arr_name_customer = $request->name_customer;
            $arr_phone_customer = $request->phone_customer;
            $arr_customer_type_id = $request->customer_type_id;
            $arr_note = $request->note;

            if (!empty($arr_name_customer) && !empty($arr_phone_customer) && !empty($arr_customer_type_id) && !empty($arr_note)) {
                foreach ($arr_name_customer as $key => $value) {

                    $data_type_customer = CustomerType::find($arr_customer_type_id[$key]);
                    $order_detail_price = ($price - ($price * $data_type_customer->discount) / 100);

                    $arr_update = [
                        'order_id' => $order->id,
                        'name_customer' => $arr_name_customer[$key],
                        'phone_customer' => $arr_phone_customer[$key],
                        'customer_type_id' => (int)$arr_customer_type_id[$key],
                        'note' => $arr_note[$key],
                        'price_person' => $order_detail_price,
                    ];
                    // dd($arr_update);

                    OrderDetail::create($arr_update);
                    // dd($request->all());

                    $sum_price += $order_detail_price;
                }
            }
            $order->update([
                'total_price' => $sum_price
            ]);

            return response()->json([
                'success' => 'tạo thành công'
            ], 200);
        } catch (Exception $e) {
            return response()->json([
                'error' => 'chưa tạo được',
                'messege' => $e->getMessage()
            ], 500);
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
