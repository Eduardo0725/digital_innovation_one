<?php

declare(strict_types=1);

class Produto
{
    /**
     * @var PDO
     */
    private $pdo;

    public function __construct()
    {
        try {
            $this->pdo = new PDO('mysql:host=localhost;dbname=exemplo', 'Cliente', 'Cliente');
        } catch (Exception $e) {
            echo $e->getMessage();
            die();
        }
    }

    public function list(): array
    {
        $sql = 'SELECT * FROM produtos';

        $produtos = [];

        // foreach ($this->pdo->query($sql) as $key => $value) {
        //     array_push($produtos, $value);
        // }

        foreach ($this->pdo->query($sql) as $value) {
            array_push($produtos, $value);
        }

        return $produtos;
    }

    public function insert(string $descricao): int
    {
        $sql = 'INSERT INTO produtos(descricao) VALUES(?)';

        $prepare = $this->pdo->prepare($sql);

        $prepare->bindParam(1, $descricao);
        $prepare->execute();

        return $prepare->rowCount();
    }

    public function update(string $descricao, int $id): int
    {
        $sql = 'UPDATE produtos SET descricao = ? WHERE id = ?';

        $prepare = $this->pdo->prepare($sql);

        $prepare->bindParam(1, $descricao);
        $prepare->bindParam(2, $id);

        $prepare->execute();

        return $prepare->rowCount();
    }

    public function delete(int $id): int
    {
        $sql = 'DELETE FROM produtos WHERE id = ?';

        $prepare = $this->pdo->prepare($sql);

        $prepare->bindParam(1, $id);

        $prepare->execute();

        return $prepare->rowCount();
    }
}
