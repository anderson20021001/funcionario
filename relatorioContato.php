<?php

use PhpOffice\PhpSpreadsheet\Cell\AddressHelper;
use PhpOffice\PhpSpreadsheet\Worksheet\Row;
use PhpOffice\PhpSpreadsheet\Writer\Pdf as WriterPdf;

include "repositorio.php";
require_once("inc/init.php");
require_once("inc/config.ui.php");
require('./fpdf/mc_table.php');
require_once('fpdf/fpdf.php');
include "js/girComum.php";



session_start();
$utils = new comum();


// $sql = "SELECT   nome, cpf, dataNascimento, ativo FROM dbo.funcionarioCadastro WHERE codigo = 59";
// $reposit = new reposit();
// $result = $reposit->RunQuery($sql);


$nome = ($utils->formatarString($_GET['nome']));
$cpf = ($utils->formatarString($_GET['cpf']));
$dataNascimento = ($utils->formataDataSql($_GET['dataNascimento']));
$ativo = $_GET['ativo'];


$reposit = new reposit();

class PDF extends FPDF
{
    function Header()
    {
        $this->SetXY(190, 5);
        $this->SetFont('Arial', 'B', 5); #Seta a Fonte
        // $this->Image('img\ntlLogoMarcaDagua.png', 45, 90, 120, 120); #logo da empresa
        // $this->Image('img\logoNtlPdf.png', 126, 11, 69, 28);
        $this->Ln(20); #Quebra de Linhas

    }
    function Footer()
    {
        $this->SetY(202);
        // $this->Image('img\footerPdf.jpg', 1, 272, 210, 25);
    }
}
$pdf = new PDF('P', 'mm', 'A4'); #Crio o PDF padrão RETRATO, Medida em Milímetro e papel A$
$pdf->SetMargins(5, 10, 5); #Seta a Margin Esquerda com 20 milímetro, superrior com 20 milímetro e esquerda com 20 milímetros
$pdf->SetDisplayMode('default', 'continuous'); #Digo que o PDF abrirá em tamanho PADRÃO e as páginas na exibição serão contínuas

$codigo = $_GET['codigo'];
$sql = "SELECT FC.codigo, FC.nome, FC.cpf, FC.ativo, T.telefone as telefoneFuncionario, E.email as emailFuncionario FROM dbo.funcionarioCadastro FC
LEFT JOIN dbo.telefone T ON T.codigoTel = FC.codigo
LEFT JOIN dbo.email E ON E.codigoEmail = FC.codigo
where FC.codigo = $codigo";
$reposit = new reposit();
$resultParamentro = $reposit->RunQuery($sql);
$rowParamentro = $resultParamentro[0];
$linkName = $rowParamentro['linkUpload'];



$pdf->AddPage();
$l = 13;
$margem = 5;


$y = 32.5;

$pdf->SetFont('Arial', '', 15);
$pdf->SetXY(98, 25);
$pdf->Cell(22, 5, iconv('UTF-8', 'windows-1252', "RELATÓRIO DE CONTATO"), 0, 0, "C", 0);

$pdf->line(5, 34, 205, 34);


$pdf->SetXY(5, 40);
$pdf->SetFont('Arial', 'B', 9);
$pdf->Cell(20, 5, iconv('UTF-8', 'windows-1252', " "), 0, 0, "L", 0);

$pdf->SetXY(5, 46);
$pdf->Cell(20, 5, iconv('UTF-8', 'windows-1252', " " . " "), 0, 0, "L", 0);

// $pdf->SetFillColor(238, 238, 238);
// $pdf->SetFont('Arial', 'B', 8);


$pdf->SetY(40);
$pdf->SetX(5);
$pdf->Cell(55, 10, iconv('UTF-8', 'windows-1252', "NOME:"), 0, 0, "L", 0);

// $pdf->SetY(55);
// $pdf->Cell(75, 10, iconv('UTF-8', 'windows-1252', $nomeFuncionario), 1, 0, "C", 2);


$pdf->SetXY(5, 45);
// $pdf->SetX(5);
$pdf->Cell(40, 10, iconv('UTF-8', 'windows-1252', "CPF:"), 0, 0, "L", 0);

// $pdf->SetXY(90, 60);
// $pdf->Cell(15, 5, iconv('UTF-8', 'windows-1252', "INÍCIO"), 1, 0, "C", 1);

