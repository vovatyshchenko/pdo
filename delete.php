<?php
    use Academy\Db;
    require_once __DIR__ . '/vendor/autoload.php';

    class Delete
    {
        public function isGet()
        {
            return $_SERVER['REQUEST_METHOD'] == 'GET';
        }

        public function clearData($text)
	    {
            $text = trim(strip_tags(htmlspecialchars($text)));
            return $text;
        }
        
        public function getId()
        {
            if ($_SERVER['REQUEST_METHOD'] == 'GET')
            {
                if (!empty($GET['id']))
                {
                    return $id = $this->clearData($GET['id']);
                }
            }
            return "";
            
        }

        public function Del()
        {
            $arr = ['id' => $this->getId()];
            $sql = "DELETE FROM `{$this->tableName}` WHERE `id` = :id";
            $stmt = $this->pdo->prepare($sql);
            $stmt->execute($arr);
            return header("Location: /");
        }
    }

    $deleteClass = new Delete();

    if( $deleteClass->isGet() )
    {
        $deleteClass->Del();
    }
    
