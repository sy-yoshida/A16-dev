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
        return $this->getSearchData($searchRequest);
    }

    private function getSearchData($searchRequest)
    {
        $startDate = $this->convertDate($searchRequest['startDate']);
        $endDate = $this->convertDate($searchRequest['endDate']);
        $searchProduct = $this->getSearchProducts($searchRequest['product']['filter']);
        return $this->recodeModel->fetchSearchData($startDate, $endDate, $searchProduct);
    }

    // ISO8601の日付データをデータベースに登録の日付型に変換する関数
    private function convertDate(string $iso8601,  string $format = 'Y-m-d H:i'): string
    {
        $date = new DateTime($iso8601);
        return $date->format($format);
    }

    // 検索条件から製品名を取得（直積で製品名を組み立てる）
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
