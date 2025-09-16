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
$start = intval($request['start']);
$length = intval($request['length']);
$draw = intval($request['draw']);
$search = $request['search']['value'];

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
$data = array_slice($data, $start, $length);
$data = array_map(function($d){
    $d = array_slice($d, 2);
    $d = array_values($d);
    for($i = 0; $i <= 19; $i++)
    {
        if(!isset($d[$i]))
        {
            $d[$i] = '';
        }
    }

    return $d;
}, $data);

echo json_encode([
    "draw" => $draw,
    "recordsTotal" => $recordsTotal,
    "recordsFiltered" => $recordsTotal,
    "data" => array_values($data)
]);
