<?php
    namespace Academy;
    
    use PDO;

    class Connect extends Config
    {
        /*public $host = 'localhost';
        public $user = 'root';
        public $password = '';
        public $db = 'test_db';
        public $charset = 'utf8';
        public $pdo = null;*/

        public function __construct()
        {
            $dsn = "mysql:host={$this->config['host']};dbname={$this->config['db']};charset={$this->config['charset']}";
            $opt = [
                PDO::ATTR_ERRMODE            => PDO::ERRMODE_EXCEPTION,
                PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
                PDO::ATTR_EMULATE_PREPARES   => false,
            ];
            
            $this->pdo = new PDO($dsn, $this->config['user'], $this->config['password'], $opt);
        }
    }
