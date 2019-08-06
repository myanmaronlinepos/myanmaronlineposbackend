<?php

namespace App\Controllers\Products;

use App\Controllers\Controller;
use App\Models\Product;
use  App\Models\DataModel\ProductData;
use Respect\Validation\Validator as v;

class ProductController extends Controller
{

//get all product own user by user_id

    public function getAllProducts($request, $response)
    {
        if ($this->auth->check()) {

            $user_id  = $_SESSION['user'];
            $response_products=[];
            $products = $this->product->getProducts($user_id);

            foreach($products as $product) {

                if(!$product) {
                    continue;
                } 

                $category=$this->category->getCategory($product->category_id);
                if(!$category) {
                    continue;
                }
                $tag=$this->tag->getTag($product->tag_id);

                if(!$tag) {
                    continue;
                }
                $product_tmp=new ProductData(
                    $product->product_id,
                    $product->product_name,
                    $category->category_name,
                    $tag->tag_name,
                    $product->imageurl,
                    $product->price_sell
                );
                $response_products[]=$product_tmp;
            }
            $response->getBody()->write(json_encode($response_products));
            return $response;

        } else {

            $response->getBody()->write(json_encode(array("permissionDenied" => true)));
            return $response;
        }

    }

    // get specific product by product_id

    public function getOneProduct($request, $response)
    {

        if ($this->auth->check()) {
            $validation = $this->validator->validate($request, [
                'product_id' => v::notEmpty()->noWhitespace(),
            ]);

            if ($validation->failed()) {

                if (isset($_SESSION['errors'])) {

                    $error = $_SESSION['errors'];
                    $response->getBody()->write(json_encode($error));

                } else {

                    $response->getBody()->write(json_encode(false));

                }

                return $response;
            }

            $product_id = $request->getParam('product_id');
            $product    = $this->product->product($product_id);
            $response->getBody()->write(json_encode($product));
            return $response;
        }

    }

    public function addProduct($request, $response)
    {
        if ($this->auth->check()) {
            $user_id = $_SESSION['user'];

            $validation = $this->validator->validate($request, [
                'product_name' => v::notEmpty(),
                'category_id'  => v::noWhitespace()->notEmpty(),
                'tag_id'       => v::notEmpty()->noWhitespace(),
                'price_cost'   => v::notEmpty()->noWhitespace(),
                'price_sell'   => v::notEmpty()->noWhitespace(),
            ]);

            if ($validation->failed()) {
                if(isset($_SESSION['errors'])) {
                    $response->getBody()->write(json_encode($_SESSION['errors']));
                    return $response->withStatus(400);   
                }
            }

            $product = Product::create([
                'product_name' => $request->getParam('product_name'),
                'user_id'      => $user_id,
                'category_id'  => $request->getParam('category_id'),
                'tag_id'       => $request->getParam('tag_id'),
                'price_cost'   => $request->getParam('price_cost'),
                'price_sell'   => $request->getParam('price_sell'),
                'imageurl'     => $request->getParam('imageurl'),
            ]);

            $response->getBody()->write(json_encode(true));
            return $response;
        }
    }

}
