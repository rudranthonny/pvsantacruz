<?php

namespace App\Livewire\Forms;

use App\Models\Almacen;
use App\Models\AlmacenUser;
use App\Models\User;
use Illuminate\Support\Facades\Storage;
use Livewire\Attributes\Rule;
use Livewire\Attributes\Validate;
use Livewire\Form;

class UsuariosForm extends Form
{
    public ?User $user;

    #[Rule('required')]
    public $name;
    public $lastname;
    #[Rule('required')]
    public $username;
    public $telefono;
    #[Rule('required|email')]
    public $email;
    public $suspended;
    public $roles = [];
    public $permisos = [];

    public function set(User $user){
        $this->user = $user;
        $this->name = $user->name;
        $this->lastname = $user->lastname;
        $this->username = $user->username;
        $this->telefono = $user->telefono;
        $this->email = $user->email;
        $this->suspended = $user->suspended;
    }

    public function update($imagen = null)
    {
        $this->validate();
        $this->validate(
            [
            'username' => 'unique:users,username,'.$this->user->id,
            'email' => 'unique:users,email,'.$this->user->id,
            ]
        );
       // $this->user->update(['name','lastname','username','telefono','email','suspended']);
        $this->user->name = $this->name;
        $this->user->lastname = $this->lastname;
        $this->user->username = $this->username;
        $this->user->telefono = $this->telefono;
        $this->user->email = $this->email;
        $this->user->suspended = $this->suspended;
        $this->user->save();
        if ($imagen) {$this->eliminar_imagen_perfil();$this->subir_imagen_perfil($imagen);}
        $this->eliminar_roles();
        $this->eliminar_permisos();
        $this->agregar_roles();
        $this->agregar_permisos();
    }

    public function store($imagen = null)
    {
        $this->validate();
        $this->validate(
            [
            'username' => 'unique:users,username',
            'email' => 'unique:users,email'
            ]
        );

        $this->user = User::create($this->only('name','lastname','username','telefono','email','suspended')+['password' => bcrypt($this->username),]);
        if ($imagen) {$this->subir_imagen_perfil($imagen);}
        $this->eliminar_roles();
        $this->eliminar_permisos();
        $this->agregar_roles();
        $this->agregar_permisos();
    }

    public function eliminar_imagen_perfil(){
        if ($this->user->profile_photo_path == true)
        {
            $eliminar = str_replace('storage', 'public', $this->user->profile_photo_path);
            Storage::delete([$eliminar]);
        }
    }

    public function subir_imagen_perfil($imagen)
    {
        $extension = $imagen->extension();
        $img_marca = $imagen->storeAs('public/usuarios', $this->user->id."-".strtotime(date('Y-m-d h:i:s')).".".$extension);
        $this->user->profile_photo_path = Storage::url($img_marca);
        $this->user->save();
    }

    public function suspender(){
        if($this->user->id)
        {
            $this->user->suspended = $this->user->suspended == 1 ? 0 : 1 ;
            $this->user->save();
         }
    }

    public function agregar_almacen($almacen_id){
        if($this->user->id)
        {
            if ($almacen_id <> 'todos') {
                $vasignado = AlmacenUser::where('user_id',$this->user->id)->where('almacen_id',$almacen_id)->first();
                $valmacen = Almacen::find($almacen_id);
                if ($vasignado == false && $valmacen == true) {
                    $n_almacen_user = new AlmacenUser();
                    $n_almacen_user->almacen_id = $almacen_id;
                    $n_almacen_user->user_id = $this->user->id;
                    $n_almacen_user->save();
                }
            }
            elseif($almacen_id == 'todos'){
                $almacenes = Almacen::all();
                foreach ($almacenes as $almacen) {
                    $vasignado = AlmacenUser::where('user_id',$this->user->id)->where('almacen_id',$almacen->id)->first();
                    if ($vasignado == false) {
                        $n_almacen_user = new AlmacenUser();
                        $n_almacen_user->almacen_id = $almacen->id;
                        $n_almacen_user->user_id = $this->user->id;
                        $n_almacen_user->save();
                    }
                }
            }
        }
    }

    public function eliminar_asignacion_almacen(AlmacenUser $almacenuser){
        if($this->user->id)
        {
            if ($almacenuser->user_id == $this->user->id) {
                $almacenuser->delete();
            }
        }
    }

    public function agregar_roles()
    {
        foreach ($this->roles as  $role2)
        {
            $this->user->assignRole($role2);
        };
    }

    public function agregar_permisos()
    {
        foreach ($this->permisos as  $permiso){
            $this->user->givePermissionTo($permiso);
        };
    }

    public function eliminar_permisos()
    {
        foreach ($this->user->permissions as  $permiso)
        {
             $this->user->revokePermissionTo($permiso);
        };
    }

    public function eliminar_roles()
    {
        foreach($this->user->roles as $rola){
            $this->user->removeRole($rola->id);
            if($this->user->id == 1)
            {
                $this->user->assignRole('Administrador');
            }
        }
    }
}
