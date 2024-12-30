<?php

namespace App\Http\Controllers;

use App\Models\Ekanban\ekanban_stock_limit;
// use Carbon\Carbon;
use Illuminate\Support\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Yajra\DataTables\Facades\DataTables;
use Illuminate\Support\Facades\Http;

class AndonChuterFgController extends Controller
{

    //
    public function indexold()
    {
        // Fetch the API data and ensure it's in array form
        $apiResponse = Http::get($apiUrl);

        // Convert API response to an array if it's not already
        $apiData = $apiResponse->json();

        if (is_object($apiData)) {
            $apiData = json_decode(json_encode($apiData), true); // Convert object to array
        }

        $apiOutput = $apiData['it_output'] ?? [];  // Ensure you're accessing 'it_output' as an array

        $mpname = Carbon::now()->format('Y-m');
        //$mpname = '09-2024';
        $stock_type = "F/G";
        $plant = "1701";
        $getdatamysql = Ekanban_stock_limit::select(
            DB::raw('MAX(ekanban_stock_limit.id) as id'),
            DB::raw('MAX(ekanban_stock_limit.chutter_address) as chutter_address'),
            DB::raw('MAX(ekanban_stock_limit.part_number) as part_number'),
            DB::raw('MAX(ekanban_stock_limit.part_name) as part_name'),
            DB::raw('MAX(ekanban_stock_limit.itemcode) as itemcode'),
            DB::raw('MAX(ekanban_stock_limit.min) as min'),
            DB::raw('MAX(ekanban_stock_limit.max) as max'),
            DB::raw('MAX(ekanban_stock_limit.cust_code) as cust_code')

        )
            ->where('ekanban_stock_limit.stock_type', $stock_type)
            ->where('ekanban_stock_limit.period', '=', $mpname)
            ->where('ekanban_stock_limit.is_active', '1')
            ->where('ekanban_stock_limit.plant', $plant)
            ->groupBy(
                'ekanban_stock_limit.itemcode'
            )
            ->get()
            ->toArray();
        //dd($getdatamysql);

        $getdata = collect();

        foreach ($getdatamysql as $eloquentItem) {
            // Make sure you are working with an array here
            $materialFromApi = collect($apiOutput)->firstWhere('material_no', $eloquentItem['itemcode']);

            if ($materialFromApi) {
                // Merge Eloquent data with API data
                $getdata->push([
                    'id' => $eloquentItem['id'],
                    'chutter_address' => $eloquentItem['chutter_address'],
                    'part_number' => $eloquentItem['part_number'],
                    'part_name' => $eloquentItem['part_name'],
                    'itemcode' => $eloquentItem['itemcode'],
                    'cust_code' => $eloquentItem['cust_code'],
                    'min' => $eloquentItem['min'],
                    'max' => $eloquentItem['max'],
                    'material_desc' => $materialFromApi['material_desc'],
                    'balance' => $materialFromApi['quantity'],
                    'satuan' => $materialFromApi['satuan']
                ]);
            } else {
                // If no match, include only Eloquent data (left join behavior)
                $getdata->push([
                    'id' => $eloquentItem['id'],
                    'chutter_address' => $eloquentItem['chutter_address'],
                    'part_number' => $eloquentItem['part_number'],
                    'part_name' => $eloquentItem['part_name'],
                    'itemcode' => $eloquentItem['itemcode'],
                    'cust_code' => $eloquentItem['cust_code'],
                    'min' => $eloquentItem['min'],
                    'max' => $eloquentItem['max'],
                    'material_desc' => null, // No API match
                    'balance' => null,      // No API match
                    'satuan' => null         // No API match
                ]);
            }
        }
        // Now you have $mergedData containing the left join result
        //dd($getdata);

        ################## GET DATA CUSTOMER GROUP #########################################################
        $groupedData = collect($getdata)->groupBy(function ($item) {
            if (in_array($item['cust_code'], ['A01', 'A05', 'G02', 'T06', 'I17'])) {
                return 'ADM';
            } elseif (in_array($item['cust_code'], ['H03', 'H06', 'H10', 'I15'])) {
                return 'HPM';
            } elseif (in_array($item['cust_code'], ['Y01', 'Y02', 'Y07', 'Y09', 'Y06'])) {
                return 'YIMM';
            } else {
                return 'OTHER';
            }
        });

        // Urutan yang diinginkan
        $orderedCustCodes = ['ADM', 'YIMM', 'HPM', 'OTHER'];

        // Urutkan berdasarkan urutan yang diinginkan
        $groupedData = $groupedData->sortBy(function ($value, $key) use ($orderedCustCodes) {
            return array_search($key, $orderedCustCodes);
        });


        // untuk menentukan grid pada carousel atau page
        //dd($groupedData);
        $groupGridpage = $groupedData->count();
        ################### GET DATA ALL FOR KONDISI #################################################
        // Total number of items
        $totalCount = count($getdata);
        //dd($totalCount);
        // Filter for KRITIS
        $getDatakritisFiltered = array_filter($getdata, function ($item) {
            return $item['balance'] < $item['min'];
        });

        // Filter for OVER
        $getDataoverFiltered = array_filter($getdata, function ($item) {
            return $item['balance'] > $item['max'];
        });

        // Filter for OK
        $getDataokFiltered = array_filter($getdata, function ($item) {
            return $item['balance'] >= $item['min'] && $item['balance'] <= $item['max'];
        });

        // Count the results
        $countKritis = count($getDatakritisFiltered);
        $countOver = count($getDataoverFiltered);
        $countOk = count($getDataokFiltered);

        // Calculate percentages
        $percentKritis = ($totalCount > 0) ? ($countKritis / $totalCount) * 100 : 0;
        $percentOver = ($totalCount > 0) ? ($countOver / $totalCount) * 100 : 0;
        $percentOk = ($totalCount > 0) ? ($countOk / $totalCount) * 100 : 0;


        ##################### GET DATA CUST CALCULASI ########################
        $carouselDataitemcode = [];
        $chartData = [];

        $kritisCounts = [];
        $overCounts = [];
        $okCounts = [];
        $totalCounts = [];

        // Iterate through each group and filter data
        foreach ($groupedData as $custCode => $items) {
            $totalCount = count($items); // Total data in the group

            // Filter for KRITIS, OVER, and OK conditions
            $kritisFiltered = $items->filter(function ($item) {
                return $item['balance'] < $item['min'];
            });

            $overFiltered = $items->filter(function ($item) {
                return $item['balance'] > $item['max'];
            });

            $okFiltered = $items->filter(function ($item) {
                return $item['balance'] >= $item['min'] && $item['balance'] <= $item['max'];
            });

            // Count the filtered results
            $kritisCount = $kritisFiltered->count();
            $overCount = $overFiltered->count();
            $okCount = $okFiltered->count();

            // Store counts and total counts for each group
            $kritisCounts[$custCode] = $kritisCount;
            $overCounts[$custCode] = $overCount;
            $okCounts[$custCode] = $okCount;
            $totalCounts[$custCode] = $totalCount;

            // Calculate percentages
            $kritisPercentage = $totalCount > 0 ? ($kritisCount / $totalCount) * 100 : 0;
            $overPercentage = $totalCount > 0 ? ($overCount / $totalCount) * 100 : 0;
            $okPercentage = $totalCount > 0 ? ($okCount / $totalCount) * 100 : 0;

            // Prepare chart data
            $chartData[$custCode] = [
                'kritis' => $kritisPercentage,
                'over' => $overPercentage,
                'ok' => $okPercentage
            ];

            // Prepare data for carousel
            $carouselDataitemcode[] = [
                'cust_code' => $custCode,
                'items' => $items->toArray()
            ];
        }

        // contents in 1 page
        $carouselPages = array_chunk($carouselDataitemcode, 3);

        // Ordered cust codes and percentages
        $orderedCustCodes = ['ADM', 'YIMM', 'HPM', 'OTHER'];
        $orderedPercentages = [];
        foreach ($orderedCustCodes as $code) {
            if (isset($chartData[$code])) {
                $orderedPercentages[$code] = $chartData[$code];
            }
        }

        // dd($orderedPercentages);
        // return $results;
        // dd($carouselPages);
        // Pass the results to the view
        return view('andon-dashboard-chuterfg.index', [
            'percentKritis' => round($percentKritis, 2),
            'percentOver' => round($percentOver, 2),
            'percentOk' => round($percentOk, 2),
            'carouselDataitemcode' => $carouselDataitemcode,
            'percentages' => $orderedPercentages, // Pass carousel data to the view
            // 'results' => $results,
            'carouselPages' => $carouselPages,
            'groupGridpage' => $groupGridpage,
            'chartData' => $chartData // Pass carousel data to the view
        ]);
    }

