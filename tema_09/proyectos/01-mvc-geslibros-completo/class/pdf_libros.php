<?php

class Pdf_libros extends FPDF
{
    //Cabecera de página
    function Header()
    {
        //Logo
         $this->Image("imagenes/logo.png", 11, 1, 18, 11, "PNG");

        
        //Arial bold 15
        $this->SetFont('Arial', 'B', 15);

        //Título
        $this->Cell(60, 10, 'Geslibros 1.0', 0, 0, 'L');
        $this->Cell(60, 10, 'Juan Manuel', 0, 0, 'C');
        $this->Cell(60, 10, '2DAW 24/25', 0, 0, 'R');

        // Línea inferior
        $this->Ln(10);
        $this->Line(10, $this->GetY(), 200, $this->GetY());
        $this->Ln(4);  // Deja espacio después de la línea
    }
    //Pie de página
    function Footer()
    {
        //Posición: a 1,5 cm del final
        $this->SetY(-15);

        // Dibujar una línea horizontal superior
        $this->Line(10, $this->GetY() - 10, 200, $this->GetY() - 10);  // Ajusta las coordenadas si es necesario

        //Arial italic 8
        $this->SetFont('Arial', 'I', 8);
        //Número de página
        $this->Cell(0, 10, iconv('UTF-8', 'ISO-8859-1', 'Página ') . $this->PageNo(), 0, 0, 'C');
    }



    function titulo()
    {
        $this->SetY(55);
        //Arial 12
        $this->SetFont('Arial', 'B', 12);
        //Color de fondo
        $this->SetFillColor(150, 120, 900);

        //  Fecha hora actual
        $fecha = date('d/m/Y H:i:s');

        //  Título
        $this->Cell(0, 6, "Listado de Libros - $fecha", 0, 1, 'C', true);

        //Salto de línea
        $this->Ln(4);
    }

    // Cabecera del listado
    function cabecera()
    {
        // Definir las posiciones de las columnas
        $this->SetFont('Courier', 'B', 8);
        $this->SetFillColor(40, 220, 255);

        // Definir las columnas
        $this->Cell(10, 8, iconv('UTF-8', 'ISO-8859-1', 'ID'), 1, 0, 'C', true);
        $this->Cell(45, 8, iconv('UTF-8', 'ISO-8859-1', 'Título'), 1, 0, 'C', true);
        $this->Cell(35, 8, iconv('UTF-8', 'ISO-8859-1', 'Autor'), 1, 0, 'C', true);
        $this->Cell(30, 8, iconv('UTF-8', 'ISO-8859-1', 'Editorial'), 1, 0, 'C', true);
        $this->Cell(40, 8, iconv('UTF-8', 'ISO-8859-1', 'Géneros'), 1, 0, 'C', true);
        $this->Cell(10, 8, iconv('UTF-8', 'ISO-8859-1', 'Precio'), 1, 0, 'C', true);
        $this->Cell(20, 8, iconv('UTF-8', 'ISO-8859-1', 'Fecha'), 1, 1, 'C', true);
    }
}
