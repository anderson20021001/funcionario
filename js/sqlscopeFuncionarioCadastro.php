<?php

include "repositorio.php";
include "girComum.php";

$funcao = $_POST["funcao"];

if ($funcao == 'grava') {
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

function grava()
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

    $nomeXml = "ArrayOfFilepondAta";
    $nomeTabela = "ataUpload";
    if (sizeof($arrayCaminhosFilepondAta) > 0) {
        $xmlJsonTelefone = '<?xml version="1.0"?>';
        $xmlJsonTelefone = $xmlJsonTelefone . '<' . $nomeXml . ' xmlns:xsi="http://www.w3.org/2001/XMLSchema-instance" xmlns:xsd="http://www.w3.org/2001/XMLSchema">';
        foreach ($arrayCaminhosFilepondAta as $chave) {
            $xmlJsonTelefone = $xmlJsonTelefone . "<" . $formTelefone . ">";
            foreach ($chave as $campo => $valor) {
                if (($campo === "sequencialFilepond")) {
                    continue;
                }
                if (($campo === "FilepondValor")) {
                    $valor = $valor;
                }
                $xmlJsonAta = $xmlJsonAta . "<" . $campo . ">" . $valor . "</" . $campo . ">";
            }
            $xmlJsonAta = $xmlJsonAta . "</" . $nomeTabela . ">";
        }
        $xmlJsonAta = $xmlJsonAta . "</" . $nomeXml . ">";
    } else {
        $sqlDelete = "DELETE FROM [Ntl].[ataUpload]
         WHERE campo = '$nomeCampo'  AND ata = $codigo and caminho = $caminho";
        $reposit = new reposit();
        $girComum = new comum();

        $result = $reposit->Execprocedure($sqlDelete);
        $xmlJsonAta = '<?xml version="1.0"?>';
        $xmlJsonAta = $xmlJsonAta . '<' . $nomeXml . ' xmlns:xsi="http://www.w3.org/2001/XMLSchema-instance" xmlns:xsd="http://www.w3.org/2001/XMLSchema">';
        $xmlJsonAta = $xmlJsonAta . "</" . $nomeXml . ">";
    }
    $xml = simplexml_load_string($xmlJsonAta);
    if ($xml === false) {
        $mensagem = "Erro na criação do XML de Solicitação";
        echo "failed#" . $mensagem . ' ';
        return;
    }
    $xmlJsonAta = "'" . $xmlJsonAta . "'";
    
     $sql = "dbo.funcionario_Atualiza
     $id,
     $ativo,
     $nome,
     $cpf,
     $dataNascimento,
     $rg,
     $genero,
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


// function gravaGenero()
// {

//     if ((empty($_POST['id'])) || (!isset($_POST['id'])) || (is_null($_POST['id']))) {
//         $id = 0;
//     } else {
//         $id = (int) $_POST["id"];
//     }

//     $reposit = new reposit();

//     $descricao = $_POST['descricao'];
//     $ativo = 1;


//     $sql = "dbo.genero_Atualiza
//     $id,
//     $ativo,
//     $descricao";

//    $reposit = new reposit();
//    $result = $reposit->Execprocedure($sql);

//    $ret = 'sucess#';
//    if ($result < 1) {
//        $ret = 'failed#';
//    }
//    echo $ret;
//    return;
// }


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

    $sql = " SELECT codigo, ativo, nome, cpf, dataNascimento, rg,  genero, estadoCivil
             FROM dbo.funcionarioCadastro WHERE (0 = 0) and codigo = $id";

    $reposit = new reposit();
    $result = $reposit->RunQuery($sql);

    $out = "";
    if ($row = $result[0]) {
        $codigo = +$row['codigo'];
        $ativo = $row['ativo'];
        $nome = $row['nome'];
        $cpf = $row['cpf'];
        $dataNascimento = $row['dataNascimento'];
        $rg = $row['rg'];
        $genero = $row['genero'];
        $estadoCivil = $row['estadoCivil'];
    
    }

    $out =   $codigo . "^" .
        $ativo . "^" .
        $nome . "^" .
        $cpf . "^" .
        $dataNascimento . "^" .
        $rg . "^" .
        $genero . "^" .
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

    $result = $reposit->update('dbo.funcionarioCadastro' . '|' . 'ativo = 0' . '|' . 'codigo =' . $id);
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

