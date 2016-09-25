# PDF Anony Package
A PDF Package Support Arabic Based On TCPDF Developed By PhpAnonymous ( phpanonymous.com )
Laravel Version 5 and Above 
##Install with Composer 
```php
composer require pdfanonymous/phpanonymous:dev-master
```
# Provider Class 
put on your ` config/app.php ` in provider array this class
```php
 PDFAnony\TCPDF\AnonyServiceProvider::class,
 
```

#Aliases 
add this on aliases array
```php 
'PDF' =>  PDFAnony\TCPDF\Facades\AnonyPDF::class,
```
#publish 
with composer run this command `php artisan vendor:publish `

#usage 

you can use The PDF Class anywhere you want it , in Controller or Blade File 

Just Call Class PDF::HTML($yourArraySettings);

Like That 

```php
$html = view('youblade_path',['dataloop'=>$yourdataloop])->render(); // file render
// or pure html 
$html = '<h1>مرحبا بكم فى العالم </h1>';
 $pdfarr = [
		'title'=>'اهلا بكم ',
		'data'=>$html, // render file blade with content html
		'header'=>['show'=>false], // header content
		'footer'=>['show'=>false], // Footer content
		'font'=>'aealarabiya', //  dejavusans, aefurat ,aealarabiya ,times
		'font-size'=>12, // font-size 
		'text'=>'', //Write
		'rtl'=>true, //true or false 
		'creator'=>'phpanonymous', // creator file - you can remove this key
		'keywords'=>'phpanonymous keywords', // keywords file - you can remove this key
		'subject'=>'phpanonymous subject', // subject file - you can remove this key
		'filename'=>'phpanonymous.pdf', // filename example - invoice.pdf
		'display'=>'print', // stream , download , print
	];

   	PDF::HTML($pdfarr);

```
you can set state display if want stream or download or auto print file pdf 
and you can set file name and other setting 

1 - rtl can be disable it or enable 

2 - can render file blade with data key or put html code i'ts easy 

3 - you have 4 fonts type  dejavusans, aefurat ,aealarabiya ,times  | default is  aealarabiya just change if you want :) 

4 - you can set font size the default value is 12 

5 - text key you can remove it or null any way 

6 - you can set information file creator or keywords or subject 

7 - finally you can set your title file :) i'ts more setting coming soon 

this package based on tcpdf library (https://tcpdf.org)


this package supported arabic character 100% and supported rtl 100% 

Sorry Can't Support A Twitter Bootstrap Right now But i well do it soon

if you have any questions about this package join us on group facebook  (https://www.facebook.com/groups/anonymouses.developers) 

Enjoy :) 


