<?php

namespace Database\Factories;

use App\Models\Usuario;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Usuario>
 */
class UsuarioFactory extends Factory
{

    protected $model = Usuario::class;
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition()
    {
        return [
            'curp'=>Str::random(18),
            'nombre'=>$this->faker->name(),
            'apellido1'=>$this->faker->lastName(),
            'apellido2'=>$this->faker->lastName(),
            'correo'=>$this->faker->safeEmail,
            'contra'=>Str::random(5),
            'status'=>$this->faker->boolean(50)
        ];
    }
}