    public function index()
    {
        $getUrl = config('app.sap_get_stock_all');
        $username = config('app.user_sap');
        $password = config('app.pass_sap');
        $time_limit = config('app.timeout_ex');
        $apiUrl = $getUrl . '&PLANT=1701&SLOC=1110';
        // Fetch the API data and ensure it's in array form
        $apiResponse = Http::withBasicAuth($username, $password)->timeout($time_limit)->get($apiUrl);

        // Convert API response to an array if it's not already
        $apiData = $apiResponse->json();

        if (is_object($apiData)) {
            $apiData = json_decode(json_encode($apiData), true); // Convert object to array
        }

        $apiOutput = $apiData['it_output'] ?? [];  // Ensure you're accessing 'it_output' as an array

        $mpname = Carbon::now()->format('Y-m');
        $stock_type = "F/G";
        $plant = "1701";

        // Get the MySQL data
        $getdatamysql = Ekanban_stock_limit::select(
            DB::raw('MAX(ekanban_stock_limit.id) as id'),
            DB::raw('MAX(ekanban_stock_limit.chutter_address) as chutter_address'),
            DB::raw('MAX(ekanban_stock_limit.part_number) as part_number'),
            DB::raw('MAX(ekanban_stock_limit.part_name) as part_name'),
            DB::raw('MAX(ekanban_stock_limit.itemcode) as itemcode'),
            DB::raw('MAX(ekanban_stock_limit.min) as min'),
            DB::raw('MAX(ekanban_stock_limit.max) as max'),
            DB::raw('MAX(ekanban_stock_limit.period) as period'),
            DB::raw('MAX(ekanban_stock_limit.cust_code) as cust_code'),
            DB::raw('MAX(ekanban_stock_limit.action_date) as action_date') // Mengambil action_date terakhir
        )
            ->where('ekanban_stock_limit.stock_type', $stock_type)
            ->where('ekanban_stock_limit.is_active', '1')
            ->where('ekanban_stock_limit.plant', $plant)
            ->groupBy('ekanban_stock_limit.itemcode')
            ->orderBy('action_date', 'desc') // Urutkan berdasarkan action_date
            ->get()
            ->toArray();

        $getdata = collect();
        // dd($getdatamysql);
        // Mengambil data periode terakhir dari array hasil
        $getPeriod = collect($getdatamysql)
            ->pluck('period') // Ambil semua nilai period
            ->sortDesc()      // Urutkan secara menurun
            ->first();        // Ambil nilai pertama (terakhir dalam urutan period)
        // dd($getPeriod);

        // Ubah period menjadi nama bulan dalam bentuk teks
        $formattedPeriod = Carbon::parse($getPeriod)->translatedFormat('F Y');

        foreach ($getdatamysql as $eloquentItem) {
            $materialFromApi = collect($apiOutput)->firstWhere('material_no', $eloquentItem['itemcode']);

            if ($materialFromApi) {
                // Merge Eloquent data with API data
                $getdata->push([
                    'id' => $eloquentItem['id'],
                    'chutter_address' => $eloquentItem['chutter_address'],
                    'part_number' => $eloquentItem['part_number'],
                    'part_name' => $eloquentItem['part_name'],
                    'itemcode' => $eloquentItem['itemcode'],
                    'cust_code' => $eloquentItem['cust_code'],
                    'min' => $eloquentItem['min'],
                    'max' => $eloquentItem['max'],
                    'material_desc' => $materialFromApi['material_desc'],
                    'balance' => $materialFromApi['quantity'],
                    'satuan' => $materialFromApi['satuan'],
                    'quantity_plant' => $materialFromApi['quantity_plant']
                ]);
            } else {
                // If no match, include only Eloquent data (left join behavior)
                $getdata->push([
                    'id' => $eloquentItem['id'],
                    'chutter_address' => $eloquentItem['chutter_address'],
                    'part_number' => $eloquentItem['part_number'],
                    'part_name' => $eloquentItem['part_name'],
                    'itemcode' => $eloquentItem['itemcode'],
                    'cust_code' => $eloquentItem['cust_code'],
                    'min' => $eloquentItem['min'],
                    'max' => $eloquentItem['max'],
                    'material_desc' => null, // No API match
                    'balance' => 0,      // No API match
                    'satuan' => null,       // No API match
                    'quantity_plant' => 0
                ]);
            }
        }
        // dd($getdata);
        ################## GET DATA CUSTOMER GROUP #########################################################
        $groupedData = $getdata->groupBy(function ($item) {
            if (in_array($item['cust_code'], ['A01', 'A05', 'G02', 'T06', 'I17'])) {
                return 'ADM';
            } elseif (in_array($item['cust_code'], ['H03', 'H06', 'H10', 'I15'])) {
                return 'HPM';
            } elseif (in_array($item['cust_code'], ['Y01', 'Y02', 'Y07', 'Y09', 'Y06'])) {
                return 'YIMM';
            } else {
                return 'OTHER';
            }
        });
        // Urutan yang diinginkan
        $orderedCustCodes = ['YIMM', 'ADM', 'HPM', 'OTHER'];

        // Urutkan berdasarkan urutan yang diinginkan
        $groupedData = $groupedData->sortBy(function ($value, $key) use ($orderedCustCodes) {
            return array_search($key, $orderedCustCodes);
        });
        // dd($groupedData);
        ################### GET DATA ALL FOR KONDISI #################################################

        // Total number of items
        $totalCount = $getdata->count();

        ############# GET DATA KRITIS,OVER AND OK FOR BALANCE##############
        // Filter for KRITIS
        $getDatakritisFiltered = $getdata->filter(function ($item) {
            return $item['balance'] < $item['min'];
        });

        // Filter for OVER
        $getDataoverFiltered = $getdata->filter(function ($item) {
            return $item['balance'] > $item['max'];
        });

        // Filter for OK
        $getDataokFiltered = $getdata->filter(function ($item) {
            return $item['balance'] >= $item['min'] && $item['balance'] <= $item['max'];
        });
        // dd($getDataokFiltered);

        // Count the results
        $countKritis = $getDatakritisFiltered->count();
        $countOver = $getDataoverFiltered->count();
        $countOk = $getDataokFiltered->count();

        // Calculate percentages
        $percentKritis = ($totalCount > 0) ? ($countKritis / $totalCount) * 100 : 0;
        $percentOver = ($totalCount > 0) ? ($countOver / $totalCount) * 100 : 0;
        $percentOk = ($totalCount > 0) ? ($countOk / $totalCount) * 100 : 0;

        ##################### GET DATA CUST CALCULASI ########################

        $carouselDataitemcode = [];
        $chartData = [];
        $chartDataangka = [];

        $chart_number_qty_plant = [];
        $chart_percent_qty_plant = [];
        foreach ($groupedData as $custCode => $items) {
            $totalCount = $items->count(); // Total data in the group
            // dd($totalCount);
            ############# GET DATA KRITIS,OVER AND OK FOR BALANCE##############
            // Filter for KRITIS, OVER, and OK FOR BALANCE
            $kritisFiltered = $items->filter(function ($item) {
                return $item['balance'] < $item['min'];
            });
            // dd($kritisFiltered);

            $overFiltered = $items->filter(function ($item) {
                return $item['balance'] > $item['max'];
            });

            $okFiltered = $items->filter(function ($item) {
                return $item['balance'] >= $item['min'] && $item['balance'] <= $item['max'];
            });

            // Count the filtered results
            $kritisCount = $kritisFiltered->count();
            $overCount = $overFiltered->count();
            $okCount = $okFiltered->count();

            // Calculate percentages
            $kritisPercentage = $totalCount > 0 ? ($kritisCount / $totalCount) * 100 : 0;
            $overPercentage = $totalCount > 0 ? ($overCount / $totalCount) * 100 : 0;
            $okPercentage = $totalCount > 0 ? ($okCount / $totalCount) * 100 : 0;
            // Prepare chart data
            $chartData[$custCode] = [
                'kritis' => $kritisPercentage,
                'over' => $overPercentage,
                'ok' => $okPercentage
            ];
            $chartDataangka[$custCode] = [
                'kritis' => $kritisCount,
                'over' => $overCount,
                'ok' => $okCount
            ];

            ############# GET DATA KRITIS,OVER AND OK FOR QTY PLANT ##############
            // Filter for KRITIS, OVER, and OK for qty plant
            $kritisFilter = $items->filter(function ($item) {
                return $item['quantity_plant'] < $item['min'];
            });
            // dd($kritisFilter);
            $overFilter = $items->filter(function ($item) {
                return $item['quantity_plant'] > $item['max'];
            });

            $okFilter = $items->filter(function ($item) {
                return $item['quantity_plant'] >= $item['min'] && $item['quantity_plant'] <= $item['max'];
            });

            // Count the filtered results
            $kritisQtyplant = $kritisFilter->count();
            $overQtyplant = $overFilter->count();
            $okQtyplant = $okFilter->count();

            // Calculate percentages
            $kritis_percentage_qty_plant = $totalCount > 0 ? ($kritisQtyplant / $totalCount) * 100 : 0;
            $over_percentage_qty_plant = $totalCount > 0 ? ($overQtyplant / $totalCount) * 100 : 0;
            $ok_percentage_qty_plant = $totalCount > 0 ? ($okQtyplant / $totalCount) * 100 : 0;
            // Prepare chart data
            $chart_percent_qty_plant[$custCode] = [
                'kritis' => $kritis_percentage_qty_plant,
                'over' => $over_percentage_qty_plant,
                'ok' => $ok_percentage_qty_plant
            ];
            $chart_number_qty_plant[$custCode] = [
                'kritis' => $kritisQtyplant,
                'over' => $overQtyplant,
                'ok' => $okQtyplant
            ];
            // dd($chart_number_qty_plant);

            // Prepare data for carousel
            $carouselDataitemcode[] = [
                'cust_code' => $custCode,
                'items' => $items->toArray()
            ];
        }


        // dd($chart_number_qty_plant);
        // contents in 1 page
        $carouselPages = array_chunk($carouselDataitemcode, 3);

        // Ordered cust codes and percentages
        $orderedPercentages = [];
        foreach ($orderedCustCodes as $code) {
            if (isset($chartData[$code])) {
                $orderedPercentages[$code] = $chartData[$code];
            }
        }

        // Ordered cust codes and percentages
        $data_percent_qty_plant = [];
        foreach ($orderedCustCodes as $code) {
            if (isset($chart_percent_qty_plant[$code])) {
                $data_percent_qty_plant[$code] = $chart_percent_qty_plant[$code];
            }
        }
        // dd($orderedPercentages);

        // Return data to the view
        return view('andon-dashboard-chuterfg.index', [
            'percentKritis' => round($percentKritis, 2),
            'percentOver' => round($percentOver, 2),
            'percentOk' => round($percentOk, 2),
            'carouselDataitemcode' => $carouselDataitemcode,
            'percentages' => $orderedPercentages,
            'data_percent_qty_plant' => $data_percent_qty_plant,
            'carouselPages' => $carouselPages,
            'groupGridpage' => $groupedData->count(),
            'chartData' => $chartData,
            'chartDataangka' => $chartDataangka,
            'chart_number_qty_plant' => $chart_number_qty_plant,
            'formattedPeriod' => $formattedPeriod
        ]);
    }


