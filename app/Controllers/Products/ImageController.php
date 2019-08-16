<?php
namespace App\Controllers\Products;

use App\Controllers\Controller;
use App\Models\Product;
use Respect\Validation\Validator as v;

class ImageController extends Controller{

    
    public function uploadProductImage($request,$response) {

    if($this->auth->check()) {
        $user_id=$_SESSION['user'];
        $directory=$this->product_image_directory.DIRECTORY_SEPARATOR.$user_id;

        if(!$this->makeDir($directory)){
            $response->getBody()->write(json_encode(false));
            return $response;
        }
        
        $uploadedFiles = $request->getUploadedFiles();
        $product_id=$request->getParam('product_id');

        $uploadedFile = $uploadedFiles['product_image'];

        if ($uploadedFile->getError() === UPLOAD_ERR_OK) {
            $imageUrl = $this->moveImage($directory, $uploadedFile,$product_id);
            $this->product->getProduct($product_id)->setImage($imageUrl);

            $response->withHeader("Content-type", 'image/jpg');
            $image = file_get_contents($imageUrl);
            $response->getBody()->write($image);
            return $response;
        }

        $response->getBody()->write(json_encode(false));
        return $response;
    }
    $response->getBody()->write(json_encode(false));
    return $response;
}

public function moveImage($directory,$uploadedFile,$filename) {

    $extension = pathinfo($uploadedFile->getClientFilename(), PATHINFO_EXTENSION);
    $basename = $filename;
    $filename = sprintf('%s.%0.8s', $basename, $extension);

    $uploadedFile->moveTo($directory . DIRECTORY_SEPARATOR . $filename);
    return $directory.DIRECTORY_SEPARATOR.$filename;
}

function makeDir($path)
{
     return is_dir($path) || mkdir($path);
}

public function downloadProductImage($request,$response,$args) {

    if($this->auth->check()) {

    $user_id=$_SESSION['user'];
    $product_id=$args['product_id'];
    $product=$this->product->getProduct($product_id);
    $filepath=$product->imageurl;    
    $image = file_get_contents($filepath);

    if ($image === false) {
        $response->write("Could not find $filename.");
        return $response->withStatus(404);
    }
    
    $response->withHeader("Content-type", 'image/jpg');
    $response->getBody()->write($image);
    return $response;
    }
}

}
