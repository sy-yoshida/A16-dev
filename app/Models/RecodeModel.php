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

    public function fetchAllData(string $startDate, string $endDate)
    {
        $sql = <<<EOT
            SELECT
                product,
                direction,
                COUNT(*) AS production_count,
                SUM(CASE WHEN state = 'pass' THEN 1 ELSE 0 END) AS pass_count
            FROM `a-16`
            WHERE state IN ('pass', 'kensa_err_1', 'kensa_err_2', 'bfs_err_1', 'sfs_err_1', 'bfs_err_2', 'sfs_err_2')
                AND (timestamp BETWEEN :start_date AND :end_date)
                AND product <> 'tenken'
            GROUP BY product, direction
        EOT;

        $params = [
            ['placeholder' => ':start_date', 'value' => $startDate],
            ['placeholder' => ':end_date', 'value' => $endDate],
        ];

        return $this->fetchData($sql, $params);
    }

    // 微漏れ・大漏れFSの測定値を取得
    public function fetchMeasureData(string $startDate, string $endDate)
    {
        $sql = <<<EOT
            SELECT timestamp, product, direction, state, bfs_1, sfs_1
            FROM `a-16`
            WHERE state IN ('pass', 'kensa_err_1', 'bfs_err_1', 'sfs_err_1')
                AND (timestamp BETWEEN :start_date AND :end_date)
                AND direction = 'one'
        EOT;

        $params = [
            ['placeholder' => ':start_date', 'value' => $startDate],
            ['placeholder' => ':end_date', 'value' => $endDate],
        ];

        return $this->fetchData($sql, $params);
    }

    // 材質ごとに生産数と良品数を取得
    public function fetchMaterialData(string $startDate, string $endDate)
    {
        $sql = <<<EOT
            SELECT
                products.material,
                COUNT(*) AS production_count,
                SUM(CASE WHEN state = 'pass' THEN 1 ELSE 0 END) AS pass_count
            FROM `a-16`
            INNER JOIN production_table AS products
                ON `a-16`.product = products.name
            WHERE state IN ('pass', 'kensa_err_1', 'kensa_err_2', 'bfs_err_1', 'sfs_err_1', 'bfs_err_2', 'sfs_err_2')
                AND (timestamp BETWEEN :start_date AND :end_date)
                AND `a-16`.product <> 'tenken'
                GROUP BY products.material;
        EOT;

        $params = [
            ['placeholder' => ':start_date', 'value' => $startDate],
            ['placeholder' => ':end_date', 'value' => $endDate],
        ];

        return $this->fetchData($sql, $params);
    }

    // 口径ごとに生産数と良品数を取得
    public function fetchDiameterData(string $startDate, string $endDate)
    {
        $sql = <<<EOT
            SELECT
                products.diameter,
                COUNT(*) AS production_count,
                SUM(CASE WHEN state = 'pass' THEN 1 ELSE 0 END) AS pass_count
            FROM `a-16`
            INNER JOIN production_table AS products
                ON `a-16`.product = products.name
            WHERE state IN ('pass', 'kensa_err_1', 'kensa_err_2', 'bfs_err_1', 'sfs_err_1', 'bfs_err_2', 'sfs_err_2')
                AND (timestamp BETWEEN :start_date AND :end_date)
                AND `a-16`.product <> 'tenken'
                GROUP BY products.diameter;
        EOT;

        $params = [
            ['placeholder' => ':start_date', 'value' => $startDate],
            ['placeholder' => ':end_date', 'value' => $endDate],
        ];

        return $this->fetchData($sql, $params);
    }
}
