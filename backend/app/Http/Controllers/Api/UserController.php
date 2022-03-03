<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use \App\Models\User;

class UserController extends Controller
{

    public function index()
    {
        $users = User::paginate(10);
        foreach($users as $key => $value){
            $users[$key]["link_image"] = asset('storage/'.$value->image);
        }
        return response()->json($users, 200);
    }

    public function store(\App\Http\Requests\StoreUserRequest $request)
    {
        $patch = $this->upload($request);
        try{

            if($request->file("image") && !$patch)
                throw new \Exception('Não foi possivel fazer upaload do arquivo arquivo'); 
           
            $user = new user;
            $user->name         = $request->name;
            $user->email        = $request->email;
            $user->password     = bcrypt($request->password);
            $user->phone        = $request->phone;
            $user->image        = $patch['image']?? null;
            
            $user->save();
            return response()->json("Usuário criado com sucesso", 200);
        }
        catch (\Exception $e) {
            //return $e->getMessage();
            if($patch){
                \Storage::disk('public')->delete($patch['image']);
            }

            return response()->json("Não foi cadastrar usuário, procure o administrador do sistema", 404);
        }
    }

    private function upload(Request $request) {

        try{
            if(!empty($request->file("image"))){                
                $imagens        = $request->file("image");
                $temp_patch     = ["image" => $imagens->store("temp_image", "public")];                
            }
            
            return  $temp_patch ?? false;
        }
        catch (\Exception $e) {
            return false;
        }
    }

    public function show($id)
    {
        $user = User::find((int)$id);
        if(isset($user)){
            return response()->json($user, 200);
        }
        else{
            return response()->json("Usuário não existe", 404);
        }
    }

    public function update(\App\Http\Requests\UpdateUserRequest $request, $id)
    {
        $patch = $this->upload($request);
        try{
           
            $user = User::find((int)$id);
            if(!isset($user))
                throw new \Exception('Usuario não encontrado');

            $user->name         = $request->name;
            $user->email        = $request->email;
            $user->phone        = $request->phone;

            $ext = ['png', 'gif', 'jpg', 'jpge'];
            if(!in_array($request->image->extension(), $ext)){
                throw new \Exception('Erro ao apagar'); 
            }else if(!empty($patch['image'])){
                \Storage::disk('public')->delete($user->image);
                $user->image = $patch['image'];
            }

            $user->update();
            return response()->json("Usuário atualizado com sucesso", 200);
        }
        catch (\Exception $e) {
            //return $e->getMessage();
            if($patch){
                \Storage::disk('public')->delete($patch['image']);
            }
            return response()->json("Não foi atualizar usuário, procure o administrador do sistema", 404);
        }
    }

    public function destroy($id)
    {
        $user = User::find((int)$id);
        if(isset($user)){
            try{
                //throw new \Exception('Erro ao apagar');
                \Storage::disk('public')->delete($user->image);
                $user->delete();
                return response()->json("Usuário $user->id apagado com sucesso", 200);
            }
            catch (\Exception $e) {
                //return $e->getMessage();
                return response()->json("Não foi possivel apagar o registro, procure o administrador do sistema", 404);

            }
            
        }
        else{
            return response()->json("Não foi possivel apagar o registro, usuário não existe", 404);
        }
    }
}
