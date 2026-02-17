<?php
use Illuminate\Database\Seeder;
use App\Models\Shelter;
use App\Models\Dog;
use App\Models\Adopter;
use App\Models\Adoptions;

class DatabaseSeeder extends Seeder
{
    public function run()
    {
        // 1️⃣ Crear 3 shelters
        $shelters = Shelter::factory(3)->create();

        // 2️⃣ Crear 30 dogs repartidos entre shelters (10 por shelter)
        $dogs = collect();
        foreach ($shelters as $shelter) {
            $dogs = $dogs->merge(Dog::factory(10)->for($shelter)->create());
        }

        // 3️⃣ Crear 15 adopters
        $adopters = Adopter::factory(15)->create();

        // 4️⃣ Crear 10 adopciones
        $adoptedDogs = $dogs->random(10); // elegimos 10 perros al azar para adoptar

        foreach ($adoptedDogs as $dog) {
            $adopter = $adopters->random(); // elegimos un adoptante al azar

            Adoptions::create([
                'dog_id' => $dog->id,
                'adopter_id' => $adopter->id,
                'adoption_date' => now(),
                'fee_paid' => fake()->randomFloat(2, 50, 500),
            ]);

            // Cambiar estado del perro a adoptado
            $dog->update(['status' => 'adopted']);
        }

        // Los demás perros quedan status = 'available'
    }
}

