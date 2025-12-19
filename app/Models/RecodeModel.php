<?php

class RecodeModel extends DatabaseModel
{
    // 検索条件のデータ取得
    // public function fetchSearchData(array $searchRequest)
    // {
    //     $startDate = $searchRequest['startDate'];
    //     $endDate = $searchRequest['endDate'];

    //     $sql = <<<EOT
    //         SELECT timestamp, product, direction, state, 
    //             bfs_1, sfs_1,
    //             bfs_2, sfs_2
    //         FROM `a-16`
    //         WHERE state = 'pass' 
    //             AND (timestamp BETWEEN :start_date AND :end_date)
    //             AND product <> 'tenken'
    //     EOT;

    //     $params = [
    //         ['placeholder' => ':start_date', 'value' => $startDate],
    //         ['placeholder' => ':end_date', 'value' => $endDate],
    //     ];

    //     return $this->fetchData($sql, $params);
    // }

    public function fetchSearchData(string $startDate, string $endDate, array $searchProduct)
    {
        $sql = <<<EOT
            SELECT timestamp, product, direction, state, 
                bfs_1, sfs_1,
                bfs_2, sfs_2
            FROM `a-16`
            WHERE state = ?
                AND (timestamp BETWEEN ? AND ?)
        EOT;

        $stmt = $this->dbh->prepare($sql);
        $stmt->execute([
            'pass',
            $startDate,
            $endDate
        ]);
        $result = $stmt->fetchAll(PDO::FETCH_ASSOC);
    }
}