// $pdf->SetX(105);
// $pdf->Cell(15, 5, iconv('UTF-8', 'windows-1252', "FIM"), 1, 0, "C", 1);

$pdf->SetXY(10, 77.5);
$pdf->Cell(60, 10, iconv('UTF-8', 'windows-1252', "TELEFONE"), 1, 0, "C",0);

// $pdf->SetXY(10, 90);
// $pdf->Cell(30, 5, iconv('UTF-8', 'windows-1252', "PRINCÍPAL"), 1, 0, "C", 0);

// $pdf->SetX(40);
// $pdf->Cell(30, 5, iconv('UTF-8', 'windows-1252', "WHATSAPP"), 1, 0, "C", 0);

// $pdf->SetXY(150, 55);
// $pdf->Cell(15, 10, iconv('UTF-8', 'windows-1252', "SAÍDA"), 1, 0, "C", 1);

$pdf->SetXY(150, 77.5);
$pdf->Cell(50, 10, iconv('UTF-8', 'windows-1252', "EMAIL"), 1, 0, "C",0);

// $pdf->SetXY(150, 90);
// $pdf->Cell(25, 5, iconv('UTF-8', 'windows-1252', "PRINCÍPAL"), 1, 0, "C", 0);

// $pdf->SetX(175);
// $pdf->Cell(25, 5, iconv('UTF-8', 'windows-1252', "WHATSAPP"), 1, 0, "C", 0);

// $pdf->SetXY(150, 55);
// $pdf->Cell(15, 10, iconv('UTF-8', 'windows-1252', "SAÍDA"), 1, 0, "C", 1);

$pdf->SetXY(165,40.5);
$pdf->Cell(18, 10, iconv('UTF-8', 'windows-1252', "ATIVO:"), 0, 0, "L", 0);

$y += 55;

// $pdf->SetXY(5, $y);
// $pdf->Cell(75, 10, iconv('UTF-8', 'windows-1252', ''), 1, 0, "L", 0);

// $pdf->SetXY(45, $y);
// $pdf->Cell(15, 10, iconv('UTF-8', 'windows-1252', ""), 1, 0, "C", 0);

// $pdf->SetXY(60, $y);
// $pdf->Cell(15, 10, iconv('UTF-8', 'windows-1252', ''), 1, 0, "C", 0);

// $pdf->SetXY(80, $y);
// $pdf->Cell(40, 10, iconv('UTF-8', 'windows-1252', ''), 1, 0, "C", 0);

// $pdf->SetXY(90, $y);
// $pdf->Cell(15, 10, iconv('UTF-8', 'windows-1252', ""), 1, 0, "C", 0);

// $pdf->SetXY(105, $y);
// $pdf->Cell(15, 10, iconv('UTF-8', 'windows-1252', ""), 1, 0, "C", 0);

// $pdf->SetXY(120, $y);
// $pdf->Cell(45, 10, iconv('UTF-8', 'windows-1252', ''), 1, 0, "C", 0);

// $pdf->SetXY(135, $y);
// $pdf->Cell(15, 10, iconv('UTF-8', 'windows-1252', ''), 1, 0, "C", 0);

// $pdf->SetXY(150, $y);
// $pdf->Cell(15, 10, iconv('UTF-8', 'windows-1252', ""), 1, 0, "C", 0);

