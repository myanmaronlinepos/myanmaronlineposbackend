<?php
namespace App\Controllers\Products;

use App\Controllers\Controller;
use App\Models\Product;
use Respect\Validation\Validator as v;

class ImageController extends Controller{

public function moveImage($directory,$uploadedFile) {

    var_dump($directory);
    $extension = pathinfo($uploadedFile->getClientFilename(), PATHINFO_EXTENSION);
    $basename = bin2hex(random_bytes(8));
    $filename = sprintf('%s.%0.8s', $basename, $extension);

    $uploadedFile->moveTo($directory . DIRECTORY_SEPARATOR . $filename);
    exit;
    return $directory.DIRECTORY_SEPARATOR.$filename;
}

public function uploadProductImage($request,$response) {

    $directory=$this->product_image_directory;
    $uploadedFiles = $request->getUploadedFiles();
    $product_id=$request->getParam('product_id');

    $uploadedFile = $uploadedFiles['product_image'];
    if ($uploadedFile->getError() === UPLOAD_ERR_OK) {
        $imageUrl = $this->moveImage($directory, $uploadedFile);
        $this->product->product($product_id)->setImage($imageUrl);
        $response->write(json_encode(true));
    }else {
        $response->write(json_encode(false));
    }
    return $response;
}

public function downloadProductImage() {

    $dir = dirname(__DIR__)."/Resources/Images/";

    $im = new Imagick();
    $im->setBackgroundColor(new ImagickPixel('transparent'));
    $svg = file_get_contents($dir.$id.'.svg');
    $im->readImageBlob($svg);

    $im->setImageFormat("png32");
    $im->resizeImage($height,$width,Imagick::FILTER_LANCZOS,1);

     $app->response->header('Content-Type', 'content-type: image/'.$type );
     echo $im;
     $im->destroy();
}

}
