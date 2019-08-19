<?php

namespace App\Controllers\Dashboard;

use App\Controllers\Controller;
use App\Models\User;
use App\Models\DataModel\DashBoardData;

class DashboardController extends Controller
{
public $months=["January","February","March","April", "May","June","July","August",
                "September","October","November","December"];

public $days=["Sunday","Monday","Tuesday","Wednesday","Thursday","Friday","Saturday"];

public $hours=["1","2","3","4","5","6","7","8","9","10","11","12","13","14","15",
                "16","17","18","19","20","21","22","23","24"];

 public function getLabels($request,$response) {
     if($this->auth->check()) {
        $user_id=$_SESSION['user'];
        $response->getBody()->write(json_encode($this->days));
     }
 }

 public function getData($request,$response,$args) {
     if($this->auth->check()) {
         $user_id=$_SESSION['user'];
         $data_length=7;
         $costData=array_fill(0,$data_length,0);
         $sellData=array_fill(0,$data_length,0);
         $profitData=array_fill(0,$data_length,0);

         $start_date=$args['start_date'];
         $end_date=$args['end_date'];
         $sell_historys=$this->sellhistory->getData($user_id,$start_date,$end_date);
         foreach($sell_historys as $sell_history) {
             $sell_date=$sell_history->created_at;
             $dw=date_format($sell_date,'w');
             if($dw >= 0) {
                 $costData[$dw]=$this->soldoutitem->getCost($sell_date);
                 $sellData[$dw]=$this->soldoutitem->getSell($sell_date);
                 $profitData[$dw]=$this->soldoutitem->getProfit($sell_date);
             }
         }
         $dashBoardData=new DashBoardData(
            $costData,
            $sellData,
            $profitData
         );
        $response->getBody()->write(json_encode($dashBoardData));
        return $response;
     }
    
    $response->getBody()->write(json_encode(false));
    return $response;
 }
 
}
