<?php

include "repositorio.php";
require_once("inc/init.php");
require_once("inc/config.ui.php");
require('./fpdf/mc_table.php');
require_once('fpdf/fpdf.php');
include "js/girComum.php";



session_start();
$utils = new comum();

$reposit = new reposit();

class PDF extends FPDF
{
    function Header()
    {
        $this->SetXY(190, 5);
        $this->SetFont('Arial', 'B', 8); #Seta a Fonte
        $this->Image('img\ntlLogoMarcaDagua.png', 45, 90, 120, 120); #logo da empresa
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



$pdf->AddPage();
$pdf->SetFont('Arial', '', 15);
$pdf->SetXY(98, 25);
$pdf->Cell(20, 5, iconv('UTF-8', 'windows-1252', "Lançamento Horário Contingência"), 0, 0, "C", 0);

$pdf->line(5, 34, 205, 34);


$pdf->SetXY(5, 40);
$pdf->SetFont('Arial', 'B', 9);
$pdf->Cell(20, 5, iconv('UTF-8', 'windows-1252', " "), 0, 0, "L", 0);

$pdf->SetXY(5, 46);
$pdf->Cell(20, 5, iconv('UTF-8', 'windows-1252', "Data : " . " "), 0, 0, "L", 0);

$pdf->SetFillColor(238, 238, 238);
$pdf->SetFont('Arial', 'B', 8);

$pdf->SetY(55);
$pdf->Cell(40, 10, iconv('UTF-8', 'windows-1252', "FUNCIONÁRIO"), 1, 0, "C", 1);

$pdf->SetX(45);
$pdf->Cell(15, 10, iconv('UTF-8', 'windows-1252', "ENTRADA"), 1, 0, "C", 1);

$pdf->SetX(60);
$pdf->Cell(30, 5, iconv('UTF-8', 'windows-1252', "1° PAUSA"), 1, 0, "C", 1);

$pdf->SetXY(60, 60);
$pdf->Cell(15, 5, iconv('UTF-8', 'windows-1252', "INÍCIO"), 1, 0, "C", 1);

$pdf->SetX(75);
$pdf->Cell(15, 5, iconv('UTF-8', 'windows-1252', "FIM"), 1, 0, "C", 1);

$pdf->SetXY(90, 55);
$pdf->Cell(30, 5, iconv('UTF-8', 'windows-1252', "INTERVALO"), 1, 0, "C", 1);

$pdf->SetXY(90, 60);
$pdf->Cell(15, 5, iconv('UTF-8', 'windows-1252', "INÍCIO"), 1, 0, "C", 1);

$pdf->SetX(105);
$pdf->Cell(15, 5, iconv('UTF-8', 'windows-1252', "FIM"), 1, 0, "C", 1);

$pdf->SetXY(120, 55);
$pdf->Cell(30, 5, iconv('UTF-8', 'windows-1252', "2° PAUSA"), 1, 0, "C", 1);

$pdf->SetXY(120, 60);
$pdf->Cell(15, 5, iconv('UTF-8', 'windows-1252', "INÍCIO"), 1, 0, "C", 1);

$pdf->SetX(135);
$pdf->Cell(15, 5, iconv('UTF-8', 'windows-1252', "FIM"), 1, 0, "C", 1);

$pdf->SetXY(150, 55);
$pdf->Cell(15, 10, iconv('UTF-8', 'windows-1252', "SAÍDA"), 1, 0, "C", 1);

$pdf->SetX(165);
$pdf->Cell(40, 10, iconv('UTF-8', 'windows-1252', "ASSINATURA"), 1, 0, "C", 1);

$y = 65;

$pdf->SetXY(5, $y);
$pdf->Cell(40, 10, iconv('UTF-8', 'windows-1252', ''), 1, 0, "L", 0);

$pdf->SetXY(45, $y);
$pdf->Cell(15, 10, iconv('UTF-8', 'windows-1252', ""), 1, 0, "C", 0);

$pdf->SetXY(60, $y);
$pdf->Cell(15, 10, iconv('UTF-8', 'windows-1252', ''), 1, 0, "C", 0);

$pdf->SetXY(75, $y);
$pdf->Cell(15, 10, iconv('UTF-8', 'windows-1252', ''), 1, 0, "C", 0);

$pdf->SetXY(90, $y);
$pdf->Cell(15, 10, iconv('UTF-8', 'windows-1252', ""), 1, 0, "C", 0);

$pdf->SetXY(105, $y);
$pdf->Cell(15, 10, iconv('UTF-8', 'windows-1252', ""), 1, 0, "C", 0);

$pdf->SetXY(120, $y);
$pdf->Cell(15, 10, iconv('UTF-8', 'windows-1252', ''), 1, 0, "C", 0);

$pdf->SetXY(135, $y);
$pdf->Cell(15, 10, iconv('UTF-8', 'windows-1252', ''), 1, 0, "C", 0);

$pdf->SetXY(150, $y);
$pdf->Cell(15, 10, iconv('UTF-8', 'windows-1252', ""), 1, 0, "C", 0);

$pdf->SetXY(165, $y);
$pdf->Cell(40, 10, iconv('UTF-8', 'windows-1252', ''), 1, 0, "C", 0);

$y += 10;

$pdf->SetXY(5, $y);
$pdf->Cell(40, 10, iconv('UTF-8', 'windows-1252', ''), 1, 0, "L", 0);

$pdf->SetXY(45, $y);
$pdf->Cell(15, 10, iconv('UTF-8', 'windows-1252', ""), 1, 0, "C", 0);

$pdf->SetXY(60, $y);
$pdf->Cell(15, 10, iconv('UTF-8', 'windows-1252', ''), 1, 0, "C", 0);

$pdf->SetXY(75, $y);
$pdf->Cell(15, 10, iconv('UTF-8', 'windows-1252', ''), 1, 0, "C", 0);

$pdf->SetXY(90, $y);
$pdf->Cell(15, 10, iconv('UTF-8', 'windows-1252', ""), 1, 0, "C", 0);

$pdf->SetXY(105, $y);
$pdf->Cell(15, 10, iconv('UTF-8', 'windows-1252', ""), 1, 0, "C", 0);

$pdf->SetXY(120, $y);
$pdf->Cell(15, 10, iconv('UTF-8', 'windows-1252', ''), 1, 0, "C", 0);

$pdf->SetXY(135, $y);
$pdf->Cell(15, 10, iconv('UTF-8', 'windows-1252', ''), 1, 0, "C", 0);

$pdf->SetXY(150, $y);
$pdf->Cell(15, 10, iconv('UTF-8', 'windows-1252', ""), 1, 0, "C", 0);

$pdf->SetXY(165, $y);
$pdf->Cell(40, 10, iconv('UTF-8', 'windows-1252', ''), 1, 0, "C", 0);

$y += 10;

$pdf->SetXY(5, $y);
$pdf->Cell(65, 10, iconv('UTF-8', 'windows-1252', "DATA : ___/___/___"), 0, 0, "L", 0);

$y += 20;
$pdf->line(75, $y, 145, $y);


$pdf->SetXY(75, $y);
$pdf->Cell(65, 10, iconv('UTF-8', 'windows-1252', " "), 0, 0, "C", 0);

$pdf->Output('', "lancamentoHorarioContingencia_" . " " . ".pdf", '');