<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\cards;

class CardsController extends Controller
{
    public function createcard(Request $request){

        $response = "";

        $json = [
            'name_cards' => 'iron man',
            'description'=> 'soldado',
            'collection'=> 'marvel',
            'colection_id'=> '1'
        ];

        echo json_encode($json);

        //Leer el contenido de la petición
        $data = $request->getContent();

        //Decodificar el json
        $data = json_decode($data);

        //Si hay un json válido, crear el usuario
        if($data){

            $card = new cards();

            //TODO: Validar los datos antes de guardar el usuario

            $card->name_cards = $data->name_cards;
            $card->description = $data->description;
            $card->collection = $data->collection;
            $card->colection_id = (isset($data->colection_id) ? $data->colection_id : $card->colection_id);

            try{
                $card->save();
                $response = "OK";
            }catch(\Exception $e){
                $response = $e->getMessage();
            }


        }


        return response($response);
    }

}