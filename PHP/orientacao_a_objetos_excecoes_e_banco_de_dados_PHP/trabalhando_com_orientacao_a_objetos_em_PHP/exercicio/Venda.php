<?php

declare(strict_types=1);

class Venda
{
    /**
     * @var string
     */
    private $produto;

    /** 
     * @var string
     */
    private $data;

    /** 
     * @var int
     */
    private $quantidade;

    /** 
     * @var float
     */
    private $valorTotal;

    public function __construct(
        string $produto,
        string $data,
        int $quantidade,
        float $valorTotal
    ) {
        $this->produto = $produto;
        $this->data = $data;
        $this->quantidade = $quantidade;
        $this->valorTotal = $valorTotal;
    }

    public function exibir()
    {
        echo <<<TAG
            <h1>Venda</h1>
            <p>Produto: $this->produto<p>
            <p>Data: $this->data<p>
            <p>Quantidade: $this->quantidade<p>
            <p>Valor Total: R$ $this->valorTotal.<p>
        TAG;
    }
}

$venda = new Venda(
    'produto 01',
    (new DateTime())->format('d/m/Y H:i:s'),
    5,
    10.00
);

$venda->exibir();