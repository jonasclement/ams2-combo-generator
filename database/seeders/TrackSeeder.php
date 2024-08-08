<?php

namespace Database\Seeders;

use App\GameDataTrait;
use App\Helpers\TrackTagger;
use App\Models\Track;
use Illuminate\Database\Seeder;

class TrackSeeder extends Seeder
{
    use GameDataTrait;

    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $trackData = $this->getGameData('ams2-data-tracks.json');

        // Convert JSON data to Track model instances
        foreach ($trackData as $data) {
            $model = new Track();
            $model->name = $data['name'];
            $model->display_name = $data['extra_data']['translated_name'];
            $model->grid_size = $data['gridsize'];
            $model->length = $data['extra_data']['length'];
            $model->country = $data['extra_data']['country'];
            $model->save();

            TrackTagger::tag($model, $data);
        }
    }
}
