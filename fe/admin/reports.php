<?php

$client = new Google_Client();
$client->useApplicationDefaultCredentials();
$client->addScope(Google_Service_Sheets::SPREADSHEETS_READONLY);

$service = new Google_Service_Sheets($client);

// Ganti dengan ID Spreadsheet kamu (lihat di URL)
$spreadsheetId = env('SPREADSHEET_ID');
$sheetName = "Sheet1";
// Range data
// $range = "{$sheetName}!A{$start}:Z{$end}";
$range = "$sheetName";
$response = $service->spreadsheets_values->get($spreadsheetId, $range);
$values = $response->getValues();

?>

<?php loadFile('fe/partials/header') ?>
    <div class="app-content">
        <div class="content-wrapper">
            <div class="container">
                <div class="row">
                    <div class="col">
                        <div class="card">
                            <div class="card-header">
                                <h2 class="card-title">Data</h2>
                            </div>
                            <div class="card-body">
                                <?php if (!empty($values)): ?>
                                    <table id="datatable1" class="display" style="width:100%">
                                        <thead>
                                            <?php foreach ($values as $index => $row): ?>
                                            <tr>
                                                <?php foreach ($row as $cell): ?>
                                                    <td><?= htmlspecialchars($cell) ?></td>
                                                <?php endforeach; ?>
                                            </tr>
                                            <?php break; endforeach; ?>
                                        </thead>
                                        <tbody>
                                            <?php $no = 1; foreach ($values as $index => $row): ?>
                                                <?php if($index == 0 || (auth()['level'] == 'supplier' && $row[3] != auth()['code'])) continue; ?>
                                                <tr>
                                                    <td><?=$no++?></td>
                                                    <?php foreach ($row as $col => $cell): if($col == 0) continue ?>
                                                        <td><?= htmlspecialchars($cell) ?></td>
                                                    <?php endforeach; ?>
                                                </tr>
                                            <?php endforeach; ?>
                                        </tbody>
                                    </table>
                                <?php else: ?>
                                    <p>Tidak ada data pada halaman ini.</p>
                                <?php endif; ?>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
<?php loadFile('fe/partials/footer', implode(' ', [
    '<script src="assets/plugins/datatables/datatables.min.js"></script>',
    '<script src="assets/js/pages/datatables.js"></script>'
])) ?>