// $pdf->SetXY(165, $y);
// $pdf->Cell(20, 10, iconv('UTF-8', 'windows-1252', ''), 1, 0, "C", 0);
// }
foreach ($resultParamentro as $rowParamentro) {
    if ($l < 245) {

        $l = 13;
        $pdf->Line(5, 5, 205, 5); //primeira linha
        $pdf->Line(5, 12, 205, 12);
        $pdf->setY(9);
        $pdf->SetFont($tipoDeFonte, $fontWeight, $tamanhoFonte);
        $pdf->setX(92);
        $pdf->Cell(20, 10, iconv('UTF-8', 'windows-1252', ''), 0, 0, "C", 0);
        $pdf->SetFont($tipoDeFonte, '', 10);
        $pdf->Line(5, 5, 5, 292); //BOX PARA SEPARAR CADA SETOR (linha lateral, comprimento)
        $pdf->Line(205, 5, 205, 292);
        $pdf->Line(5, 292, 205, 292);
    }


     $nomeFuncionario = mb_strimwidth(trim($rowParamentro['nome']), 0, 29, "...");
    // $partesNomes = explode(' ', $nomeFuncionario);
    // $primeiroNome = $partesNomes[0];
    // $ultimoSobrenome = $partesNomes[count($partesNomes) - 1];
    // // Abrevia os nomes do meio
    // $nomesDoMeioAbreviados = '';
    // for ($i = 1; $i < count($partesNomes) - 1; $i++) {
    //     $nomesDoMeioAbreviados .= substr($partesNomes[$i], 0, 1) . '. ';
    // }
    // $nomeCompletoFuncionario = $primeiroNome . ' ' . $nomesDoMeioAbreviados . $ultimoSobrenome;
    // // Concatena o primeiro nome, os nomes do meio abreviados e o último sobrenome
    $cpfFuncionario = $rowParamentro['cpf'];

    // $dataNascimento = ($utils->formataDataSql($_GET['dataNascimento']));
    $telefone = $rowParamentro['telefoneFuncionario'];
    $email = mb_strimwidth(trim($rowParamentro['emailFuncionario']), 0, 29, "...");
    $ativoFuncionario = $rowParamentro['ativo'];



    if ($ativoFuncionario == 1) {
        $ativoFuncionario = 'Sim';
    } else {
        $ativoFuncionario = 'Não';
    }

    // function abreviarNome($nomeCompleto) {
    //     // Divide o nome completo em partes
    //     $partes = explode(' ', $nomeCompleto);

    //     // Se o nome tiver apenas uma parte, retorna-o como está
    //     if (count($partes) <= 1) {
    //         return $nomeCompleto;
    //     }

    //     // Armazena o primeiro nome e o último sobrenome
    //     $primeiroNome = $partes[0];
    //     $ultimoSobrenome = $partes[count($partes) - 1];

    //     // Abrevia os nomes do meio
    //     $nomesDoMeioAbreviados = '';
    //     for ($i = 1; $i < count($partes) - 1; $i++) {
    //         $nomesDoMeioAbreviados .= substr($partes[$i], 0, 1) . '. ';
    //     }
    //     $nomeCompletoFuncionario = $primeiroNome . ' ' . $nomesDoMeioAbreviados . $ultimoSobrenome;
    //     // Concatena o primeiro nome, os nomes do meio abreviados e o último sobrenome
    //     return $nomeCompletoFuncionario;
    // }

    // // Exemplo de uso
    // $nomeCompleto = "Adriele Maria da Silva André";
    // $nomeAbreviado = abreviarNome($nomeCompleto);
    // echo $nomeAbreviado; // Saída: Adriele M. da S. André



    // // Exemplo de uso
    // $nomeCompleto = "Adriele Maria da Silva André";
    // $nomeAbreviado = abreviarNome($nomeCompleto);
    // echo $nomeAbreviado; // Saída: Adriele M. da S. André


    // $sqlProjeto = "SELECT P.descricao FROM Ntl.projeto P where P.codigo = $projeto";
    // $resultProjeto = $reposit->RunQuery($sqlProjeto);

    // $sqlDepartamento = "SELECT D.descricao FROM Ntl.departamento D where D.codigo = $departamento";
    // $resultDepartamento = $reposit->RunQuery($sqlDepartamento);

    // $sql = "SELECT DISTINCT F.nome as 'nomeFuncionario'
    //                   FROM Ntl.funcionario F
    //                   INNER JOIN Ntl.beneficioProjeto BP ON BP.funcionario = F.codigo
    //                   INNER JOIN Ntl.projeto P ON P.codigo = BP.projeto
    //                   LEFT JOIN Ntl.departamentoResponsavel DR ON DR.departamento = BP.departamento
    //                   LEFT JOIN Ntl.projetoResponsavel PR ON PR.projeto = P.codigo
    //                   LEFT JOIN Ntl.departamento D ON D.codigo = BP.departamento
    //                   LEFT JOIN Funcionario.folhaPontoMensal PM ON PM.funcionario = F.codigo
    // 				  LEFT JOIN Funcionario.folhaPontoMensalDetalheDiario DD ON DD.folhaPontoMensal = PM.codigo";

    // $where = " WHERE BP.ativo = 1 AND (BP.dataDemissaoFuncionario IS NULL OR BP.dataDemissaoFuncionario <= GETDATE()) AND BP.registraPonto = 1 
    //                AND DR.responsavelDepartamentoLogin = $login AND PM.mesAno = $data AND DD.dia = $dia";
    // $orderBy = " ORDER BY F.nome ASC";
    // if ($departamento) {
    //     $where = $where . " AND (D.codigo = $departamento)";
    // }
    // if ($projeto) {
    //     $where = $where . " AND (P.codigo = $projeto)";
    // }
    // $sql .= $where . $orderBy;
    // $result = $reposit->RunQuery($sql);


    // $pdf->AddPage();




   

    $pdf->SetXY(10, $y);
    $pdf->Cell(60, 5, iconv('UTF-8', 'windows-1252', $telefone,), 1, 0, "C", 0);

    // $pdf->SetXY(135, $y);
    // $pdf->Cell(15, 10, iconv('UTF-8', 'windows-1252', ''), 1, 0, "C", 0);

    // $pdf->SetXY(150, $y);
    // $pdf->Cell(15, 10, iconv('UTF-8', 'windows-1252', ""), 1, 0, "C", 0);

    // $pdf->SetXY(10,  $y);
    // $pdf->Cell(30, 5, iconv('UTF-8', 'windows-1252', $telefoneWhatsapp,), 1, 0, "C", 0);

    // $pdf->SetXY(135, $y);
    // $pdf->Cell(15, 10, iconv('UTF-8', 'windows-1252', ''), 1, 0, "C", 0);

    // $pdf->SetXY(150, $y);
    // $pdf->Cell(15, 10, iconv('UTF-8', 'windows-1252', ""), 1, 0, "C", 0);

    $pdf->SetXY(150,  $y);
    $pdf->Cell(50, 5, iconv('UTF-8', 'windows-1252', $email), 1, 0, "L", 0);

    // $pdf->SetXY(90, $y);
    // $pdf->Cell(15, 10, iconv('UTF-8', 'windows-1252', ""), 1, 0, "C", 0);

    // $pdf->SetXY(105, $y);
    // $pdf->Cell(15, 10, iconv('UTF-8', 'windows-1252', ""), 1, 0, "C", 0);

  


    $y += 5;
    // if ($y > 270) {
    //     $pdf->AddPage();
    //     $y = 12;
    // }
    // $pdf->Line(5, $l, 205, $l); //linha divisória
    // // $contador = 0;
}

