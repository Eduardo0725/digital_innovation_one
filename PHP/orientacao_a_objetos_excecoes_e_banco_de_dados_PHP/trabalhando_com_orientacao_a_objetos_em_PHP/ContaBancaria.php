<?php

declare(strict_types=1);

class ContaBancaria
{
    /**
     * @var string
     */
    private $banco;
    
    /**
     * @var string
     */
    private $nomeTitular;
    
    /**
     * @var string
     */
    private $numeroAgencia;
    
    /**
     * @var string
     */
    private $numeroConta;
    
    /**
     * @var float
     */
    private $saldo;

    public function __construct(
        string $banco, 
        string $nomeTitular, 
        string $numeroAgencia, 
        string $numeroConta, 
        float $saldo
    )
    {
        $this->banco = $banco;
        $this->nomeTitular = $nomeTitular;
        $this->numeroAgencia = $numeroAgencia;
        $this->numeroConta = $numeroConta;
        $this->saldo = $saldo;
    }

    public function obterSaldo(): string
    {
        return "Seu saldo atual é: R$ $this->saldo.";
    }

    public function depositar(float $valor): string
    {
        $this->saldo += $valor;
        return "Depósito de R$ $valor realizado!";
    }

    public function sacar(float $valor): string
    {
        $this->saldo -= $valor;
        return "Saque de R$ $valor realizado!";
    }
}

$conta = new ContaBancaria(
    'Banco do Brasil',//banco
    'Gustavo Fraga',//nomeTitular
    '8244',//numeroAgencia
    '57354-10',//numeroConta
    300.00//saldo
);

//echo PHP_EOL; //Quebra de linha (terminal).

echo $conta->obterSaldo();