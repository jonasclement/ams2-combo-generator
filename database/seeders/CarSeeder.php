<?php

namespace Database\Seeders;

use App\GameDataTrait;
use App\Helpers\CarTagger;
use App\Models\Car;
use Illuminate\Database\Seeder;

class CarSeeder extends Seeder
{
    use GameDataTrait;

    public function __construct(private CarTagger $carTagger) {}

    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $carData = $this->getGameData('ams2-data-cars.json');

        // Convert JSON data to Car model instances
        foreach ($carData as $data) {
            $model = new Car();
            $model->name = $data['name'];
            $model->class = $data['class'];
            $model->manufacturer = $data['extra_data']['manufacturer'];
            $model->save();

            $this->carTagger->tag($model, $data);
        }
    }
}
