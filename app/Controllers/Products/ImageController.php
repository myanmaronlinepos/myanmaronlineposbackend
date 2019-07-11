<?php
namespace App\Controllers\Products;

use App\Controllers\Controller;
use App\Models\Product;
use Respect\Validation\Validator as v;

class ImageController extends Controller{

    
    public function uploadProductImage($request,$response) {

    if($this->auth->check()) {
        $user_id=$_SESSION['user'];
        $directory=$this->product_image_directory.DIRECTORY_SEPARATOR.$user_id.DIRECTORY_SEPARATOR;
        $uploadedFiles = $request->getUploadedFiles();
        $product_id=$request->getParam('product_id');

        $uploadedFile = $uploadedFiles['product_image'];

        if ($uploadedFile->getError() === UPLOAD_ERR_OK) {
            $imageUrl = $this->moveImage($directory, $uploadedFile,$product_id);
            $this->product->product($product_id)->setImage($imageUrl);
            $response->write(json_encode(true));
        }else {
            $response->write(json_encode(false));
        }
        return $response;
    }
    $response->getBody()->write(json_encode(false));
    return $response;
}

public function moveImage($directory,$uploadedFile,$filename) {

    var_dump($directory);
    // exit;
    $extension = pathinfo($uploadedFile->getClientFilename(), PATHINFO_EXTENSION);
    // $basename = bin2hex(random_bytes(8));
    $basename = $filename;
    $filename = sprintf('%s.%0.8s', $basename, $extension);

    $uploadedFile->moveTo($directory . DIRECTORY_SEPARATOR . $filename);
    return $directory.DIRECTORY_SEPARATOR.$filename;
}

public function downloadProductImage($request,$response) {

    if($this->auth->check()) {

    $user_id=$_SESSION['user'];
    $directory=$this->product_image_directory.DIRECTORY_SEPARATOR.$user_id.DIRECTORY_SEPARATOR;    
    $filename=$request->getParam('product_id');
    $image = file_get_contents($filename);

    if ($image === false) {
        $response->write("Could not find $filename.");
        return $response->withStatus(404);
    }
    
    $response->write($image);
    return $response->withHeader('Content-Type', 'image/jpeg');
    }
}

}
