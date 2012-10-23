<?php
/**
* TCPDF Bridge 
*
* @author ioalessio
*/
namespace Sistema\TcpdfBundle\Helper;
use Symfony\Component\HttpFoundation\Response;
use Io\TcpdfBundle\Helper\Tcpdf as BaseController;

class Tcpdf extends BaseController{

    public function init()
    {
        // set document information
        $this->SetCreator(PDF_CREATOR);
        $this->SetAuthor('Alessio');
        $this->SetTitle('Test');
        $this->SetSubject('TCPDF test');
        $this->SetKeywords('TCPDF, PDF, example, test, guide');

        // set default header data
        $fecha = new \DateTime();
        $fecha = $fecha->format('d/m/Y');
        $this->SetHeaderData('../../../../web/images/as_logo.jpg', PDF_HEADER_LOGO_WIDTH, 'Sistema Web Torneo de Hockey', $fecha);

        // set header and footer fonts
        $this->setHeaderFont(Array(PDF_FONT_NAME_MAIN, '', PDF_FONT_SIZE_MAIN));
        $this->setFooterFont(Array(PDF_FONT_NAME_DATA, '', PDF_FONT_SIZE_DATA));

        // set default monospaced font
        $this->SetDefaultMonospacedFont(PDF_FONT_MONOSPACED);

        //set margins
        $this->SetMargins(PDF_MARGIN_LEFT, PDF_MARGIN_TOP, PDF_MARGIN_RIGHT);
        $this->SetHeaderMargin(PDF_MARGIN_HEADER);
        $this->SetFooterMargin(PDF_MARGIN_FOOTER);

        //set auto page breaks
        $this->SetAutoPageBreak(TRUE, PDF_MARGIN_BOTTOM);

        //set image scale factor
        $this->setImageScale(PDF_IMAGE_SCALE_RATIO);

        // ---------------------------------------------------------

        // set default font subsetting mode
        $this->setFontSubsetting(true);

        // Set font
        // dejavusans is a UTF-8 Unicode font, if you only need to
        // print standard ASCII chars, you can use core fonts like
        // helvetica or times to reduce file size.
        $this->SetFont('dejavusans', '', 12, '', true);

        // Add a page
        // This method has several options, check the source code documentation for more information.
        $this->AddPage();

    }
    /**
     */
    public function quick_pdf($html, $file = "html.pdf", $format = "S")
    {
      $this->init();

        // Close and output PDF document
        // This method has several options, check the source code documentation for more information.
        $this->writeHTML($html, true, false, true, false, '');

        $response =  new Response($this->Output($file, $format));
        $response->headers->set('Content-Type', 'application/pdf');
        return $response;

    }
}