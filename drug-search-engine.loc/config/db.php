<?

return [
    'host' => 'MySQL-8.2',
    'db_name' => 'Medicaments_db',
    'username' => 'root',
    'pass' => '',
    'charset' => 'utf8', //utf8md4
    'options' => [
        // PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION, //до 8
        PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC, //массив с именами столбцов

    ]
];
?>
