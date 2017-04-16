<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Soba;
use App\Odd;

class ActController extends Controller
{
    /**
     * Only 顯示頁面
     */
    public function index()
    {
        return view('act');
        // dd(123);
        // $ss = \App::make('snoopy');
        // dd($ss->fork());
        // $soba = \App::make('soba');
        //dd(Soba::work());
        // 建立CURL連線

    }

    /**
     * API - 回傳賠率
     */
    public function api() {
        $ch = curl_init();

        // 設定擷取的URL網址
        curl_setopt($ch, CURLOPT_URL, "http://localhost:1337/api/odds/");
        curl_setopt($ch, CURLOPT_HEADER, false);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
        // 執行
        $data = curl_exec($ch);
        // 關閉CURL連線
        curl_close($ch);

        $data = json_decode($data, true);
        $json = [];

        foreach ($data as $key => $value) {
            $this->add($value, $json);
        }
        //dd($json);
        return view('odd', [
            'data' => $json
        ]);
    }

    public function add($data,&$json){
        $letball = Odd::where('mid', $data['id'])->first();
        if($letball==null){
           $letball=new Odd();
           $letball->mid=$data['id'];
           $letball->price=$data['price'];
           $letball->save();
           $json[] = [
               'market'=>$data['market'],
               'id'=>$data['id'],
               'price'=>$data['price'],
               'refresh'=>true,
           ];
       } elseif (time() - strtotime($letball->updated_at) < 5) {//有變化閃5秒
           $json[] = [
               'market'=>$data['market'],
               'id'=>$data['id'],
               'price'=>$data['price'],
               'refresh'=>true,
           ];
       } else {
           if($letball->price==$data['price']){
               $json[] = [
                   'market'=>$data['market'],
                   'id'=>$data['id'],
                   'price'=>$data['price'],
                   'refresh'=>false,
               ];
           }else{
               $letball->price=$data['price'];
               $letball->save();
               $json[] = [
                   'market'=>$data['market'],
                   'id'=>$data['id'],
                   'price'=>$data['price'],
                   'refresh'=>true,
               ];
           }
       }
    }
}
