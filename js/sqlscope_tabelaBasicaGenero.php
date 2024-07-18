<?php

include "repositorio.php";
include "girComum.php";

$funcao = $_POST["funcao"];

if ($funcao == 'gravaGenero') {
    call_user_func($funcao);
}

if ($funcao == 'recupera') {
    call_user_func($funcao);
}

if ($funcao == 'excluirGenero') {
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
if ($funcao == 'verificaRG') {
    call_user_func($funcao);
}
if ($funcao == 'verificaGenero') {
    call_user_func($funcao);
}
// 
// return;

function gravaGenero()
{
    
    if ((empty($_POST['codigo'])) || (!isset($_POST['codigo'])) || (is_null($_POST['codigo']))) {
        $codigo = 0;
    } else {
        $codigo = (int) $_POST["codigo"];
    }

    $reposit = new reposit();

    $descricao = $_POST['descricao'];
    $ativo = 1;


    $sql = "dbo.genero_Atualiza
    $codigo,
    $ativo,
    '$descricao'";

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
    $condicaoId = !((empty($_POST["codigo"])) || (!isset($_POST["codigo"])) || (is_null($_POST["codigo"])));

    $id = (int) $_POST["id"];

    $sql = " SELECT codigo, descricao, ativo
             FROM dbo.genero WHERE (0 = 0) and codigo = $id";

    $reposit = new reposit();
    $result = $reposit->RunQuery($sql);

    $out = "";
    if ($row = $result[0]) {
        $codigo = +$row['codigo'];
        $descricao = $row['descricao'];
        $ativo = $row['ativo'];
    }

    $out =   $codigo . "^" .
        $descricao . "^" .
        $ativo;

    if ($out == "") {
        echo "failed#";
        return;
    }

    echo "sucess#" . $out;
    return;
}

function excluirGenero()
{

    $reposit = new reposit();

    $id = (int)$_POST["id"];

    // if ((empty($_POST['id'])  (!isset($_POST['id']))  (is_null($_POST['id'])))) {
    //     $mensagem = "Selecione um usuário.";
    //     echo "failed#" . $mensagem . ' ';
    //     return;
    // }

    session_start();

    $result = $reposit->update('dbo.genero' . '|' . 'ativo = 0' . '|' . 'codigo =' . $id);
    $reposit = new reposit();

    if ($result < 1) {
        echo ('failed#');
        return;
    }

    echo 'sucess#' . $result;
    return;
}

function verificaCpf(){
    if ((empty($_POST['id'])) || (!isset($_POST['id'])) || (is_null($_POST['id']))) {
        $id = 0;
    } else {
        $id = $_POST["id"];
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
    if ((empty($_POST['id'])) || (!isset($_POST['id'])) || (is_null($_POST['id']))) {
        $id = 0;
    } else {
        $id = $_POST["id"];
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
function verificaGenero(){
    if ((empty($_POST['codigo'])) || (!isset($_POST['codigo'])) || (is_null($_POST['codigo']))) {
        $id = 0;
    } else {
        $id = $_POST["codigo"];
    }


    $reposit = new reposit();
    $utils = new comum();

    $descricao = $utils->formatarString($_POST['descricao']);

    $sql = "SELECT descricao from dbo.genero where descricao = $descricao AND codigo != $id";

    $reposit = new reposit();
    $result = $reposit->RunQuery($sql);

    if (!$result) {
        echo  "success";
        return true;
    } else {
        $mensagem = "Informe o Estado Cívil corretamente, pode estar cadastrado ou a forma digitada esteja errada!";
        echo "failed#" . $mensagem . ' ';
    }
    
    return;
}