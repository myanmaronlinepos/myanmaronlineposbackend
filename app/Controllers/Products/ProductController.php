<?php

namespace App\Controllers\Products;

use App\Controllers\Controller;
use App\Models\Product;
use App\Models\Inventory;
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
            $category_name="assign";
            $tag_name="assign";
            $product_id="";

            foreach($products as $product) {
                $product_id=$product->product_id;
                if(!$product) {
                    continue;
                } 

                $category=$this->category->getCategory($product->category_id);
                if($category) {
                    $category_name=$category->category_name;
                }

                $tag=$this->tag->getTag($product->tag_id);

                if($tag) {
                    $tag_name=$tag->tag_name;
                }
               
                $product_tmp=new ProductData(
                   $product_id,
                    $product->product_name,
                    $category_name,
                    $tag_name,
                    $product->imageurl,
                    $product->price_sell,
                    $product->price_cost
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

    public function getOneProduct($request, $response,$args)
        {
            $product_id = $args['product_id'];
            $product    = $this->product->getProduct($product_id);
            if(!$product) {
                $response->getBody()->write(json_encode(false));
                return $response->withStatus(400);
            }

            $response->getBody()->write(json_encode($product));
            return $response->withStatus(200);
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

            $inventory = Inventory::create([
                'user_id'   => $user_id,   
                'product_id'=> $product->product_id,  
                'qunatity'  => 0,
               ]);
            $product_id=$product->product_id;
            $response->getBody()->write(json_encode($product_id));
        }

        $response->getBody()->write(json_encode(false));
        return $response->withStatus(400);
    }

    public function updateProduct($request,$response) {

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

            $product_id=$request->getParam('product_id');
            $product_name=$request->getParam('product_name');
            $category_id=$request->getParam('category_id');
            $tag_id=$request->getParam('tag_id');
            $price_cost=$request->getParam('price_cost');
            $price_sell=$request->getParam('price_sell');

            $product=$this->product->getProduct($product_id);
            $product->updateProduct(
                $product_name,
                $category_id,
                $tag_id,
                $price_cost,
                $price_sell
            );
            
            $response->getBody()->write(json_encode(true));
            return $response->withStatus(200);
        }

        $response->getBody()->write(json_encode(false));
        return $response->withStatus(400);
    }
}
