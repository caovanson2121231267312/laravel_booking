<?php

namespace App\Http\Controllers\Admins;

use App\Models\type_traffic;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
use App\Http\Controllers\Controller;
use Exception;
use Yajra\DataTables\Facades\DataTables;

class TrafficCarController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        if ($request->ajax()) {

            $data = type_traffic::get();
            return DataTables::of($data)
            ->addColumn('action', function ($row) {
                return '';
            })
            ->editColumn('created_at', function ($row) {
                // dd($row);
                if (!empty($row->created_at)) {
                    return Carbon::parse($row->created_at)->format('d-m-Y');
                }
                return '';
            })
            ->make(true);
        } else {
            return view('admins.car.index');
        }
    }

    /**
     * Show the form for creating a new resource.
     */
    public function addcar(Request $request)
    {
        try{
            $data = type_traffic::create([
                'name'=>$request->name
            ]);
            return response()->json(['success'=>'đã thêm thành công'], 200);
        }
        catch(Exception $e){
            return response()->json([
                'error'=>'sai thoonng tin',
                'messages' => $e->getMessage()
            ], 500);
        }
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function showcar(string $id)
    {
        $data= type_traffic::find($id);
        return view('admins.car.show',['data'=>$data]);
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
    public function editcar(Request $request, string $id)
    {

        try{
            $data = type_traffic::find($id);
            $data->update([
                'name'=>$request->name
            ]);
            return response()->json(['success'=>'đã sửa thành công'], 200);
        }
        catch(Exception $e){
            return response()->json([
                'error'=>'sai thoonng tin',
                'messages' => $e->getMessage()
            ], 500);
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        try{
            $data = type_traffic::find($id);
            $data->delete();
            return response()->json(['success'=>'đã xóa thành công'], 200);
        }
        catch(Exception $e){
            return response()->json([
                'error'=>'chưa xóa được',
                'messages' => $e->getMessage()
            ], 500);
        }
    }
}
