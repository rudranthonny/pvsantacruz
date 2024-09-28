<?php

namespace App\Livewire;

use App\Livewire\Forms\UsuariosForm;
use App\Models\Almacen;
use App\Models\AlmacenUser;
use App\Models\Configuracion;
use App\Models\User;
use Illuminate\Support\Facades\DB;
use Livewire\Component;
use Livewire\Features\SupportFileUploads\WithFileUploads;
use Livewire\WithPagination;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;

class GestionarUsuarios extends Component
{

    use WithPagination;
    use WithFileUploads;
    public $configuracion;
    protected $paginationTheme = 'bootstrap';
    public UsuariosForm $usuariosform;
    public $search = '';
    public $salmacen;
    public $titlemodal = 'Añadir';
    public $pagina = 5;
    public $imagen_perfil;
    public $iteration = 1;
    public $roles2 = [];
    public $permisos2 = [];
    public function updatedSalmacen(){
        if ($this->salmacen) {
        $this->usuariosform->agregar_almacen($this->salmacen);
        }
    }

    public function eliminar_asignacion_almacen(AlmacenUser $almacenuser){
        $this->usuariosform->eliminar_asignacion_almacen($almacenuser);
    }

    public function updatedUsuariosformUsername(){
        $this->usuariosform->username = strtolower(trim($this->usuariosform->username));
    }

    public function mount(){  $this->configuracion = Configuracion::find(1); }

    public function updatedSearch(){
        $this->resetPage();
    }

    public function modal(User $user = null)
    {
        $this->reset('titlemodal','imagen_perfil','roles2','permisos2');
        $this->iteration++;
        $this->usuariosform->reset();
        if ($user->id == true) {
            $this->titlemodal = 'Editar';$this->usuariosform->set($user);
            foreach ($user->roles as $role) {
                array_push($this->roles2,$role->name);
            }
            foreach ($user->permissions as $permiso) {
                array_push($this->permisos2,$permiso->name);
            }
        }
    }

    public function guardar()
    {
        if (isset($this->usuariosform->user->id)) 
        {
            $this->usuariosform->roles = $this->roles2;
            $this->usuariosform->permisos = $this->permisos2;
            $this->usuariosform->update($this->imagen_perfil);
        }
        else {
            $this->usuariosform->roles = $this->roles2;
            $this->usuariosform->permisos = $this->permisos2;
            $this->usuariosform->store($this->imagen_perfil);
        }
        $this->dispatch('cerrar_modal_user');
    }

    public function cambiar_estado_suspension(User $user){
        $this->usuariosform->reset();
        $this->usuariosform->set($user);
        $this->usuariosform->suspender();
        $this->updatedSearch();
    }

    public function render()
    {
        $usuarios = User::where(function($query) {
            $query->Where(DB::raw("CONCAT(`name`,' ',`lastname`)"), 'like', '%' . $this->search.'%')
                    ->orwhere('username','like','%'.$this->search.'%');
        })->paginate($this->pagina);

        $almacenes = Almacen::all();
        $roles = Role   ::all();
        $permisos = Permission::all();
        return view('livewire.gestionar-usuarios', compact('usuarios','almacenes','roles','permisos'));
    }

    public function agregar_roles(User $user)
    {
        foreach ($this->roles2 as  $role2)
        {
            $user->assignRole($role2);
        };
    }
    public function agregar_permisos(User $user)
    {
        foreach ($this->permisos2 as  $permiso)
        {
            $user->givePermissionTo($permiso);
        };
    }
}
