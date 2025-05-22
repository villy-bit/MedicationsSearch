<?

class DB
{
    private $conn;
    private PDOStatement $stmt;
    private static $instance = null;

    private function __construct() {}
    private function __clone(){}
    public function __wakeup() {}

    public static function getInstanse()
    {
        return 
        self::$instance===null
            ? self::$instance = new self()
            : self::$instance;
    }

    public function getConnection($db_config)
    {
        $dsn = "mysql:host={$db_config['host']};dbname={$db_config['db_name']};charset={$db_config['charset']}";
        try
        {
            $this->conn = new PDO($dsn, $db_config['username'], $db_config['pass'], $db_config['options']);
            return $this;
        } 
        catch (PDOException $e)
        {
           dump("ERROR: ".$e);
        }
    }
    public function query($sql, $params = [])
    {
        try
        {
            $this->stmt = $this->conn->prepare($sql);
            $this->stmt->execute($params);
        }
        catch (PDOException $e)
        {
            echo "DB Error: ". $e;
        }

        return $this;
    }

    public function findAll()
    {
        return $this->stmt->fetchAll();
    }
    
    public function find()
    {
        return $this->stmt->fetch();
    }

    public function findAOrbort()
    {
        $result = $this->find();
        if(!$result) { abort(); }
        return $result;
    }

    // public function insert($params=[]){
    //     $sql = "INSERT INTO post(title, excerpt, content, slug) VALUES (:title,:excerpt,:content,:slug)";
    //     if($this->query($sql,$params)){
    //         return true;
    //     }
    //     return false;
    // }

    public function getColum()
    {
        return $this->stmt->fetchColumn();
    }

    public function rowCount()
    {
        return $this->stmt->rowCount();
    }
}

?>