$pdf->SetXY(17, 42.5);
$pdf->Cell(55, 5, iconv('UTF-8', 'windows-1252',  $nomeFuncionario), 0, 0, "L", 0);

// ....

// $pdf->SetXY(45, $y);
// $pdf->Cell(190, 10, iconv('UTF-8', 'windows-1252', ""), 1, 0, "C", 0);

// $pdf->SetXY(60, $y);
// $pdf->Cell(15, 10, iconv('UTF-8', 'windows-1252', ''), 1, 0, "C", 0);

$pdf->SetXY(8, 47.5);
$pdf->Cell(38, 5, iconv('UTF-8', 'windows-1252', $cpfFuncionario), 0, 0, "C", 0);

// $pdf->SetXY(90, $y);
// $pdf->Cell(15, 10, iconv('UTF-8', 'windows-1252', ""), 1, 0, "C", 0);

// $pdf->SetXY(105, $y);
// $pdf->Cell(15, 10, iconv('UTF-8', 'windows-1252', ""), 1, 0, "C", 0);
$pdf->SetXY(174, 42.8);
$pdf->Cell(18, 5, iconv('UTF-8', 'windows-1252', $ativoFuncionario), 0, 0, "C", 0);




// $y += 10;

// $pdf->SetXY(5, $y);
// $pdf->Cell(65, 10, iconv('UTF-8', 'windows-1252', " "), 0, 0, "L", 0);

// $y += 20;
// $pdf->line(75, $y, 145, $y);


// $pdf->SetXY(75, $y);
// $pdf->Cell(65, 10, iconv('UTF-8', 'windows-1252', " "), 0, 0, "C", 0);



$pdf->Output('', "lancamentoHorarioContingencia_" . " " . ".pdf", '');
