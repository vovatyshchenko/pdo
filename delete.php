<?php
    namespace Academy;

    use Academy\Db;
    require_once __DIR__ . '/vendor/autoload.php';

    class Delete extends Db
    {
     
        public function isGet()
        {
            return $_SERVER['REQUEST_METHOD'] == 'GET';
        }

        public function getId()
        {
            if (empty($_GET['id']))
            {
                return "";
            }
            return $id = trim(strip_tags(htmlspecialchars($_GET['id'])));
        }

        public function Del()
        {
            $arr = ['id' => $this->getId()];
            $sql = "DELETE FROM `{$this->tableName}` WHERE `id` = :id";
            $stmt = $this->pdo->prepare($sql);
            $stmt->execute($arr);
            header("Location: /pdo/index.php");
        }
    }

    $deleteClass = new Delete();

    if( $deleteClass->isGet() )
    {
        $deleteClass->Del();
    }
    
