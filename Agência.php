<?php

$continuar = true;
$clientes = [];
const CHEQUE_ESPECIAL = 500;

do {

    menu();
    $opcao = trim(readline());

    switch ($opcao) {

        case '1':
            cadastrarCliente($clientes);
            break;

        case '2':
            cadastrarConta($clientes);
            break;

        case '3':
            depositar($clientes);
            break;

        case '4':
            sacar($clientes);
            break;

        case '5':
            consultarSaldo($clientes);
            break;

        case '6':
            consultarExtrato($clientes);
            break;

        case '0':
            print "Saindo... \n";
            $continuar = false;
            sleep(5);
            system('clear');
            die();

        default:
            print "opção inválida \n";
            break;
    }
} while ($continuar == true);


function menu()
{

    print("
    *******************************
    *       menu de usuário       *
    *******************************
    *   1 - Cadastrar usuário     *
    *   2 - Cadastrar conta       *
    *   3 - Depositar             *
    *   4 - Sacar                 *
    *   5 - Consultar saldo       *
    *   6 - Consultar extrato     *
    *******************************
    *   0 - Sair                  *
    *******************************
    \nEscolha uma opção: ");
}

function cadastrarCliente(&$clientes): bool
{

    $nome = readline('Informe seu nome: ');
    $cpf = readline('Informe seu CPF: ');

    if (isset($clientes[$cpf])) {
        print "Esse cpf já foi cadastrado \n";
        return false;
    }

    $clientes[$cpf] = [
        'nome' => $nome,
        'cpf' => $cpf,
        'contas' => []
    ];

    return true;
}

function cadastrarConta(array &$clientes): bool
{

    $cpf = readline('Informe seu CPF: ');

    if (!isset($clientes[$cpf])) {
        print "Cliente não possui cadastro \n";
        return false;
    }

    $numConta = rand(10000, 100000);

    $clientes[$cpf]['contas'][$numConta] = [
        'saldo' => 0,
        'cheque_especial' => CHEQUE_ESPECIAL,
        'extrato' => []
    ];

    print "Conta criada com sucesso!\n";
    print "O número da sua conta é: $numConta \n";
    return true;
}

function depositar(&$clientes): bool
{

    $cpf = readline("informe seu CPF novamente: ");

    $numConta = readline("informe o número da conta: ");

    $valorDepositado = (float) readline("informe o valor do depósito: ");

    if ($valorDepositado <= 0) {
        print "valor de depósito inválido\n";
        return false;
    }

    $clientes[$cpf]['contas'][$numConta]['saldo'] += $valorDepositado;

    $dataHora = date('d/m/Y H:i');

    $clientes[$cpf]['contas'][$numConta]['extrato'][] = "Depósito de R$ $valorDepositado em $dataHora";

    print "Depósito realizado com sucesso\n";
    return true;
}

function sacar(&$clientes)
{

    $cpf = readline("informe seu CPF: ");

    //validar CPF

    $numConta = readline('Informe o número da conta: ');
    $valorSaque = readline('Informe o valor do saque: ');

    if ($clientes[$cpf]['contas'][$numConta]['saldo'] >= $valorSaque) {

        $clientes[$cpf]['contas'][$numConta]['saldo'] -= $valorSaque;
        $dataHora = date('d/m/Y H:i');
        $clientes[$cpf]['contas'][$numConta]['extrato'][] = "Saque de R$ $valorSaque em $dataHora";

        print "Saque realizado com sucesso \n";


        return true;
    } else {

        print "O saque deve ser um valor menor ou igual ao que você têm na sua conta! \n";

        return false;
    }
}

function consultarSaldo(&$clientes)
{

    $cpf = readline("informe seu CPF: ");
    $numConta = readline('Informe o número da conta: ');

    $saldo = $clientes[$cpf]['contas'][$numConta]['saldo'];

    print("\nO seu saldo é de R$" . $saldo . ",00 \n");

    return true;
}

function consultarExtrato(&$clientes): bool
{

    $cpf = readline("informe seu CPF: ");
    $numConta = readline('Informe o número da conta: ');

    print "\n EXTRATO BANCÁRIO \n";

    foreach ($clientes[$cpf]['contas'][$numConta]['extrato'] as $extrato) {
        print "$extrato \n";
    }

    return true;
}