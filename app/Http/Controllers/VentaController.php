<?php

namespace App\Http\Controllers;
use App\Models\Venta;
use App\Models\cards;
use Illuminate\Http\Request;

class VentaController extends Controller
{
    public function createventa(Request $request){

        $response = "";

        $json = [
            'name_venta' => 'iron man',
            'cantidad'=> '4',
            'precio'=> '2',
            'cards_id'=> '1'
        ];

        echo json_encode($json);

        //Leer el contenido de la petición
        $data = $request->getContent();

        //Decodificar el json
        $data = json_decode($data);

        //Si hay un json válido, crear el usuario
        if($data){

            $venta = new Venta();

            //TODO: Validar los datos antes de guardar el usuario

            $venta->name_venta = $data->name_venta;
            $venta->cantidad = $data->cantidad;
            $venta->precio = $data->precio;
            $venta->cards_id = $data->cards_id;
            
            try{

                $venta->save();
                $response = "OK";
            }catch(\Exception $e){
                $response = $e->getMessage();
            }


        }


        return response($response);
    }


    public function listaventas(Request $request,$name){

        $ventas = Venta::where('name_venta','like','%'.$name.'%')->get();


            $data = [];

            foreach ($ventas as $y){

                $data[] =    [
        
       "name_venta"=>$y->name_venta,
        "cantidad"=>$y->cantidad,
        "precio"=>$y->precio
        
                    ];
        }

            return $data;



    }

     public function listarcompras(Request $request,$name){

        $compras = Venta::where('name_venta','like','%'.$name.'%')->orderBy('precio','desc')->get();


            $data = [];

            foreach ($compras as $x){

                $data[] =    [
        
       "name_venta"=>$x->name_venta,
        "cantidad"=>$x->cantidad,
        "precio"=>$x->precio
        
                    ];
        }

            return $data;



    }





  



}

