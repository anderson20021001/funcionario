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

if ($funcao == 'verificaRG') {
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
        $ativo = $_POST["ativo"];
    }
    $reposit = new reposit();
    $utils = new comum();

    $nome = $utils->formatarString($_POST['nome']);
    $cpf = $utils->formatarString($_POST['cpf']);
    $rg = $utils->formatarString($_POST['rg']);
    $dataNascimento = $utils->formataDataSql($_POST['dataNascimento']);
    $genero = $_POST['genero'];
    $estadoCivil = $_POST['estadoCivil'];
    $telefone = $_POST['jsonTelefoneArray'];
    $email = $_POST['jsonEmailArray'];
    $dependente = $_POST['jsonDependenteArray'];
    $cep = $utils->formatarString($_POST['cep']);
    $logradouro = $utils->formatarString($_POST['logradouro']);
    $complemento = $utils->formatarString($_POST['complemento']);
    $numero = $utils->formatarString($_POST['numero']);
    $uf = $utils->formatarString($_POST['uf']);
    $bairro = $utils->formatarString($_POST['bairro']);
    $cidade = $utils->formatarString($_POST['cidade']);
    $emprego = $_POST['emprego'];
    $pis = $utils->formatarString($_POST['pis']);



    $nomeXml = "ArrayOfTelefone";
    $nomeTabela = "telefone";
    if (sizeof($telefone) > 0) {
        $xmlTelefone = '<?xml version="1.0"?>';
        $xmlTelefone = $xmlTelefone . '<' . $nomeXml . ' xmlns:xsi="http://www.w3.org/2001/XMLSchema-instance" xmlns:xsd="http://www.w3.org/2001/XMLSchema">';
        foreach ($telefone as $chave) {
            $xmlTelefone = $xmlTelefone . "<" . $nomeTabela . ">";
            foreach ($chave as $campo => $valor) {
                if ($campo == "telefonePrincipal") {
                    if ($valor == "Sim")
                        $valor = 1;
                    else
                        $valor = 0;
                }

                if ($campo == "telefoneWhatsapp") {
                    if ($valor == "Sim")
                        $valor = 1;
                    else
                        $valor = 0;
                }

                $xmlTelefone = $xmlTelefone . "<" . $campo . ">" . $valor . "</" . $campo . ">";
            }
            $xmlTelefone = $xmlTelefone . "</" . $nomeTabela . ">";
        }
        $xmlTelefone = $xmlTelefone . "</" . $nomeXml . ">";
    } else {
        $xmlTelefone = '<?xml version="1.0"?>';
        $xmlTelefone = $xmlTelefone . '<' . $nomeXml . ' xmlns:xsi="http://www.w3.org/2001/XMLSchema-instance" xmlns:xsd="http://www.w3.org/2001/XMLSchema">';
        $xmlTelefone = $xmlTelefone . "</" . $nomeXml . ">";
    }
    $xml = simplexml_load_string($xmlTelefone);
    if ($xml === false) {
        $mensagem = "Erro na criação do XML de Telefone";
        echo "failed#" . $mensagem . ' ';
        return;
    }
    $xmlTelefone = "'" . $xmlTelefone . "'";


    $nomeXml = "ArrayOfEmail";
    $nomeTabela = "email";
    if (sizeof($email) > 0) {
        $xmlEmail = '<?xml version="1.0"?>';
        $xmlEmail = $xmlEmail . '<' . $nomeXml . ' xmlns:xsi="http://www.w3.org/2001/XMLSchema-instance" xmlns:xsd="http://www.w3.org/2001/XMLSchema">';
        foreach ($email as $chave) {
            $xmlEmail = $xmlEmail . "<" . $nomeTabela . ">";
            foreach ($chave as $campo => $valor) {
                if ($campo == "emailPrincipal") {
                    if ($valor == "true")
                        $valor = 1;
                    else
                        $valor = 0;
                }

                $xmlEmail = $xmlEmail . "<" . $campo . ">" . $valor . "</" . $campo . ">";
            }
            $xmlEmail = $xmlEmail . "</" . $nomeTabela . ">";
        }
        $xmlEmail = $xmlEmail . "</" . $nomeXml . ">";
    } else {
        $xmlEmail = '<?xml version="1.0"?>';
        $xmlEmail = $xmlEmail . '<' . $nomeXml . ' xmlns:xsi="http://www.w3.org/2001/XMLSchema-instance" xmlns:xsd="http://www.w3.org/2001/XMLSchema">';
        $xmlEmail = $xmlEmail . "</" . $nomeXml . ">";
    }
    $xml = simplexml_load_string($xmlEmail);
    if ($xml === false) {
        $mensagem = "Erro na criação do XML de Telefone";
        echo "failed#" . $mensagem . ' ';
        return;
    }
    $xmlEmail = "'" . $xmlEmail . "'";

    $nomeXml = "ArrayOfDependente";
    $nomeTabela = "dependente";
    if (sizeof($dependente) > 0) {
        $xmlDependente = '<?xml version="1.0"?>';
        $xmlDependente = $xmlDependente . '<' . $nomeXml . ' xmlns:xsi="http://www.w3.org/2001/XMLSchema-instance" xmlns:xsd="http://www.w3.org/2001/XMLSchema">';
        foreach ($dependente as $chave) {
            $xmlDependente = $xmlDependente . "<" . $nomeTabela . ">";
            foreach ($chave as $campo => $valor) {
                

                $xmlDependente = $xmlDependente . "<" . $campo . ">" . $valor . "</" . $campo . ">";
            }
            $xmlDependente = $xmlDependente . "</" . $nomeTabela . ">";
        }
        $xmlDependente = $xmlDependente . "</" . $nomeXml . ">";
    } else {
        $xmlDependente = '<?xml version="1.0"?>';
        $xmlDependente = $xmlDependente . '<' . $nomeXml . ' xmlns:xsi="http://www.w3.org/2001/XMLSchema-instance" xmlns:xsd="http://www.w3.org/2001/XMLSchema">';
        $xmlDependente = $xmlDependente . "</" . $nomeXml . ">";
    }
    $xml = simplexml_load_string($xmlDependente);
    if ($xml === false) {
        $mensagem = "Erro na criação do XML de Telefone";
        echo "failed#" . $mensagem . ' ';
        return;
    }
    $xmlDependente = "'" . $xmlDependente . "'";



    $sql = "dbo.funcionario_Atualiza
     $id,
     $ativo,
     $nome,
     $cpf,
     $dataNascimento,
     $rg,
     $genero,
     $estadoCivil,
     $xmlTelefone,
     $xmlEmail,
     $xmlDependente,
     $cep,
     $logradouro,
     $complemento,
     $numero,
     $uf,
     $bairro,
     $cidade,
     $emprego,
     $pis";

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

    $sql = " SELECT codigo, ativo, nome, cpf, dataNascimento, rg,  genero, estadoCivil, cep, logradouro, complemento, numero, uf, bairro, cidade, primeiroEmprego, pis
             FROM dbo.funcionarioCadastro WHERE (0 = 0) and codigo = $id";


    $reposit = new reposit();
    $result = $reposit->RunQuery($sql);

    $out = "";
    if ($row = $result[0]) {
        $codigo = +
        $row['codigo'];
        $ativo = $row['ativo'];
        $nome = $row['nome'];
        $cpf = $row['cpf'];
        $dataNascimento = $row['dataNascimento'];
        $rg = $row['rg'];
        $genero = $row['genero'];
        $estadoCivil = $row['estadoCivil'];
        $cep = $row['cep'];
        $logradouro = $row['logradouro'];
        $complemento = $row['complemento'];
        $numero = $row['numero'];
        $uf = $row['uf'];
        $bairro = $row['bairro'];
        $cidade = $row['cidade'];
        $primeiroEmprego = $row['primeiroEmprego'];
        $pis = $row['pis'];

    }

    $sql = "SELECT  codigo, telefone, principal, whatsapp FROM dbo.telefone WHERE codigoTel = $id";
    $reposit = new reposit();
    $result = $reposit->RunQuery($sql);

    $arrayTelefone = [];

    foreach ($result as $index => $item) {
        $sequencialTelefone = $index + 1;

        if ($item['principal']) {
            $descricaoPrincipal = 'Sim';
        } else {
            $descricaoPrincipal = 'Não';
        }

        if ($item['whatsapp']) {
            $descricaoWhatsApp = 'Sim';
        } else {
            $descricaoWhatsApp = 'Não';
        }

        array_push($arrayTelefone, [
            'codigo' => $item['codigo'],
            'telefone' => $item['telefone'],
            'descricaoPrincipal' => $descricaoPrincipal,
            'descricaoWhatsApp' => $descricaoWhatsApp,
            'telefonePrincipal' => $item['principal'],
            'telefoneWhatsapp' => $item['whatsapp'],
            'sequencialTel' => $sequencialTelefone


        ]);
    }

    $jsonTelefone = json_encode($arrayTelefone);



    $sql = "SELECT  codigo, email, principal FROM dbo.email WHERE codigoEmail = $id";
    $reposit = new reposit();
    $result = $reposit->RunQuery($sql);

    $arrayEmail = [];

    foreach ($result as $index => $item) {
        $sequencialEmail = $index + 1;

        if ($item['principal'] == 1) {
            $descricaoPrincipal = 'Sim';
        } else {
            $descricaoPrincipal = 'Não';
        }


        array_push($arrayEmail, [
            'codigo' => $item['codigo'],
            'email' => $item['email'],
            'descricaoEmailPrincipal' => $descricaoPrincipal,
            'emailPrincipal' => $item['principal'],
            'sequencialEmail' => $sequencialEmail
        ]);
    }

    $jsonEmail = json_encode($arrayEmail);


    $sql = "SELECT  codigo, nomeDependente, cpfDependente, dataNascimentoDependente, tipoDependente FROM dbo.funcionarioDependente WHERE codigoDependente = $id";
    $reposit = new reposit();
    $result = $reposit->RunQuery($sql);

    $arrayDependente = [];

    foreach ($result as $index => $item) {
        $sequencialDependente = $index + 1;

        array_push($arrayDependente, [
            'codigo' => $item['codigo'],
            'nomeDependente' => $item['nomeDependente'],
            'cpfDependente' => $item['cpfDependente'],
            'dataNascimentoDependente' => $item['dataNascimentoDependente'],
            'tipoDependente' => $item['tipoDependente'],
            'sequencialDependente' => $sequencialDependente
        ]);
    }

    $jsonDependente = json_encode($arrayDependente);



    $out =   $codigo . "^" .
        $ativo . "^" .
        $nome . "^" .
        $cpf . "^" .
        $dataNascimento . "^" .
        $rg . "^" .
        $genero . "^" .
        $estadoCivil  . "^" .
        $jsonTelefone . "^" .
        $jsonEmail . "^" .
        $jsonDependente . "^" .
        $cep . "^" .
        $logradouro . "^" .
        $complemento . "^" .
        $numero . "^" .
        $uf . "^" .
        $bairro . "^" .
        $cidade . "^" .
        $primeiroEmprego . "^" .
        $pis;

    if ($out == "") {
        echo "failed#";
        return;
    }

    echo "sucess#" . $out . "#" . $jsonTelefone . "^" .
    $jsonEmail . "^" .
    $jsonDependente;
    
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

function verificaCpf()
{
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
    if (count($result) > 0) {
        $ret = 'failed#cpf ja cadastrado';
    }
    echo $ret;
    return;
}

function verificaRG()
{
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

    $ret = 'sucess#Pode Cadastrar RG';
    if (count($result) > 0) {
        $ret = 'failed#rg ja cadastrado';
    }
    echo $ret;
    return;
}