    // public function getDatastatus()
    // {
    //     date_default_timezone_set('Asia/Jakarta');

    //     $mpname = Carbon::now()->format('m-Y');

    //     $getdata = Ekanban_stock_limit::select(
    //         DB::raw('MAX(ekanban_stock_limit.id) as id'),
    //         DB::raw('MAX(ekanban_stock_limit.chutter_address) as chutter_address'),
    //         DB::raw('MAX(ekanban_stock_limit.part_number) as part_number'),
    //         DB::raw('MAX(ekanban_stock_limit.part_name) as part_name'),
    //         DB::raw('MAX(ekanban_stock_limit.itemcode) as itemcode'),
    //         DB::raw('MAX(ekanban_stock_limit.min) as min'),
    //         DB::raw('MAX(ekanban_stock_limit.max) as max'),
    //         DB::raw('MAX(ekanban_fg_tbl.balance) as balance')

    //     )
    //         ->leftJoin('ekanban_fg_tbl', function ($join) {
    //             $join->on('ekanban_stock_limit.itemcode', '=', 'ekanban_fg_tbl.item_code');
    //         })

    //         ->where('ekanban_fg_tbl.mpname', '=', $mpname)
    //         ->where('ekanban_stock_limit.is_active', '1')
    //         ->orderByDesc('ekanban_stock_limit.action_date')
    //         ->groupBy('ekanban_stock_limit.itemcode')
    //         ->get()
    //         ->toArray();

