<?php

namespace App\Http\Controllers\Admins;

use Exception;
use Carbon\Carbon;

use App\Models\traffic;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use Yajra\DataTables\DataTables;
use App\Http\Controllers\Controller;
use App\Models\type_traffic;
use App\Models\User;

class CarDetailController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        if ($request->ajax()) {

            $data = traffic::with(['type_traffic', 'user']);


            return DataTables::of($data)
                ->addColumn('action', function ($row) {
                    return '';
                })

                ->make(true);
        } else {
            $driver=User::get();
            $type_car=type_traffic::get();
            return view('admins.cardetail.index',['driver'=>$driver,'type_car'=>$type_car]);
        }
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create() {}

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        try {
            $data = [
                'name_car' => $request->name,
                'note' => $request->note,
                'status' => $request->status,
                'seri' => $request->seri,
                'user_id' => $request->user_id,
                'type_traffic_id' => $request->type_traffic_id

            ];
            if ($files = $request->file('avatar_car')) {
                $fileName = $files->getClientOriginalName();
                $fileExt = $files->getClientOriginalExtension();
                $fileName = Str::slug(pathinfo($fileName, PATHINFO_FILENAME)) . '-' . Carbon::now()->timestamp;
                $file_path = 'storage/images/car/' . $fileName . '.' . $fileExt;
                $files->move('storage/images/car/', $fileName . '.' . $fileExt);
            }
            $data['avatar_car']=$file_path;
            $data=traffic::create($data);

            return response()->json(['success' => 'đã thêm thành công'], 200);
        } catch (Exception $e) {
            return response()->json([
                'error' => 'thêm không thành công',
                'messages' => $e->getMessage()
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
