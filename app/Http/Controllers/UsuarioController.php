<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
use \Firebase\JWT\JWT;
use Illuminate\Support\Str;
class UsuarioController extends Controller
{//registrar usuarios
    public function registrar(Request $request){
    	$respuesta = "";


	$response = "";

        $json = [
     
            'name' => 'Luis',
            'email'=>'cacac',
            'password'=> 'azules123',
            'rol'=>'administrador'
        ];
	echo json_encode($json);


		//Procesar los datos recibidos
		$datos = $request->getContent();

		//Verificar que hay datos
		$datos = json_decode($datos);

		if($datos){
			//TODO: validar los datos introducidos
		
			//Crear el usuario
			$user = new User();


			//Valores obligatorios
			$user->name = $datos->name;
			$user->email = $datos->email;
			$user->rol = $datos->rol;
			$user->password = Hash::make($datos->password);

		
						
			//Guardar el user
			try{

				$user->save();

				$respuesta = "OK";
			}catch(\Exception $e){
				$respuesta = $e->getMessage();
			}

		}else{
			$respuesta = "Datos incorrectos";
		}
		


		return response($respuesta);
    }



 public function login(Request $request){
    	$respuesta = "";

		//Procesar los datos recibidos
		$datos = $request->getContent();

		//Verificar que hay datos
		$datos = json_decode($datos);

		if($datos){
			
			if(isset($datos->email)&&isset($datos->password)){

				$user = User::where("email",$datos->email)->first();

				if($user){

					if(Hash::check($datos->password, $user->password)){

						$key = "kjsfdgiueqrbq39h9ht398erubvfubudfivlebruqergubi";
                        
                        $token = JWT::encode($datos->email, $key);



						$user->api_token = $token;

						$user->save();

						$respuesta = $token;
						return response()->json([
                           'message' => 'Bienvenido'
                       ]);

					}else{
						$respuesta = "Contraseña incorrecta";
					}

				}else{
					$respuesta = "Usuario no encontrado";
				}

			}else{
				$respuesta = "Faltan datos";
			}

		}else{
			$respuesta = "Datos incorrectos";
		}
		


		return response($respuesta);
    }



	public function recuperarPassword(Request $request){

        $respuesta = "";

        $data = User::where('email',$request->email) -> first();

        $newPassword = Str::random(10);

        $hashedPassword = Hash::make($newPassword);

        try{
            $data->password = $hashedPassword;
            $data->save();
            $respuesta = "Esta es tu nueva contraseña: " . $newPassword;
        }catch(\Exception $e){
            $respuesta = $e->getMessage();
        }

        return response($respuesta);
    }



}


