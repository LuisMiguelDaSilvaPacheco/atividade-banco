<?php

$continuar = true;
$clientes = [];
const CHEQUE_ESPECIAL = 500;


    do{

    menu();
    $opcao = trim(readline());

    } while ($continuar == true);

    switch($opcao){

        case 1:
            cadastrarCliente();
    }



function menu (){

    print("
    *******************************
    *       menu de usuário       *
    *******************************
    *   1- Criar usuário          *
    *   2- Criar sua conta        *
    *   3- Acessar sua conta      *
    *******************************
    ");


}

function cadastrarCliente(){

    global $clientes;

    $nome = readline('Informe seu nome: ');
    $cpf = readline('Informe seu CPF: ');

    $cliente = [
        'nome' => $nome,
        'nome' => $nome,
    ];

    $clientes[$cpf] = $cliente;
}