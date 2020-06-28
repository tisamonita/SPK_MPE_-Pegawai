<?php
require('../fpdf/fpdf.php');
include ("../koneksi.php");

$history = $link -> query("SELECT * FROM history where status='belum' OR status='konfirm'");
$datahistory = mysqli_fetch_Array($history);
$id_history = $datahistory['id_history'];

class PDF extends FPDF
{
// Page header
    function  Header()
    {
    // Logo
        $this->Image('logo.png',10,6,20);
    // Arial bold 15
        $this->SetFont('Arial','B',15);
    // Title
        $this->Cell(30,5,'',0,1);
        $this->Cell(30,10,'',0,0);
        $this->Cell(120,5,'PENGADILAN NEGERI',0,1,'J');
        $this->Cell(30,10,'',0,0);
        $this->Cell(120,5,'PRABUMULIH',0,1,'J');
    // Line break
        $this->Ln(9);
    }

// Page footer
    function Footer()
    {
    // Position at 1.5 cm from bottom
        $this->SetY(-15);
    // Arial italic 8
        $this->SetFont('Arial','I',8);
    // Page number
        $this->Cell(0,10,'Page '.$this->PageNo().'/{nb}',0,0,'C');
    }

    function WordWrap(&$text, $maxwidth)
    {
        $text = trim($text);
        if ($text==='')
            return 0;
        $space = $this->GetStringWidth(' ');
        $lines = explode("\n", $text);
        $text = '';
        $count = 0;

        foreach ($lines as $line)
        {
            $words = preg_split('/ +/', $line);
            $width = 0;

            foreach ($words as $word)
            {
                $wordwidth = $this->GetStringWidth($word);
                if ($wordwidth > $maxwidth)
                {
                // Word is too long, we cut it
                    for($i=0; $i<strlen($word); $i++)
                    {
                        $wordwidth = $this->GetStringWidth(substr($word, $i, 1));
                        if($width + $wordwidth <= $maxwidth)
                        {
                            $width += $wordwidth;
                            $text .= substr($word, $i, 1);
                        }
                        else
                        {
                            $width = $wordwidth;
                            $text = rtrim($text)."\n".substr($word, $i, 1);
                            $count++;
                        }
                    }
                }
                elseif($width + $wordwidth <= $maxwidth)
                {
                    $width += $wordwidth + $space;
                    $text .= $word.' ';
                }
                else
                {
                    $width = $wordwidth + $space;
                    $text = rtrim($text)."\n".$word.' ';
                    $count++;
                }
            }
            $text = rtrim($text)."\n";
            $count++;
        }
        $text = rtrim($text);
        return $count;
    }
}

function conv($bulan){

    switch($bulan)
    {
        case"01";
        $bulanx="Januari";
        break;
        case"02";
        $bulanx="Februari";
        break;
        case"03";
        $bulanx="Maret";
        break;
        case"04";
        $bulanx="April";
        break;
        case"05";
        $bulanx="Mei";
        break;
        case"06";
        $bulanx="Juni";
        break;
        case"07";
        $bulanx="Juli";
        break;
        case"08";
        $bulanx="Agustus";
        break;
        case"09";
        $bulanx="September";
        break;
        case"10";
        $bulanx="Oktober";
        break;
        case"11";
        $bulanx="November";
        break;
        case"12";
        $bulanx="Desember";
        break;
    }

    return $bulanx;

}


$tgl=date('d-m-Y');
$array1=explode("-",$tgl);
$hari=$array1[0];
$bulan=$array1[1];
$tahun=$array1[2];

$bulanconvert = conv($bulan);

$query2 = "SELECT * FROM hasil WHERE id_history='$id_history' ORDER by hasil desc";
$hasil2 = mysqli_query($link,$query2);
$jumlah = mysqli_num_rows($hasil2);
$warning = $jumlah - 1;
$warning2 = $warning - 1;

// Instanciation of inherited class

$pdf = new PDF();
$pdf->AliasNbPages();
$pdf->AddPage();
$pdf->SetFont('Arial','',12);
$pdf -> Line(30, 30, 190, 30);
//baris 1, End baris dengan tulis 1. dibaris yg mau di end
$pdf->Cell(70,10,'Palembang, '.$hari.' '.$bulanconvert.' '.$tahun,0,1);
$pdf->Cell(40,5,'Perihal      : Keputusan Pegawai Tidak Tetap',0,1);

$pdf->Cell(190,10,' ',0,1);
// mencetak string 
$pdf->Cell(190,7,'DAFTAR KEPUTUSAN PEGAWAI',0,1,'C');
$pdf->SetFont('Arial','B',12);

// Memberikan space kebawah agar tidak terlalu rapat
$pdf->Cell(10,7,'',0,1);

$pdf->SetFont('Arial','B',10);
$pdf->Cell(22,6,'Peringkat',1,0);
$pdf->Cell(60,6,'NAMA',1,0);
$pdf->Cell(27,6,'SK Pertama',1,0);
$pdf->Cell(27,6,'Bagian',1,0);
$pdf->Cell(17,6,'Nilai',1,0);
$pdf->Cell(28,6,'Keputusan',1,1);


$nb=$pdf->WordWrap($text2,190);
$pkt = 0; 
while ($row = mysqli_fetch_array($hasil2)){

    if ($row['keputusan']=='peringatan') {
        $keputusan = "Diberikan Surat Peringatan";
    } 

    if ($row['keputusan']=='berhentikan') {
        $keputusan = "Kontrak kerja tidak dilanjutkan";
    } 
    if ($row['keputusan']=='lanjut') {
        $keputusan = "Kontrak kerja dilanjutkan";
    } 

    $pkt = $pkt + 1;
    $id_pegawai =$row['id_pegawai'];
    $query3 = $link->query("SELECT * FROM pegawai where id_pegawai='$id_pegawai'");
    $dtpegawai = mysqli_fetch_Array($query3);

    $pdf->Cell(22,6,$pkt,1,0);
    $pdf->Cell(60,6,$dtpegawai['nama'],1,0);
    $pdf->Cell(27,6,$dtpegawai['tgl_skpertama'],1,0);
    $pdf->Cell(27,6,$dtpegawai['bagian'],1,0);
    $pdf->Cell(17,6, $row['hasil'],1,0); 
    $pdf->Cell(28,6, $keputusan,1,1); 
 
}



$pdf->Output();
?>

