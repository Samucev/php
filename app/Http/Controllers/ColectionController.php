<?php

namespace App\Http\Controllers;
use App\Models\Colection;
use App\Models\cards;
use Illuminate\Http\Request;

class ColectionController extends Controller
{
   public function createcolection(Request $request){

        $response = "";

        $json = [
            'name_colection' => 'aaa',
            'simbol'=> 'cc',
            'date'=> '2020-03-01',
            'name_cards' => 'Ejemplar de Maderazarza',
            'description'=> 'Guerrero elfo',
            'collection'=> 'Salvat-Hachette 2011',
            'colection_id'=> '1'
        ];

        echo json_encode($json);

        //Leer el contenido de la petición
        $data = $request->getContent();

        //Decodificar el json
        $data = json_decode($data);

        //Si hay un json válido, crear el usuario
        if($data){

            $colection = new Colection();

            //TODO: Validar los datos antes de guardar el usuario
  			  $card = new cards();

            //TODO: Validar los datos antes de guardar el usuario

            $card->name_cards = $data->name_cards;
            $card->description = $data->description;
            $card->collection = $data->collection;
            $card->colection_id = $data->colection_id;

            $colection->name_colection = $data->name_colection;
            $colection->simbol = $data->simbol;
            $colection->date = $data->date;




            try{
                $colection->save();
                $card->save();

                $response = "OK";
            }catch(\Exception $e){
                $response = $e->getMessage();
            }


        }


        return response($response);
    }
}

