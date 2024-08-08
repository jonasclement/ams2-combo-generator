<?php

namespace App\Console\Commands;

use App\Exceptions\MissingDataFileException;
use App\GameDataTrait;
use App\Helpers\TrackTagger;
use App\Models\Track;
use App\Models\TrackTag;
use Illuminate\Console\Command;
use JsonException;

class ImportTracks extends Command
{
    use GameDataTrait;

    private const CACHE_FILE = 'track-data-hash.md5';

    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'app:import-tracks';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Import track data to database';

    /**
     * Execute the console command.
     */
    public function handle(): int
    {
        try {
            $trackData = $this->getTrackData('ams2-data-tracks.json');
        } catch (MissingDataFileException | JsonException $e) {
            $this->error(get_class($e) . ': ' . $e->getMessage());
            return Command::FAILURE;
        }

        // Check if contents have changed - if not, no reason to import
        if (!$this->hasDataChanged($trackData)) {
            $this->info('No changes detected, skipping import');
            return Command::SUCCESS;
        }

        // Clear tables
        Track::query()->delete();
        TrackTag::query()->delete();

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

        $this->cacheDataHash($trackData);

        return Command::SUCCESS;
    }

    private function getCacheFile(): string
    {
        return self::CACHE_FILE;
    }
}
