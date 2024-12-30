<?php

namespace App\Http\Controllers;

use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;
use App\Models\Ekanban\ekanban_stock_limit;
use App\Models\Ekanban\ekanban_stock_limit_rm;
use Illuminate\Support\Facades\DB;

class AndonChuterRmController extends Controller
{
    //
    public function index()
    {

        $getUrl = config('app.sap_get_stock_all');
        $username = config('app.user_sap');
        $password = config('app.pass_sap');
        $time_limit = config('app.timeout_ex');
        $apiUrl = $getUrl . '&PLANT=1701&SLOC=1010';
        // Fetch the API data and ensure it's in array form
        $apiResponse = Http::withBasicAuth($username, $password)->timeout($time_limit)->get($apiUrl);

        // Convert API response to an array if it's not already
        $apiData = $apiResponse->json();

        if (is_object($apiData)) {
            $apiData = json_decode(json_encode($apiData), true); // Convert object to array
        }
        // dd($apiData);
        $apiOutput = $apiData['it_output'] ?? [];

        // $mpname = Carbon::now()->format('Y-m');
        $stock_type = "R/M";
        $plant = "1701";
        $getdatamysql = ekanban_stock_limit_rm::select(
            DB::raw('MAX(ekanban_stock_limit_rm.id) as id'),
            DB::raw('MAX(ekanban_stock_limit_rm.chutter_address) as chutter_address'),
            DB::raw('MAX(ekanban_stock_limit_rm.part_number) as part_number'),
            DB::raw('MAX(ekanban_stock_limit_rm.part_name) as part_name'),
            DB::raw('MAX(ekanban_stock_limit_rm.itemcode) as itemcode'),
            DB::raw('MAX(ekanban_stock_limit_rm.min) as min'),
            DB::raw('MAX(ekanban_stock_limit_rm.max) as max'),
            DB::raw('MAX(ekanban_stock_limit_rm.period) as period'),
            DB::raw('MAX(ekanban_stock_limit_rm.cust_code) as cust_code'),
            DB::raw('MAX(ekanban_stock_limit_rm.action_date) as action_date') // Mengambil action_date terakhir
        )
            ->where('ekanban_stock_limit_rm.stock_type', $stock_type)
            ->where('ekanban_stock_limit_rm.is_active', '1')
            ->where('ekanban_stock_limit_rm.plant', $plant)
            ->groupBy('ekanban_stock_limit_rm.itemcode')
            ->orderBy('action_date', 'desc') // Urutkan berdasarkan action_date
            ->get()
            ->toArray();


        $getdata = collect();
        // dd($getdata);
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
        // Data yang didapatkan dari hasil dd($getdata)
        // Mengubah $getdata menjadi array
        $items = $getdata->toArray();
        // dd($items);
        // Total number of items
        $totalCount = $getdata->count();

        // dd($totalCount);
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


        $groupedData = $getdata->groupBy(function ($item) {
            $itemcode = $item['itemcode'];

            if (str_starts_with($itemcode, '21.A') || str_starts_with($itemcode, '22.ADM')) {
                return 'PIPE';
            } elseif (str_starts_with($itemcode, '21.B')) {
                return 'PLATE';
            } elseif (str_starts_with($itemcode, '21.C')) {
                return 'COIL';
            } elseif (str_starts_with($itemcode, '21.D')) {
                return 'BAR';
            }
        });
        // Urutan yang diinginkan
        $orderedCustCodes = ['PIPE', 'PLATE', 'COIL', 'BAR'];

        // Urutkan berdasarkan urutan yang diinginkan
        $groupedData = $groupedData->sortBy(function ($value, $key) use ($orderedCustCodes) {
            return array_search($key, $orderedCustCodes);
        });
        // dd($groupedData);


        ##################### GET DATA CUST CALCULASI ########################
        $carouselDataitemcode = [];
        $chartData = [];
        $chartDataangka = [];

        foreach ($groupedData as $type => $items) {
            $totalCount = $items->count(); // Total data in the group

            // Inisialisasi counter
            $kritisCount = 0;
            $overCount = 0;
            $okCount = 0;

            // Loop melalui setiap item dan tentukan kategorinya satu kali
            foreach ($items as $item) {
                if ($item['balance'] < $item['min']) {
                    $kritisCount++;
                } elseif ($item['balance'] > $item['max']) {
                    $overCount++;
                } else {
                    $okCount++;
                }
            }

            // Validasi total count
            if ($kritisCount + $overCount + $okCount !== $totalCount) {
                throw new \Exception("Jumlah kategori tidak sesuai dengan total item untuk grup $type");
            }

            // Menghitung persentase
            $kritisPercentage = $totalCount > 0 ? ($kritisCount / $totalCount) * 100 : 0;
            $overPercentage = $totalCount > 0 ? ($overCount / $totalCount) * 100 : 0;
            $okPercentage = $totalCount > 0 ? ($okCount / $totalCount) * 100 : 0;

            // Memasukkan data ke dalam array hasil
            $chartData[$type] = [
                'kritis' => $kritisPercentage,
                'over' => $overPercentage,
                'ok' => $okPercentage
            ];

            $chartDataangka[$type] = [
                'kritis' => $kritisCount,
                'over' => $overCount,
                'ok' => $okCount
            ];

            $carouselDataitemcode[] = [
                'type' => $type,
                'total' => $totalCount,
                'ok' => $okCount,
                'ok_percentage' => $totalCount > 0 ? ($okCount / $totalCount) * 100 : 0,
                'over' => $overCount,
                'over_percentage' => $totalCount > 0 ? ($overCount / $totalCount) * 100 : 0,
                'kritis' => $kritisCount,
                'kritis_percentage' => $totalCount > 0 ? ($kritisCount / $totalCount) * 100 : 0,
                'items' => $items->toArray()
            ];
        }

        // Membagi halaman carousel
        $carouselPages = array_chunk($carouselDataitemcode, 4);
        // dd($carouselPages);

        return view('andon-dashboard-chuterrm.index', [
            'carouselPages' => $carouselPages,
            'percentKritis' => round($percentKritis, 2),
            'percentOver' => round($percentOver, 2),
            'percentOk' => round($percentOk, 2),
            'groupGridpage' => $groupedData->count(),
            'formattedPeriod' => $formattedPeriod
        ]);
    }

