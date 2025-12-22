<?php

class GraphService extends Service
{
    private RecodeModel $recodeModel;

    public function __construct(protected DatabaseManager $databaseManager)
    {
        parent::__construct($databaseManager);
        $this->recodeModel = $this->databaseManager->getModel('RecodeModel');
    }

    public function search(array $searchRequest)
    {
        $startDate = $this->convertDatabaseTime($searchRequest['startDate']);
        $endDate = $this->convertDatabaseTime($searchRequest['endDate']);
        $modes = $searchRequest['product']['mode'];
        $responseData = [];

        $measureData = $this->recodeModel->fetchMeasureData($startDate, $endDate);
        $responseData['measure'] = [
            'metadata' => ['startDate' => $startDate, 'endDate' => $endDate],
            'body' => $this->measureDataSort($measureData)
        ];

        foreach ($modes as $mode) {
            if ($mode === 'all') {
                // return $this->recodeModel->fetchAllData($startDate, $endDate);
            } elseif ($mode === 'material') {
                $resultMaterials = $this->recodeModel->fetchMaterialData($startDate, $endDate);
                $responseData[$mode] = $this->calcPassRate($resultMaterials, $mode);
            } elseif ($mode === 'diameter') {
                $resultDiameters = $this->recodeModel->fetchDiameterData($startDate, $endDate);
                $responseData[$mode] = $this->calcPassRate($resultDiameters, $mode);
            }
        }

        // ダミーデータ（導入時には削除すること）
        // $dummyData['material'] = [
        //     ['label' => 'UB', 'production_count' => 274, 'pass_rate' => 83],
        //     ['label' => 'UBM', 'production_count' => 122, 'pass_rate' => 90],
        //     ['label' => 'UBO', 'production_count' => 98, 'pass_rate' => 87],
        //     ['label' => 'SHB', 'production_count' => 156, 'pass_rate' => 24],
        //     ['label' => 'UHB', 'production_count' => 310, 'pass_rate' => 76],
        //     ['label' => 'LURT', 'production_count' => 212, 'pass_rate' => 69],
        //     ['label' => 'UBSD', 'production_count' => 12, 'pass_rate' => 100],
        // ];

        // $dummyData['diameter'] = [
        //     ['label' => '40', 'production_count' => 343, 'pass_rate' => 91],
        //     ['label' => '50', 'production_count' => 213, 'pass_rate' => 67],
        //     ['label' => '65', 'production_count' => 62, 'pass_rate' => 31],
        //     ['label' => '80', 'production_count' => 120, 'pass_rate' => 89],
        //     ['label' => '100', 'production_count' => 166, 'pass_rate' => 76],
        //     ['label' => '125', 'production_count' => 10, 'pass_rate' => 80],
        //     ['label' => '150', 'production_count' => 29, 'pass_rate' => 100],
        //     ['label' => '2', 'production_count' => 221, 'pass_rate' => 86],
        //     ['label' => '21/2', 'production_count' => 1, 'pass_rate' => 0],
        //     ['label' => '3', 'production_count' => 14, 'pass_rate' => 89],
        //     ['label' => '4', 'production_count' => 3, 'pass_rate' => 67],
        //     ['label' => '5', 'production_count' => 20, 'pass_rate' => 71],
        //     ['label' => '6', 'production_count' => 14, 'pass_rate' => 40],
        // ];
        // $responseData = $dummyData;

        return $responseData;
    }

    // 測定値データの整理を行う関数
    private function measureDataSort(array $measureData)
    {
        foreach ($measureData as $value) {
            $responseData[] = [
                'direction' => $value['direction'],
                'label' => $this->convertIso8601Time($value['timestamp']),
                'bfs' => $value['bfs'],
                'sfs' => $value['sfs'],
            ];
        }

        return $responseData;
    }

    // ISO8601の日付データをデータベースに登録の日付型に変換する関数
    private function convertDatabaseTime(string $iso8601,  string $format = 'Y-m-d H:i'): string
    {
        $date = new DateTime($iso8601);
        return $date->format($format);
    }

    // データベースに登録の日付型からISO8601日付型へ変換する関数
    private function convertIso8601Time(string $databaseDate)
    {
        $date = new DateTime($databaseDate, new DateTimeZone('Asia/Tokyo'));
        return $date->format(DateTime::ATOM);
    }

    // 製品情報のDB検索結果から良品率を算出して返す関数
    private function calcPassRate(array $elements, string $mode)
    {
        $responseData = [];
        foreach ($elements as $element) {
            $productionCount = $element['production_count'];
            $passCount = $element['pass_count'];
            $passRate = round((int) $passCount / (int) $productionCount * 100, 1);
            $responseData[] = [
                'label' => $element[$mode],
                'production_count' => $productionCount,
                'pass_rate' => $passRate
            ];
        }
        return $responseData;
    }

    // 検索条件から製品名を取得（直積で製品名を組み立てる）
    // ※ 使わないかも
    private function getSearchProducts(array $product)
    {
        $productName = [];
        foreach ($product['sizes'] as $size) {
            foreach ($product['materials'] as $material) {
                foreach ($product['Adiameters'] as $Adiameter) {
                    $productName[] = $size . $material . $Adiameter;
                }
                foreach ($product['Bdiameters'] as $Bdiameter) {
                    $productName[] = $size . $material . $Bdiameter;
                }
            }
        }
        return $productName;
    }
}