    //     $totalCount = count($getdata);

    //     $getDatakritisFiltered = array_filter($getdata, function ($item) {
    //         return $item['balance'] < $item['min'];
    //     });

    //     $getDataoverFiltered = array_filter($getdata, function ($item) {
    //         return $item['balance'] > $item['max'];
    //     });

    //     $getDataokFiltered = array_filter($getdata, function ($item) {
    //         return $item['balance'] >= $item['min'] && $item['balance'] <= $item['max'];
    //     });

    //     $countKritis = count($getDatakritisFiltered);
    //     $countOver = count($getDataoverFiltered);
    //     $countOk = count($getDataokFiltered);

    //     $percentKritis = ($totalCount > 0) ? ($countKritis / $totalCount) * 100 : 0;
    //     $percentOver = ($totalCount > 0) ? ($countOver / $totalCount) * 100 : 0;
    //     $percentOk = ($totalCount > 0) ? ($countOk / $totalCount) * 100 : 0;

    //     return response()->json([
    //         'percentKritis' => round($percentKritis, 2),
    //         'percentOver' => round($percentOver, 2),
    //         'percentOk' => round($percentOk, 2),
    //     ]);
    // }

    // public function getDatakritis(Request $request)
    // {
    //     // dd($request);
    //     {
    //         date_default_timezone_set('Asia/Jakarta');
    //         $mpname = Carbon::now()->format('m-Y');
    //         $stock_type = "F/G";
    //         $getdata = Ekanban_stock_limit::select(
    //             DB::raw('MAX(ekanban_stock_limit.id) as id'),
    //             DB::raw('MAX(ekanban_stock_limit.chutter_address) as chutter_address'),
    //             DB::raw('MAX(ekanban_stock_limit.part_number) as part_number'),
    //             DB::raw('MAX(ekanban_stock_limit.part_name) as part_name'),
    //             DB::raw('MAX(ekanban_stock_limit.itemcode) as itemcode'),
    //             DB::raw('MAX(ekanban_stock_limit.min) as min'),
    //             DB::raw('MAX(ekanban_stock_limit.max) as max'),
    //             DB::raw('MAX(ekanban_fg_tbl.balance) as balance')
    //         )
    //             ->leftJoin('ekanban_fg_tbl', function ($join) {
    //                 $join->on('ekanban_stock_limit.itemcode', '=', 'ekanban_fg_tbl.item_code');
    //             })

