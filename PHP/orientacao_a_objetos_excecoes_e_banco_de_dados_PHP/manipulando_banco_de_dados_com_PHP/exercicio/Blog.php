<?php

declare(strict_types=1);

class Blog
{
    /** 
     * @var PDO
     */
    private $pdo;

    public function __construct()
    {
        try{
            $this->pdo = new PDO('mysql:host=localhost;dbname=blog', 'Cliente', 'Cliente');
        } catch (PDOException $e){
            echo $e->getMessage();
        }
    }

    public function list(){
        $query = $this->pdo->query('SELECT * FROM posts');

        $posts = [];

        foreach($query as $value){
            array_push($posts, $value);
        }

        return $posts;
    }

    public function insert(string $nome, string $conteudo): int
    {
        $prepare = $this->pdo->prepare('INSERT INTO posts (nome, conteudo) VALUES (?,?)');
        $prepare->bindParam(1, $nome);
        $prepare->bindParam(2, $conteudo);
        $prepare->execute();
        return $prepare->rowCount();
    }

    public function update(int $id, string $nome = null, string $conteudo = null): int
    {
        if($nome == null){
            $pdo = $this->pdo->prepare('UPDATE posts SET conteudo = ? WHERE id = ?');
            $pdo->bindParam(1, $conteudo);
            $pdo->bindParam(2, $id);
        }else if($conteudo == null){
            $pdo = $this->pdo->prepare('UPDATE posts SET nome = ? WHERE id = ?');
            $pdo->bindParam(1, $nome);
            $pdo->bindParam(2, $id);
        }else{
            $pdo = $this->pdo->prepare('UPDATE posts SET nome = ?, conteudo = ? WHERE id = ?');
            $pdo->bindParam(1, $nome);
            $pdo->bindParam(2, $conteudo);
            $pdo->bindParam(3, $id);
        }

        $pdo->execute();
        return $pdo->rowCount();
    }

    public function delete(int $id): int
    {
        $pdo = $this->pdo->prepare('DELETE FROM posts WHERE id = ?');
        $pdo->bindParam(1, $id);
        $pdo->execute();
        return $pdo->rowCount();
    }
}