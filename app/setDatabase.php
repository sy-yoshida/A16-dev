<?php
// 追加で必要なテーブルを作成するコード
// 実行時にはターミナル(またはcmd上)に「C:\xampp\php\php.exe setDatabase.php」と入力して実行すること
// テーブル作成後はアプリの動作に影響しないので削除してもOK

$dbh = connectDatabase();
createTable($dbh);
setProductionData($dbh);

function connectDatabase(): PDO
{
    $hostname = "localhost";
    $username = "root";
    $password = "";
    $database = "leakdetector";

    return new PDO("mysql:host={$hostname};dbname={$database}", $username, $password);
}

function createTable(PDO $dbh)
{
    $dbh->query('DROP TABLE IF EXISTS production_table');

    $sql = <<<EOT
        CREATE TABLE IF NOT EXISTS production_table (
            id INT AUTO_INCREMENT PRIMARY KEY,
            name VARCHAR(255) NOT NULL,
            size INT(100) NOT NULL,
            material VARCHAR(100) NOT NULL,
            diameter VARCHAR(100) NOT NULL
        ) ENGINE=INNODB DEFAULT CHARSET=utf8mb4
    EOT;

    $dbh->query($sql);
    echo 'テーブル作成を完了しました' . PHP_EOL;
}

function setProductionData(PDO $dbh)
{
    $sql = <<<EOT
        INSERT INTO production_table (name, size, material, diameter)
        VALUES
            ('5UB50', 5, 'UB', '50'),
            ('5UB65', 5, 'UB', '65'),
            ('5UB80', 5, 'UB', '80'),
            ('5UB100', 5, 'UB', '100'),
            ('5UB125', 5, 'UB', '125'),
            ('5UB150', 5, 'UB', '150'),
            ('5UBM150', 5, 'UBM', '150'),
            ('10UB40', 10, 'UB', '40'),
            ('10UB50', 10, 'UB', '50'),
            ('10UB65', 10, 'UB', '65'),
            ('10UB80', 10, 'UB', '80'),
            ('10UB100', 10, 'UB', '100'),
            ('10UB125', 10, 'UB', '125'),
            ('10UB150', 10, 'UB', '150'),
            ('10UBM50', 10, 'UBM', '50'),
            ('10UBM65', 10, 'UBM', '65'),
            ('10UBM80', 10, 'UBM', '80'),
            ('10UBM100', 10, 'UBM', '100'),
            ('10UBM125', 10, 'UBM', '125'),
            ('10UBM150', 10, 'UBM', '150'),
            ('10UBO80', 10, 'UBO', '80'),
            ('10SHB50', 10, 'SHB', '50'),
            ('10SHB65', 10, 'SHB', '65'),
            ('10SHB80', 10, 'SHB', '80'),
            ('10SHB100', 10, 'SHB', '100'),
            ('10SHB125', 10, 'SHB', '125'),
            ('10SHB150', 10, 'SHB', '150'),
            ('10UHB50', 10, 'UHB', '50'),
            ('10UHB65', 10, 'UHB', '65'),
            ('10UHB80', 10, 'UHB', '80'),
            ('10UHB100', 10,  'UHB', '100'),
            ('10UHB125', 10, 'UHB', '125'),
            ('10UHB150', 10, 'UHB', '150'),
            ('10LURT50', 10, 'LURT', '50'),
            ('10LURT65', 10, 'LURT', '65'),
            ('10LURT80', 10, 'LURT', '80'),
            ('10LURT100', 10, 'LURT', '100'),
            ('10LURT125', 10, 'LURT', '125'),
            ('10LURT150', 10, 'LURT', '150'),
            ('16UB40', 16, 'UB', '40'),
            ('16UB50', 16, 'UB', '50'),
            ('16UB65', 16, 'UB', '65'),
            ('16UB80', 16, 'UB', '80'),
            ('16UB100', 16, 'UB', '100'),
            ('16UB125', 16, 'UB', '125'),
            ('16UB150', 16, 'UB', '150'),
            ('16SHB50', 16, 'SHB', '50'),
            ('16SHB65', 16, 'SHB', '65'),
            ('16SHB80', 16, 'SHB', '80'),
            ('16SHB100', 16, 'SHB', '100'),
            ('16SHB125', 16, 'SHB', '125'),
            ('16SHB150', 16, 'SHB', '150'),
            ('20UHB50', 20, 'UHB', '50'),
            ('20UHB65', 20, 'UHB', '65'),
            ('20UHB80', 20, 'UHB', '80'),
            ('20UHB100', 20, 'UHB', '100'),
            ('20UHB125', 20, 'UHB', '125'),
            ('20UHB150', 20, 'UHB', '150'),
            ('20LURT50', 20, 'LURT', '50'),
            ('20LURT65', 20, 'LURT', '65'),
            ('20LURT80', 20, 'LURT', '80'),
            ('20LURT100', 20, 'LURT', '100'),
            ('20LURT125', 20, 'LURT', '125'),
            ('20LURT150', 20, 'LURT', '150'),
            ('150UB2', 150, 'UB', '2'),
            ('150UB21/2', 150, 'UB', '21/2'),
            ('150UB3', 150, 'UB', '3'),
            ('150UB4', 150, 'UB', '4'),
            ('150UB5', 150, 'UB', '5'),
            ('150UB6', 150, 'UB', '6'),
            ('150UBM2', 150, 'UBM', '2'),
            ('150UBM21/2', 150, 'UBM', '21/2'),
            ('150UBM3', 150, 'UBM', '3'),
            ('150UBM4', 150, 'UBM', '4'),
            ('150UBM5', 150, 'UBM', '5'),
            ('150UBM6', 150, 'UBM', '6'),
            ('150UBSD2', 150, 'UBSD', '2'),
            ('150SHB2', 150, 'SHB', '2'),
            ('150SHB21/2', 150, 'SHB', '21/2'),
            ('150SHB3', 150, 'SHB', '3'),
            ('150SHB4', 150, 'SHB', '4'),
            ('150SHB5', 150, 'SHB', '5')
    EOT;

    $dbh->query($sql);
    echo 'データ登録を完了しました' . PHP_EOL;
}
