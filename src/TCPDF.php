<?php
namespace PDFAnony\TCPDF;

use Config;

class TCPDF 
{
	protected static $format;
	protected static $tcpdf2;
	protected $app;
	protected $tcpdf;

	public function __construct($app)
	{
		$this->app = $app;
		$this->reset();
	}

	public function reset()
	{
		$AddtionalFunc = new AddtionalFunc(
			Config::get('pdfanony.page_orientation', 'P'),
			Config::get('pdfanony.page_unit', 'mm'),
			static::$format ? static::$format : Config::get('pdfanony.page_format', 'A4'),
			Config::get('pdfanony.unicode', true),
			Config::get('pdfanony.encoding', 'UTF-8')
		);
		$this->tcpdf = $AddtionalFunc;
		static::$tcpdf2 = $AddtionalFunc;
	}

	public static function changeFormat($format)
	{
		static::$format = $format;
	}

	public function __call($method, $args)
	{
		if (method_exists($this->tcpdf, $method)) {
			return call_user_func_list([$this->tcpdf, $method], $args);
		}
		throw new \RuntimeException(sprintf('the function %s does not exists in TCPDF', $method));
	}


	public static function HTML($list=[])
	{
	    	

	       if($list['header']['show'] == true)
			{
		        /*static::$tcpdf2->Image($list['header']['logo']);
		        static::$tcpdf2->SetFont($list['header']['font'], 'B', $list['header']['font-size']);
		        static::$tcpdf2->Cell($list['header']['cell']);*/
		    }else{
		      static::$tcpdf2->SetPrintHeader(false);

		    } 	

		    if($list['footer']['show'] == true)
			{

		    }else{
	    	static::$tcpdf2->SetPrintFooter(false);
		    }

		 static::$tcpdf2->SetTitle($list['title']);
		 static::$tcpdf2->AddPage();

		if(!empty($list['rtl']) and $list['rtl'] == true)
		{
		 static::$tcpdf2->setRTL(true);	
		}else{
		 static::$tcpdf2->setRTL(false);	
		}

		if(isset($list['font-size']) and isset($list['font']))
		{
		 static::$tcpdf2->SetFont($list['font'], '', $list['font-size']);	
		}

		if(isset($list['data']) and !empty($list['data']))
		{
		 static::$tcpdf2->WriteHTML($list['data']);
		}
		 
		if(!empty($list['creator']))
		{
			static::$tcpdf2->SetCreator($list['creator']);
		}

		if(!empty($list['subject']))
		{
			static::$tcpdf2->SetSubject($list['subject']);
		}

		if(!empty($list['keywords']))
		{
			static::$tcpdf2->SetKeywords($list['keywords']);
		}


		if($list['display'] == 'download')
		{
			$display = 'D';
		}elseif($list['display'] == 'print'){
			$display = 'I';
  		   	static::$tcpdf2->IncludeJS("print(true);");
		}elseif($list['display'] == 'stream'){
			$display = 'I';
		}

		if(!empty($list['filename']))
		{
  		   static::$tcpdf2->Output($list['filename'], $display);
		}else{
		 return  static::$tcpdf2->Output(rand(000,999).'pdf-file.pdf',$display);
		}
		
	} 


	 
}