<?php
namespace PDFAnony\TCPDF\Facades;

use Illuminate\Support\Facades\Facade;

class AnonyPDF extends Facade
{
	protected static function getFacadeAccessor(){return 'tcpdf';}
}