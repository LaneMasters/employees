<?php

namespace App\Http\Livewire;

use Livewire\Component;
use App\Models\Employees;
use Livewire\WithFileUploads;

class CreateEmployee extends Component
{
    use WithFileUploads;

    public $open = false;

    //1 esto lo creamos para poder grabar ya que en los inputs figyran estas variables
    public $usuario, $nombre, $content, $email, $image , $identificador;

    public function mount(){
        $this->identificador = rand();
    }


    //5 propiedad para validar formulario
    protected $rules = [
        'usuario' => 'required',
        'nombre' => 'required|max:150',
        'content' => 'required',
        'email' => 'required',
        'image' => 'required|image|max:2048'
    ];

    protected $messages = [
        'usuario.required' => 'El campo usuario no puede estar vacio.',
        'nombre.required' => 'Debe ingresar su nombre completo',
        'content' => 'Por favor ingresar una descripción de su persona',
        'email' => 'Debe de ingresar un correo válido',
        'image' => 'Seleccione una imagen por favor'
    ];
    //FIN propiedad para validar formulario


    //2 creando la funcion save para grabar nuevo empleado esat figura en el boton Guardar en create.employee.blade
    public function save(){

        //6 para que se ejecute las validaciones de arriba sino sale error al grabar con campos vacios
        $this->validate();


        //para guardar la imagen
        $image = $this->image->store('imagenes');


        Employees::create([
            'usuario' => str_replace(" ", "", $this->usuario),
            'usuario' => filter_var($this->usuario, FILTER_SANITIZE_STRING),
            

            'nombre' => filter_var($this->nombre, FILTER_SANITIZE_STRING),
            // 'nombre' => $this->nombre,

            'email' => filter_var($this->email, FILTER_SANITIZE_EMAIL),

            'content' => $this->content,

            'image' => $image
        ]);
        

        //3 hago este evento render para que al grabar se actulize mi tabla en mi aplicacion, se cierre el formulario y se limpie los campos y ese render lo tiene que escuchar el ShowEmployee.php
        $this->emit('render');
        $this->reset(['open', 'usuario', 'nombre', 'content', 'email', 'image']);

    }


    //4 funcion que resetea los campos cuando cerramos el modal sin grabar, reseValidation es para que en caso quiero grabar me sale mensaje que falta llenar un campo cancelo y si vuelvo a entrar al formulario se borran las validaciones
    public function updatingOpen(){
        if($this -> open == false){
            $this->reset(['usuario', 'nombre', 'content', 'email', 'image']);
            $this->resetValidation();
            $this->identificador = rand();
        }
    }


    



    public function render()
    {
        return view('livewire.create-employee');
    }
}
