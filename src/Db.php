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
            $createAt = Date('Y-m-d H:i:s');
            $arr=[
                'val' => $data,
                'createAt' => $createAt
            ];
            $sql = "INSERT INTO `{$this->tableName}`(name,create_at) VALUES(:val,:createAt)";
            $stmt = $this->pdo->prepare($sql);
            return $stmt->execute($arr);
        }
    
        public function update($data)
        {
            $fields = $this->setFields($data);
            $sql = "UPDATE `{$this->tableName}` SET ".$fields.' WHERE id=:id';
    
            $stmt = $this->pdo->prepare( $sql );
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
    
        public function getCount( $where = [] )
        {
    
            $sql = "SELECT count(*) FROM {$this->tableName}";
            if( count( $where) > 0 ){
                $fields = $this->setFields($where, " AND ");
                $sql .= " WHERE ".$fields;
            }
    
            $smtp = $this->pdo->prepare($sql);
            $smtp->execute($where);
            $result = $smtp->fetch( PDO::FETCH_NUM );
    
            return (int)$result[0];
        }
    
        /*public function getAll($order = "id DESC")
        {
            $sql = "SELECT * FROM `{$this->tableName}` ORDER BY $order";
            $stmt = $this->pdo->prepare($sql);
            $stmt->execute();
            $result = $stmt->fetchAll();
            return $result;
        }*/

        public function getAll($order = "id DESC")
        {
        echo '<ul>';
        $sql = $this->pdo->query("SELECT * FROM `{$this->tableName}` ORDER BY $order");
        while ($row = $sql->fetch(PDO::FETCH_OBJ))
        {
            echo '<li>'.$row->name.'<a href="/delete.php?id='.$row->id.'"><button>Удалить</button></a></li>';
        }
        echo '</ul>';
        }
    
        /**
         * (new City())->getOne(['id' => 5])
         */
        public function getOne($where = [], $order = "id asc")
        {
            $sql = "SELECT * FROM `{$this->tableName}`";
            if( count( $where) > 0 ){
                $fields = $this->setFields($where, " AND ");
    
                $sql .= " WHERE ".$fields;
            }
            $sql .= " ORDER BY $order";
    
            $stmt = $this->pdo->prepare($sql);
            $stmt->execute($where);
            $result = $stmt->fetch();
            return $result;
    
        }
    }
