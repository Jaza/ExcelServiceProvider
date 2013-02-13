# ExcelServiceProvider

An Excel ServiceProvider for [Silex](http://silex.sensiolabs.org).

## Installation

1  Add to the 'require' section of composer.json:  

``` 
    "require" : {
        "jaza/excel-service-provider": "1.0.*@dev",
    }
``` 
 

2 Register the provider:

``` php
$app->register(new Jaza\Silex\ExcelServiceProvider());
```

## Usage

From within a Silex callback or elsewhere:

``` php
$excelService = $app['xls.service_xls5'];

$excelService->excelObj->getProperties()->setCreator("Me")
                       ->setLastModifiedBy("Me")
                       ->setTitle("Test Document")
                       ->setSubject("Test Document")
                       ->setDescription("Testing a document.")
                       ->setKeywords("testdoc")
                       ->setCategory("Test doc");
    
$excelService->excelObj->setActiveSheetIndex(0)
             ->setCellValue('A1', 'Hello')
             ->setCellValue('B2', 'world!');

$excelService->excelObj->getActiveSheet()->setTitle('Simple');
$excelService->excelObj->setActiveSheetIndex(0);

$response = $excelService->getResponse();
$response->headers->set('Content-Type', 'text/vnd.ms-excel; charset=utf-8');
$response->headers->set('Content-Disposition', 'attachment;filename=rpttest.xls');

// If you are using a https connection, you have to set those two headers for compatibility with IE <9
$response->headers->set('Pragma', 'public');
$response->headers->set('Cache-Control', 'maxage=1');

return $response;

```
