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
$sql = "SELECT codigo, nome, cpf, dataNascimento,rg, ativo
    FROM funcionarioCadastro where codigo = $codigo ";
$reposit = new reposit();
$resultParamentro = $reposit->RunQuery($sql);
$rowParamentro = $resultParamentro[0];
$linkName = $rowParamentro['link'];

$pdf->AddPage();
$l = 13;
$margem = 5;


$y = 34;

$pdf->SetFont('Arial', '', 15);
$pdf->SetXY(98, 25);
$pdf->Cell(11, 5, iconv('UTF-8', 'windows-1252', "RELATÓRIO DE ATIVOS/DESATIVOS"), 0, 0, "C", 0);

$pdf->line(5, 34, 205, 34);


$pdf->SetXY(5, 40);
$pdf->SetFont('Arial', 'B', 9);
$pdf->Cell(20, 5, iconv('UTF-8', 'windows-1252', " "), 0, 0, "L", 0);

$pdf->SetXY(5, 46);
$pdf->Cell(20, 5, iconv('UTF-8', 'windows-1252', " " . " "), 0, 0, "L", 0);

$pdf->SetFillColor(238, 238, 238);
$pdf->SetFont('Arial', 'B', 8);


$pdf->SetY(34);
$pdf->SetX(5);
$pdf->Cell(55, 10, iconv('UTF-8', 'windows-1252', "NOME"), 1, 0, "L", 1);

// $pdf->SetY(55);
// $pdf->Cell(75, 10, iconv('UTF-8', 'windows-1252', $nomeFuncionario), 1, 0, "C", 2);


$pdf->SetX(60);
// $pdf->SetX(5);
$pdf->Cell(40, 10, iconv('UTF-8', 'windows-1252', "CPF"), 1, 0, "C", 1);

// $pdf->SetXY(90, 60);
// $pdf->Cell(15, 5, iconv('UTF-8', 'windows-1252', "INÍCIO"), 1, 0, "C", 1);

// $pdf->SetX(105);
// $pdf->Cell(15, 5, iconv('UTF-8', 'windows-1252', "FIM"), 1, 0, "C", 1);

$pdf->SetXY(100, 34);
$pdf->Cell(45, 10, iconv('UTF-8', 'windows-1252', "DATA DE NASCIMENTO"), 1, 0, "C", 1);

// $pdf->SetXY(120, 60);
// $pdf->Cell(15, 5, iconv('UTF-8', 'windows-1252', "INÍCIO"), 1, 0, "C", 1);

// $pdf->SetX(135);
// $pdf->Cell(15, 5, iconv('UTF-8', 'windows-1252', "FIM"), 1, 0, "C", 1);

// $pdf->SetXY(150, 55);
// $pdf->Cell(15, 10, iconv('UTF-8', 'windows-1252', "SAÍDA"), 1, 0, "C", 1);

$pdf->SetXY(145, 34);
$pdf->Cell(40, 10, iconv('UTF-8', 'windows-1252', "RG"), 1, 0, "C", 1);

// $pdf->SetXY(120, 60);
// $pdf->Cell(15, 5, iconv('UTF-8', 'windows-1252', "INÍCIO"), 1, 0, "C", 1);

// $pdf->SetX(135);
// $pdf->Cell(15, 5, iconv('UTF-8', 'windows-1252', "FIM"), 1, 0, "C", 1);

// $pdf->SetXY(150, 55);
// $pdf->Cell(15, 10, iconv('UTF-8', 'windows-1252', "SAÍDA"), 1, 0, "C", 1);

$pdf->SetX(185);
$pdf->Cell(20, 10, iconv('UTF-8', 'windows-1252', "ATIVO"), 1, 0, "C", 1);

$y += 10;

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



$codigo = $rowParamentro['codigo'];
$nomeFuncionario = $rowParamentro['nome'];
$cpfFuncionario = $rowParamentro['cpf'];
// $dataNascimento = ($utils->formataDataSql($_GET['dataNascimento']));
$dataNascimento = $rowParamentro['dataNascimento'];
$dataNascimento = explode(" ", $dataNascimento);
$dataNascimento = explode("-", $dataNascimento[0]);
$dataNascimento =  $dataNascimento[2] . "/" . $dataNascimento[1] . "/" . $dataNascimento[0];
$rg = $rowParamentro['rg'];
$ativoFuncionario = $rowParamentro['ativo'];



if ($ativoFuncionario == 1) {
    $ativoFuncionario = 'Sim';
} else {
    $ativoFuncionario = 'Não';
}


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




$pdf->SetXY(5, $y);
$pdf->Cell(55, 5, iconv('UTF-8', 'windows-1252',  $nomeFuncionario), 1, 0, "L", 0);

// ....

// $pdf->SetXY(45, $y);
// $pdf->Cell(190, 10, iconv('UTF-8', 'windows-1252', ""), 1, 0, "C", 0);

// $pdf->SetXY(60, $y);
// $pdf->Cell(15, 10, iconv('UTF-8', 'windows-1252', ''), 1, 0, "C", 0);

$pdf->SetXY(60, $y);
$pdf->Cell(40, 5, iconv('UTF-8', 'windows-1252', $cpfFuncionario), 1, 0, "C", 0);

// $pdf->SetXY(90, $y);
// $pdf->Cell(15, 10, iconv('UTF-8', 'windows-1252', ""), 1, 0, "C", 0);

// $pdf->SetXY(105, $y);
// $pdf->Cell(15, 10, iconv('UTF-8', 'windows-1252', ""), 1, 0, "C", 0);

$pdf->SetXY(100, $y);
$pdf->Cell(45, 5, iconv('UTF-8', 'windows-1252', $dataNascimento,), 1, 0, "C", 0);

// $pdf->SetXY(135, $y);
// $pdf->Cell(15, 10, iconv('UTF-8', 'windows-1252', ''), 1, 0, "C", 0);

// $pdf->SetXY(150, $y);
// $pdf->Cell(15, 10, iconv('UTF-8', 'windows-1252', ""), 1, 0, "C", 0);
$pdf->SetXY(145, $y);
$pdf->Cell(40, 5, iconv('UTF-8', 'windows-1252', $rg), 1, 0, "C", 0);

// $pdf->SetXY(90, $y);
// $pdf->Cell(15, 10, iconv('UTF-8', 'windows-1252', ""), 1, 0, "C", 0);

// $pdf->SetXY(105, $y);
// $pdf->Cell(15, 10, iconv('UTF-8', 'windows-1252', ""), 1, 0, "C", 0);

$pdf->SetXY(185, $y);
$pdf->Cell(20, 5, iconv('UTF-8', 'windows-1252', $ativoFuncionario), 1, 0, "C", 0);


$y += 5;
if ($y > 270) {
    $pdf->AddPage();
    $y = 12;
}
// $pdf->Line(5, $l, 205, $l); //linha divisória
// // $contador = 0;






// $y += 10;

// $pdf->SetXY(5, $y);
// $pdf->Cell(65, 10, iconv('UTF-8', 'windows-1252', " "), 0, 0, "L", 0);

// $y += 20;
// $pdf->line(75, $y, 145, $y);


// $pdf->SetXY(75, $y);
// $pdf->Cell(65, 10, iconv('UTF-8', 'windows-1252', " "), 0, 0, "C", 0);



$pdf->Output('', "lancamentoHorarioContingencia_" . " " . ".pdf", '');
