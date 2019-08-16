<?php
namespace App\Controllers\Auth;

use App\Controllers\Controller;
use App\Models\User;
use Respect\Validation\Validator as v;

class UserImageController extends Controller{

    
    public function uploadUserImage($request,$response) {

    if($this->auth->check()) {
        $user_id=$_SESSION['user'];
        $directory=$this->user_image_directory.DIRECTORY_SEPARATOR.$user_id;

        if(!$this->makeDir($directory)){
            $response->getBody()->write(json_encode(false));
            return $response;
        }
        
        $uploadedFiles = $request->getUploadedFiles();

        $uploadedFile =  $uploadedFiles['user_image'];
        
        if ($uploadedFile->getError() === UPLOAD_ERR_OK) {
            $imageUrl = $this->moveImage($directory, $uploadedFile,$user_id);
            $this->auth->user()->setImage($imageUrl);

            $response->withHeader("Content-type", 'image/jpg');
            $image = file_get_contents($imageUrl);
            $response->getBody()->write($image);
            return $response;

        }

        $response->write(json_encode(false));
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

public function downloadUserImage($request,$response) {

    if($this->auth->check()) {

    $user_id=$_SESSION['user'];
    $user=$this->auth->user();
    $filepath=$user->imageurl;    
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