    public function get_data_cust(Request $request)
    {
        // Debug: Periksa seluruh request
        // dd($request);

        // Mendapatkan nilai 'process' dari request
        $process = $request->process;

        // Tentukan nilai $itemcode berdasarkan nilai $process
        if ($process == 'PIPE') {
            $itemcode = "21.A";
        } elseif ($process == 'PLATE') {
            $itemcode = "21.B";
        } elseif ($process == 'COIL') {
            $itemcode = "21.C";
        } elseif ($process == 'BAR') {
            $itemcode = "21.D";
        } else {
            // Default value jika $process tidak sesuai dengan nilai yang diinginkan
            $itemcode = "Unknown";
        }
        // dd($itemcode);

        $getUrl = config('app.sap_get_stock_all');
        $username = config('app.user_sap');
        $password = config('app.pass_sap');
        $time_limit = config('app.timeout_ex');
        $apiUrl = $getUrl . '&PLANT=1701&SLOC=1010';
        // Fetch the API data and ensure it's in array form
        $apiResponse = Http::withBasicAuth($username, $password)->timeout($time_limit)->get($apiUrl);

        // Convert API response to an array if it's not already
        $apiData = $apiResponse->json();

        if (is_object($apiData)) {
            $apiData = json_decode(json_encode($apiData), true); // Convert object to array
        }
        // dd($apiData);
        $apiOutput = $apiData['it_output'] ?? [];

        // $mpname = Carbon::now()->format('Y-m');
        $stock_type = "R/M";
        $plant = "1701";
        $getdatamysql = ekanban_stock_limit_rm::select(
            'ekanban_stock_limit_rm.itemcode',
            DB::raw('MAX(ekanban_stock_limit_rm.id) as id'),
            DB::raw('MAX(ekanban_stock_limit_rm.chutter_address) as chutter_address'),
            DB::raw('MAX(ekanban_stock_limit_rm.part_number) as part_number'),
            DB::raw('MAX(ekanban_stock_limit_rm.part_name) as part_name'),
            DB::raw('MAX(ekanban_stock_limit_rm.min) as min'),
            DB::raw('MAX(ekanban_stock_limit_rm.max) as max'),
            DB::raw('MAX(ekanban_stock_limit_rm.period) as period'),
            DB::raw('MAX(ekanban_stock_limit_rm.cust_code) as cust_code'),
            DB::raw('MAX(ekanban_stock_limit_rm.action_date) as action_date') // Mengambil action_date terakhir
        )
            ->where('ekanban_stock_limit_rm.stock_type', $stock_type)
            ->where('ekanban_stock_limit_rm.is_active', '1')
            ->where('ekanban_stock_limit_rm.itemcode', 'LIKE', "%{$itemcode}%") // Perbaiki sintaks LIKE
            ->where('ekanban_stock_limit_rm.plant', $plant)
            ->groupBy('ekanban_stock_limit_rm.itemcode') // Group hanya berdasarkan itemcode
            ->orderBy(DB::raw('MAX(ekanban_stock_limit_rm.action_date)'), 'desc') // Mengurutkan berdasarkan MAX(action_date)
            ->get()
            ->toArray();


        $getdata = collect();
        // dd($getdatamysql);
        // Mengambil data periode terakhir dari array hasil
        $getPeriod = collect($getdatamysql)
            ->pluck('period') // Ambil semua nilai period
            ->sortDesc()      // Urutkan secara menurun
            ->first();

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

        $groupedData = $getdata->groupBy(function ($item) {
            $itemcode = $item['cust_code'];

            if (str_starts_with($itemcode, 'PBM')) {
                return 'PBM';
            } elseif (str_starts_with($itemcode, 'CIREBON')) {
                return 'CRB';
            } elseif (str_starts_with($itemcode, 'CIKARANG')) {
                return 'CKR';
            }
        });


        $carouselDataitemcode = [];
        $chartData = [];
        $chartDataangka = [];

        foreach ($groupedData as $cust => $items) {
            $totalCount = $items->count(); // Total data in the group

            // Inisialisasi counter
            $kritisCount = 0;
            $overCount = 0;
            $okCount = 0;

            // Loop melalui setiap item dan tentukan kategorinya satu kali
            foreach ($items as $item) {
                if ($item['balance'] < $item['min']) {
                    $kritisCount++;
                } elseif ($item['balance'] > $item['max']) {
                    $overCount++;
                } else {
                    $okCount++;
                }
            }

            // Validasi total count
            if ($kritisCount + $overCount + $okCount !== $totalCount) {
                throw new \Exception("Jumlah kategori tidak sesuai dengan total item untuk grup $cust");
            }

            // Menghitung persentase
            $kritisPercentage = $totalCount > 0 ? ($kritisCount / $totalCount) * 100 : 0;
            $overPercentage = $totalCount > 0 ? ($overCount / $totalCount) * 100 : 0;
            $okPercentage = $totalCount > 0 ? ($okCount / $totalCount) * 100 : 0;

            // Memasukkan data ke dalam array hasil
            $chartData[$cust] = [
                'kritis' => $kritisPercentage,
                'over' => $overPercentage,
                'ok' => $okPercentage
            ];

            $chartDataangka[$cust] = [
                'kritis' => $kritisCount,
                'over' => $overCount,
                'ok' => $okCount
            ];

            $carouselDataitemcode[] = [
                'cust' => $cust,
                'total' => $totalCount,
                'ok' => $okCount,
                'ok_percentage' => $totalCount > 0 ? ($okCount / $totalCount) * 100 : 0,
                'over' => $overCount,
                'over_percentage' => $totalCount > 0 ? ($overCount / $totalCount) * 100 : 0,
                'kritis' => $kritisCount,
                'kritis_percentage' => $totalCount > 0 ? ($kritisCount / $totalCount) * 100 : 0,
                'items' => $items->toArray()
            ];
        }

        // Membagi halaman carousel
        $carouselPages = array_chunk($carouselDataitemcode, 3);

        return response()->json([
            'carouselPages1' => $carouselPages, // Data halaman carousel
            'groupGridpage1' => $groupedData->count(), // Jumlah grup
        ]);
    }
}
