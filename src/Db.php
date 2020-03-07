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
            $data = time();
            $sql = "INSERT INTO `{$this->tableName}` VALUES(:val)";
            $stmt = $this->pdo->prepare($sql);
    
            return $stmt->execute(['val' => $value]);
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
    
        public function getAll($order = "id asc")
        {
            $sql = "SELECT * FROM `{$this->tableName}` ORDER BY $order";
            $stmt = $this->pdo->prepare($sql);
            $stmt->execute();
            $result = $stmt->fetchAll();
            return $result;
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
