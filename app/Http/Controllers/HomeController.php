<?php

namespace App\Http\Controllers;

use App\Models\Ekanban\ekanban_stock_limit;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Http;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        // $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        date_default_timezone_set('Asia/Jakarta');
        $mpname = Carbon::now()->format('m-Y');

        $getdata = Ekanban_stock_limit::select(
            DB::raw('MAX(ekanban_stock_limit.id) as id'),
            DB::raw('MAX(ekanban_stock_limit.chutter_address) as chutter_address'),
            DB::raw('MAX(ekanban_stock_limit.part_number) as part_number'),
            DB::raw('MAX(ekanban_stock_limit.part_name) as part_name'),
            DB::raw('MAX(ekanban_stock_limit.itemcode) as itemcode'),
            DB::raw('MAX(ekanban_stock_limit.min) as min'),
            DB::raw('MAX(ekanban_stock_limit.max) as max'),
            DB::raw('MAX(ekanban_fg_tbl.balance) as balance')
        )
            ->leftJoin('ekanban_fg_tbl', function ($join) {
                $join->on('ekanban_stock_limit.itemcode', '=', 'ekanban_fg_tbl.item_code');
            })
            ->where('ekanban_fg_tbl.mpname', '=', $mpname)
            ->where('ekanban_stock_limit.is_active', '1')
            ->orderByDesc('ekanban_stock_limit.action_date')
            ->groupBy('ekanban_stock_limit.itemcode')
            ->get()
            ->toArray();

        $totalCount = count($getdata);

        $getDatakritisFiltered = array_filter($getdata, function ($item) {
            return $item['balance'] < $item['min'];
        });

        $getDataoverFiltered = array_filter($getdata, function ($item) {
            return $item['balance'] > $item['max'];
        });

        $getDataokFiltered = array_filter($getdata, function ($item) {
            return $item['balance'] >= $item['min'] && $item['balance'] <= $item['max'];
        });

        $countKritis = count($getDatakritisFiltered);
        $countOver = count($getDataoverFiltered);
        $countOk = count($getDataokFiltered);

        $percentKritis = ($totalCount > 0) ? ($countKritis / $totalCount) * 100 : 0;
        $percentOver = ($totalCount > 0) ? ($countOver / $totalCount) * 100 : 0;
        $percentOk = ($totalCount > 0) ? ($countOk / $totalCount) * 100 : 0;

        return view('home', [
            'percentKritis' => round($percentKritis, 2),
            'percentOver' => round($percentOver, 2),
            'percentOk' => round($percentOk, 2),
        ]);
    }

    public function fetchStockLimitData()
    {
        date_default_timezone_set('Asia/Jakarta');

        $mpname = Carbon::now()->format('m-Y');

        $getdata = Ekanban_stock_limit::select(
            DB::raw('MAX(ekanban_stock_limit.id) as id'),
            DB::raw('MAX(ekanban_stock_limit.chutter_address) as chutter_address'),
            DB::raw('MAX(ekanban_stock_limit.part_number) as part_number'),
            DB::raw('MAX(ekanban_stock_limit.part_name) as part_name'),
            DB::raw('MAX(ekanban_stock_limit.itemcode) as itemcode'),
            DB::raw('MAX(ekanban_stock_limit.min) as min'),
            DB::raw('MAX(ekanban_stock_limit.max) as max'),
            DB::raw('MAX(ekanban_fg_tbl.balance) as balance')

        )
            ->leftJoin('ekanban_fg_tbl', function ($join) {
                $join->on('ekanban_stock_limit.itemcode', '=', 'ekanban_fg_tbl.item_code');
            })

            ->where('ekanban_fg_tbl.mpname', '=', $mpname)
            ->where('ekanban_stock_limit.is_active', '1')
            ->orderByDesc('ekanban_stock_limit.action_date')
            ->groupBy('ekanban_stock_limit.itemcode')
            ->get()
            ->toArray();

        $totalCount = count($getdata);

        $getDatakritisFiltered = array_filter($getdata, function ($item) {
            return $item['balance'] < $item['min'];
        });

        $getDataoverFiltered = array_filter($getdata, function ($item) {
            return $item['balance'] > $item['max'];
        });

        $getDataokFiltered = array_filter($getdata, function ($item) {
            return $item['balance'] >= $item['min'] && $item['balance'] <= $item['max'];
        });

        $countKritis = count($getDatakritisFiltered);
        $countOver = count($getDataoverFiltered);
        $countOk = count($getDataokFiltered);

        $percentKritis = ($totalCount > 0) ? ($countKritis / $totalCount) * 100 : 0;
        $percentOver = ($totalCount > 0) ? ($countOver / $totalCount) * 100 : 0;
        $percentOk = ($totalCount > 0) ? ($countOk / $totalCount) * 100 : 0;

        return response()->json([
            'percentKritis' => round($percentKritis, 2),
            'percentOver' => round($percentOver, 2),
            'percentOk' => round($percentOk, 2),
        ]);
    }
}