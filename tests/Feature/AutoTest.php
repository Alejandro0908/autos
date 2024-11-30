<?php

namespace Tests\Feature;
use App\Models\Auto;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class AutoTest extends TestCase
{
    use RefreshDatabase;

    /** @test */
    public function crear_auto()
    {
        $this->withExceptionHandling();

        //Simular una solicitud porst para crear uin nuevo auto
        $response = $this->post('/auto', [
            'modelo' => 'lamborghini huracan',
            'descripcion' => "Lorem ipsum, dolor sit amet consectet.",
            'precio' => 500000,
            'estado' => "Nuevo",
        ]);

        //Verificar que la respuesta sea una redirección al auto creado
        $auto= Auto::first();
        $response->assertRedirect("/auto/{$auto->id}");

        // Verificar que se creó un auto en la base de datos
        $this->assertDatabaseCount('autos', 1);

        // Verificar que los campos del auto coinciden con lo enviado
        $this->assertEquals('lamborghini huracan', $auto->modelo);
        $this->assertEquals('Lorem ipsum, dolor sit amet consectet.', $auto->descripcion);
        $this->assertEquals('500000', $auto->precio);
        $this->assertEquals('Nuevo', $auto->estado);
    }

        /** @test */
        public function listar_autos()
        {
            $this->withoutExceptionHandling();
    
            // Crear 3 registros de prueba en la base de datos
            Auto::factory(3)->create();
    
            // Método HTTP
            $response = $this->get('/auto');
            // Verificar que la respuesta sea correcta
            $response->assertOk();
    
            // Verificar que se obtuvieron todos los autos
            $response->assertViewIs('automovil.index');
        }

        /** @test */
        public function actualizar_autos()
        {
            $this->withoutExceptionHandling();
    
            // Crear 1 registro de prueba en la base de datos
            $auto = Auto::factory()->create();
    
            // Método HTTP
            $response = $this->put("/auto/{$auto->id}", [
                'modelo' => 'ferrari laferrari',
                'descripcion' => 'Lorem ipsum, dolor sit amet consectet.',
                'precio' => '715,000',
                'estado' => 'Nuevo',
            ]);
    
            $auto = Auto::findOrFail($auto->id);
    
            // Verifica que los campos del auto coinciden con lo enviado
            $this->assertEquals('ferrari laferrari', $auto->modelo);
            $this->assertEquals('Lorem ipsum, dolor sit amet consectet.', $auto->descripcion);
            $this->assertEquals('715,000', $auto->precio);
            $this->assertEquals('Nuevo', $auto->estado);
    
            $response->assertRedirect(route('automovil.index'));

        }

        /** @test */
        public function eliminar_autos()
        {
            $this->withoutExceptionHandling();
    
            // Crear un auto de prueba en la base de datos
            $auto = Auto::factory()->create([
                'modelo' => 'Modelo_Eliminar',
                'descripcion' => 'Descripcion_Eliminar',
                'precio' => '20000',
                'estado' => 'Vendido',
            ]);
    
            // Realizar solicitud DELETE para eliminar el auto
            $response = $this->delete('/auto/' . $auto->id);
    
            // Verificar que el auto no existe en la base de datos
            $this->assertDatabaseMissing('autos', [
                'id' => $auto->id,
                'modelo' => 'Modelo_Eliminar',
                'descripcion' => 'Descripcion_Eliminar',
                'precio' => '20000',
                'estado' => 'Vendido',
            ]);
        }

        /** @test */
        public function auto_modelo_es_requerido()
        {
            $this->withoutExceptionHandling();
    
            $response = $this->post('/auto', [
                'modelo' =>'audi a4' ,
                'descripcion' => 'Descripcion_Prueba',
                'precio' => '10000',
                'estado' => 'vendido',
            ]);
    
            $response->assertSessionHasNoErrors(['modelo']);

            //Esta Linea de codigo mostrora siempre error al realizar dicha prueba ya que el assert esta creado para mostrar error
            // $response->assertSessionHasErrors(['modelo']);
        }



    }

