<?php

namespace App\Http\Livewire;

use App\Models\Employees;
use Illuminate\Support\Facades\Storage;
use Livewire\Component;
use Livewire\WithPagination;
use Livewire\WithFileUploads;


class ShowEmployee extends Component
{
    use WithPagination;
    use WithFileUploads;

    public $search;

    //2 para ordenar los campos
    public $sort = 'id';
    public $direction = "desc";

    //emitimos el evento render en CreateEmployee para que lo eschuche ShowEmployee.php
    protected $listeners = ['render'];


    // **************** variable empleado para editar employees de la tabla, y todos los datos para editar ******
    // ************** TODO PARA EDITAR **************************
    public $empleado;

    public $image, $identificador, $nombre;

    public $open_edit = false;

    //SI NO PONGO REGLA DE VALIDACION NO CARGA LOS INPUTS CON LOS DATOS DEL REGISTRO
    protected $rules = [
        'empleado.usuario' => 'required',
        'empleado.nombre' => 'required|max:150',
        'empleado.content' => 'required',
        'empleado.email' => 'required',
        // 'empleado.image' => 'required|image|max:2048'
        
        // 'nombre' => 'required|max:150',

    ];

    protected $messages = [
        'nombre' => 'Por favor ingresar su nombre',
    ];

   
    public function mount()
    {
        $this->identificador = rand();

        //esto lo hacemos xq en el modal que esta en show-post.blade estamos haciendo referencia a la propiedad title o image del objeto $post, entonces hay que especificar tmb que $post es una instancia del modelo Post
        $this->empleado = new Employees();
    }


     //4. metodo edit para que cargue un modal y poder editar un empleado
     public function edit(Employees $employee)
     {
         $this->empleado = $employee;
         $this->open_edit = true; //esta linea hace que se abra el modal y cargue los datos del empleado
     }
 
 
     public function update()
     {
         $this->validate();
 
         if($this->image){
             Storage::delete($this->empleado->image);
             $this->empleado->image = $this->image->store('imagenes');  
         }
 
         $this->empleado->save();
 
         $this->reset(['open_edit', 'image']); //para cerrar el modal
 
         $this->identificador = rand();
         // $this->emit('render');
 
     }


    // ***************** FIN DATOS PARA EDITAR ******************************


    //3. metodo order para ordernar los campos de mi tabla
    public function order($orden)
    {

        //$sort esta inicializado con id, si sort es id y si direction es desc entonces lo ordenamos como asc de lo contrario lo ordenamos como desc y si $sort no es id cuando de click en usuario se cumple la condicion del ultimo else, se ordena como asc y ahora se repetiria la condiconal
        if ($this->sort == $orden) {
            if ($this->direction == "desc") {
                $this->direction = "asc";
            } else {
                $this->direction = "desc";
            }
        } else {
            $this->sort = $orden;
            $this->direction = "asc";
        }
    }


    //ESTO LO PUSE PERO NO FUNCIONA
    public function updatingOpen(){
        if($this->open_edit == false){
            $this->resetValidation();
            // $this->identificador = rand();
        }
    }


    
   
    public function render()
    {



        //1
        $employees = Employees::where('usuario', 'like', '%' . $this->search . '%')->orWhere('nombre', 'like', '%' . $this->search . '%')->orderBy($this->sort, $this->direction)->paginate(2);




        return view('livewire.show-employee', compact('employees'));
    }
}
