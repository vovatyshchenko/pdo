<?php
    namespace Academy;

    use PDO;

    class Db extends Connect
    {
        public $tableName = 'books';

        /**
         * добавление записи в таблицу
         * @param array $data массив данных для сохранения
         * @return Boolen
         */
        public function insert($data)
    {
        $data['create_at'] = Date('Y-m-d H:i:s');
        $fields = $this->setFields($data);
        $sql = "INSERT INTO `{$this->tableName}` SET ".$fields;
        $stmt = $this->pdo->prepare($sql);
        return $stmt->execute($data);
    }
    
        public function setFields( $items, $delimiter = "," ){
            $str = [];
            if(empty($items)) return "";
            foreach ($items as $key=>$item){
                $str[] = "`".$key."`=:".$key;
            }
            return implode($delimiter, $str );
        }
    
        public function getAll($order = "id DESC")
        {
        echo '<ul class="list-group">';
        $sql = $this->pdo->query("SELECT * FROM `{$this->tableName}` ORDER BY $order");
        while ($row = $sql->fetch(PDO::FETCH_OBJ))
        {
            echo '<li class="list-group-item">'.'название книги: '.$row->name.'<br>'.'автор книги: '.$row->author.'<a href="delete.php?id='.$row->id.'"><button type="button" class="btn btn-danger ml-5">Удалить</button></a>'.'</li>';
        }
        echo '</ul>';
        }
    }