    //             ->where('ekanban_fg_tbl.mpname', '=', $mpname)
    //             ->where('ekanban_stock_limit.is_active', '1')
    //             ->where('ekanban_stock_limit.stock_type', $stock_type)
    //             ->orderByDesc('ekanban_stock_limit.action_date')
    //             ->groupBy('ekanban_stock_limit.itemcode')
    //             ->get()
    //             ->toArray();
    //         // dd($getdata);

    //         // Filter untuk balance < min
    //         $getDatakritisFiltered = array_filter($getdata, function ($item) {
    //             return $item['balance'] < $item['min'];
    //         });

    //         // dd($getDatakritisFiltered);
    //         return DataTables::of($getDatakritisFiltered)->make(true);
    //     }
    // }

    // public function getaDataover(Request $request)
    // {
    //     // dd($request);
    //     {
    //         date_default_timezone_set('Asia/Jakarta');
    //         $mpname = Carbon::now()->format('m-Y');
    //         $stock_type = "F/G";
    //         $getdata = Ekanban_stock_limit::select(
    //             DB::raw('MAX(ekanban_stock_limit.id) as id'),
    //             DB::raw('MAX(ekanban_stock_limit.chutter_address) as chutter_address'),
    //             DB::raw('MAX(ekanban_stock_limit.part_number) as part_number'),
    //             DB::raw('MAX(ekanban_stock_limit.part_name) as part_name'),
    //             DB::raw('MAX(ekanban_stock_limit.itemcode) as itemcode'),
    //             DB::raw('MAX(ekanban_stock_limit.min) as min'),
    //             DB::raw('MAX(ekanban_stock_limit.max) as max'),
    //             DB::raw('MAX(ekanban_fg_tbl.balance) as balance')
    //         )
    //             ->leftJoin('ekanban_fg_tbl', function ($join) {
    //                 $join->on('ekanban_stock_limit.itemcode', '=', 'ekanban_fg_tbl.item_code');
    //             })

    //             ->where('ekanban_fg_tbl.mpname', '=', $mpname)
    //             ->where('ekanban_stock_limit.is_active', '1')
    //             ->where('ekanban_stock_limit.stock_type', $stock_type)
    //             ->orderByDesc('ekanban_stock_limit.action_date')
    //             ->groupBy('ekanban_stock_limit.itemcode')
    //             ->get()
    //             ->toArray();
    //         // dd($getdata);

    //         // Filter untuk balance < min
    //         $getDatakritisFiltered = array_filter($getdata, function ($item) {
    //             return $item['balance'] > $item['min'];
    //         });

    //         // dd($getDatakritisFiltered);
    //         return DataTables::of($getDatakritisFiltered)->make(true);
    //     }
    // }
}
