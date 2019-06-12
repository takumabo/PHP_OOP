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
        $stmt = $this->db_manager->dbh->prepare('SELECT * FROM ' . $this->table . ' ORDER BY id DESC');
        $stmt->execute();
        $tasks = $stmt->fetchAll();
        return $tasks;
    }
    //新しく加えたものがデータに残るcreate関数を設定
    public function create($name){
        $stmt = $this->db_manager->dbh->prepare('INSERT INTO ' . $this->table . '(name) VALUES(?)');
        $stmt->execute([$name]);
    }

    // 更新ページに値を引っ張るget関数を設定
    public function get($id){
        $stmt = $this->db_manager->dbh->prepare('SELECT * FROM ' . $this->table . ' WHERE id = ?');
        $stmt->execute([$id]);
        $task = $stmt->fetch();
        return $task;
    }
    //updateボタンを押して、変更を加える時の関数
    public function update($name , $id){
        $stmt = $this->db_manager->dbh->prepare('UPDATE ' . $this->table . ' SET name = ? WHERE id = ?');
        $stmt->execute([$name,$id]);
        $task = $stmt->fetch();
        return $task;
    }

    //delete関数を設定
    public function delete($id){
        $stmt = $this->db_manager->dbh->prepare('DELETE FROM ' . $this->table . ' WHERE id = ?');
        $stmt->execute([$id]);
    }
}