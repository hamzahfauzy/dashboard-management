<?php

$cacheFile = 'cache/' . date('d-m-Y') . '.json';

if(file_exists($cacheFile))
{
    $data = json_decode(file_get_contents($cacheFile));
}
else
{
    $client = new Google_Client();
    $client->useApplicationDefaultCredentials();
    $client->addScope(Google_Service_Sheets::SPREADSHEETS_READONLY);
    
    $service = new Google_Service_Sheets($client);
    
    // Ganti dengan ID Spreadsheet kamu (lihat di URL)
    $spreadsheetId = env('SPREADSHEET_ID');
    $sheetName = "REKAP PEMBELIAN";
    // Range data
    // $range = "{$sheetName}!A{$start}:Z{$end}";
    $range = "$sheetName";
    $response = $service->spreadsheets_values->get($spreadsheetId, $range);
    $data = $response->getValues();

    file_put_contents($cacheFile, json_encode($data));
}

$data = array_slice($data, 18);
$data = array_values($data);

$request = $_GET;
$auth = auth();
if($auth['level'] == 'supplier' || (isset($_GET['filter']['supplier_group']) && !empty($_GET['filter']['supplier_group']) ))
{
    $code = $auth['level'] == 'supplier' ? $auth['code'] : $_GET['filter']['supplier_group'];
    $data = array_filter($data, function ($row) use ($code) {
        return $row[8] == $code;
    });
}

unset($_GET['filter']['supplier_group']);

if(isset($_GET['filter']))
{
    $filter = $_GET['filter'];
    $isFilter = false;
    foreach($filter as $param)
    {
        if(!empty($param))
        {
            $isFilter = true;
            break;
        }
    }

    if($isFilter)
    {
        $no_kendaraan = $filter['no_kendaraan'];
        $nama_supplier = $filter['nama_supplier'];
        $tanggalAwal = $filter['tanggal_awal'];
        $tanggalAkhir = $filter['tanggal_akhir'];
        $driver = $filter['driver'];

        $data = array_filter($data, function ($row) use ($no_kendaraan, $nama_supplier, $tanggalAwal, $tanggalAkhir, $driver) {

            $row_no     = $row[6]  ?? '';
            $row_driver = $row[7]  ?? '';
            $row_date   = $row[2] ? strtotime(DateTime::createFromFormat('d/m/Y', $row[2])->format('Y-m-d')) : '';
            $row_supplier = $row[9] ?? '';

            // gunakan AND: kalau filter diisi tapi tidak match -> reject (return false)
            if ($no_kendaraan !== '' && stripos($row_no, $no_kendaraan) === false) {
                return false;
            }
            if ($nama_supplier !== '' && stripos($row_supplier, $nama_supplier) === false) {
                return false;
            }
            if (($tanggalAwal !== '' && $tanggalAkhir !== '' && $row_date !== '') && !($row_date >= strtotime($tanggalAwal) && $row_date <= strtotime($tanggalAkhir))) {
                return false;
            }
            if ($driver !== '' && stripos($row_driver, $driver) === false) {
                return false;
            }

            // semua kondisi yang diisi lolos -> include
            return true;
        });
    }
}

$recordsTotal = count($data);

$columns = [
    'Bruto' => 11,
    'Tara' => 12,
    'Netto 1' => 13,
    'Potongan' => 14,
    'Netto 2' => 15,
];

$bruto = array_values(array_column($data, 11));
$tara = array_values(array_column($data, 12));
$netto_1 = array_values(array_column($data, 13));
$potongan = array_values(array_column($data, 14));
$netto_2 = array_values(array_column($data, 15));

function parseToInt($arr)
{
    $arr = str_replace(',00','',$arr);
    $arr = str_replace('.','',$arr);
    return (int) $arr;
}

echo json_encode([
    "data" => [
        'total_data' => $recordsTotal,
        'total_bruto' => number_format(array_sum(array_map('parseToInt', $bruto))),
        'total_tara' => number_format(array_sum(array_map('parseToInt', $tara))),
        'total_netto_1' => number_format(array_sum(array_map('parseToInt', $netto_1))),
        'total_potongan' => number_format(array_sum(array_map('parseToInt', $potongan))),
        'total_netto_2' => number_format(array_sum(array_map('parseToInt', $netto_2))),
    ]
]);
