<?php

namespace App\Http\Controllers\ajax;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class ChangeStatusController extends Controller
{
    public function changeStatus(Request $request)
    {
        $newStatus = $request->publish == 1 ? 2 : 1;

        $result = DB::table($request->field)
            ->where('id', $request->id)
            ->update([$request->column => $newStatus]);


        if($result) {
            return response()->json(['status' => 'success', 'message' => 'thanh cong'], 200);
        }
        return response()->json(['status' => 'error', 'message' => 'loi'], 400);
    }

    public function changeStatusAll(Request $request)
    {
        $newStatus = $request->option['value'] == 1 ? 2 : 1;
        $result = DB::table($request->option['field'])
            ->whereIn('id', $request->id)
            ->update([$request->option['column'] => $newStatus]);
        if($result) {
            return response()->json(['status' => 'success', 'message' => 'thanh cong'], 200);
        }
        return response()->json(['status' => 'error', 'message' => 'loi'], 400);
    }

    public function changeOrder(Request $request)
    {
        $newStatus = $request->value;
        $result = DB::table($request->field)
            ->where('id', $request->id)
            ->update(['order' => $newStatus]);
        if($result) {
            return response()->json(['status' => 'success', 'message' => 'thanh cong'], 200);
        }
        return response()->json(['status' => 'error', 'message' => 'loi'], 400);
    }
}
