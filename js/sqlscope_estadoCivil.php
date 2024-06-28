<?php

include "repositorio.php";
include "girComum.php";

$funcao = $_POST["funcao"];

if ($funcao == 'gravaEstadoCivilPessoa') {
    call_user_func($funcao);
}

if ($funcao == 'recupera') {
    call_user_func($funcao);
}

if ($funcao == 'excluir') {
    call_user_func($funcao);
}

if ($funcao == 'recuperarDadosUsuario') {
    call_user_func($funcao);
}

if ($funcao == 'gravarNovaSenha') {
    call_user_func($funcao);
}
if ($funcao == 'verificaCpf') {
    call_user_func($funcao);
}
// 
// return;

function gravaEstadoCivilPessoa()
{

    if ((empty($_POST['id'])) || (!isset($_POST['id'])) || (is_null($_POST['id']))) {
        $id = 0;
    } else {
        $id = (int) $_POST["id"];
    }

    if ((empty($_POST['ativo'])) || (!isset($_POST['ativo'])) || (is_null($_POST['ativo']))) {
        $ativo = 0;
    } else {
        $ativo = (int) $_POST["ativo"];
    }

    $reposit = new reposit();
    $utils = new comum();

    
    $estadoCivil = $utils->formatarString($_POST['estadoCivil']);
    
    $ativo = 1;


    $sql = "dbo.estadoCivil_Atualiza
     $id,
     $ativo,
     $estadoCivil";

    $reposit = new reposit();
    $result = $reposit->Execprocedure($sql);

    $ret = 'sucess#';
    if ($result < 1) {
        $ret = 'failed#';
    }
    echo $ret;
    return;
}

function recupera()
{
    $condicaoId = !((empty($_POST["id"])) || (!isset($_POST["id"])) || (is_null($_POST["id"])));
    $condicaoLogin = !((empty($_POST["loginPesquisa"])) || (!isset($_POST["loginPesquisa"])) || (is_null($_POST["loginPesquisa"])));

    if (($condicaoId === false) && ($condicaoLogin === false)) {
        $mensagem = "Nenhum parâmetro de pesquisa foi informado.";
        echo "failed#" . $mensagem . ' ';
        return;
    }

    $id = (int) $_POST["id"];

    $sql = " SELECT codigo, ativo, estadoCivil
             FROM dbo.estadoCivil WHERE (0 = 0) and codigo = $id";

    $reposit = new reposit();
    $result = $reposit->RunQuery($sql);

    $out = "";
    if ($row = $result[0]) {
        $codigo = +$row['codigo'];
        $ativo = $row['ativo'];
        $estadoCivil = $row['estadoCivil'];
      
    }

    $out =   $codigo . "^" .
        $ativo . "^" .
        $estadoCivil;

    if ($out == "") {
        echo "failed#";
        return;
    }

    echo "sucess#" . $out;
    return;
}

function excluir()
{

    $reposit = new reposit();

    $id = (int)$_POST["id"];

    // if ((empty($_POST['id'])  (!isset($_POST['id']))  (is_null($_POST['id'])))) {
    //     $mensagem = "Selecione um usuário.";
    //     echo "failed#" . $mensagem . ' ';
    //     return;
    // }


    session_start();

    $result = $reposit->update('dbo.estadoCivil' . '|' . 'ativo = 0' . '|' . 'codigo =' . $id);
    $reposit = new reposit();

    if ($result < 1) {
        echo ('failed#');
        return;
    }

    echo 'sucess#' . $result;
    return;
}

function verificaCpf(){
    if ((empty($_POST['cpf'])) || (!isset($_POST['cpf'])) || (is_null($_POST['cpf']))) {
        $id = 0;
    } else {
        $id = $_POST["cpf"];
    }


    $reposit = new reposit();
    $utils = new comum();

    $cpf = $utils->formatarString($_POST['cpf']);

    $sql = "SELECT cpf from dbo.funcionarioCadastro where cpf = $cpf";

    $reposit = new reposit();
    $result = $reposit->RunQuery($sql);

    $ret = 'sucess#Pode Cadastrar cpf';
    if (count($result)>0) {
        $ret = 'failed#cpf ja cadastrado';
    }
    echo $ret;
    return;
}

function verificaRG(){
    if ((empty($_POST['rg'])) || (!isset($_POST['rg'])) || (is_null($_POST['rg']))) {
        $id = 0;
    } else {
        $id = $_POST["rg"];
    }


    $reposit = new reposit();
    $utils = new comum();

    $rg = $utils->formatarString($_POST['rg']);

    $sql = "SELECT rg from dbo.funcionarioCadastro where rg = $rg";

    $reposit = new reposit();
    $result = $reposit->RunQuery($sql);

    $ret = 'sucess#Pode Cadastrar rg';
    if (count($result)>0) {
        $ret = 'failed#rg ja cadastrado';
    }
    echo $ret;
    return;
}