<?php
require_once('config/dbconnect.php');

class Todo{
    private $table = 'tasks';
    private $db_manager ;

    //初期値設定
    public function __construct(){
        //DbManagerクラスのインスタンス化
        $this->db_manager = new DbManager();
        //connect関数
        $this->db_manager->connect();
    }

    //indexに全要素を呼び出せるように関数allを設定
    public function all(){
        $stmt = $this->db_manager->dbh->prepare('SELECT * FROM ' . $this->table);
        $stmt->execute();
        $tasks = $stmt->fetchAll();
        return $tasks;
    }
    //新しく加えたものがデータに残るcreate関数を設定
    public function create($name){
        $stmt = $this->db_manager->dbh->prepare('INSERT INTO ' . $this->table . '(name) VALUES(?)');
        $stmt->execute([$name]);
    }
}