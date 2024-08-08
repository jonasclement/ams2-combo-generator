<?php

declare(strict_types=1);

namespace App\Helpers;

use App\Enums\TagEnum;
use App\Models\TaggableInterface;

abstract class AbstractTagger
{
    /** @var array<string, mixed> $rawData */
    protected array $rawData;

    /**
     * Add known tags to tracks
     *
     * @param TaggableInterface $model
     * @param array<string, mixed> $rawData
     */
    public function tag(TaggableInterface $model, array $rawData): void
    {
        $this->rawData = $rawData;

        if ($this->isDlc()) {
            $model->tags()->create(['tag' => TagEnum::DLC->value])->save();
        }

        if ($this->isRallyCrossContent()) {
            $model->tags()->create(['tag' => TagEnum::RallyCross->value])->save();
        }

        if ($this->isKartingContent()) {
            $model->tags()->create(['tag' => TagEnum::Kart->value])->save();
        }
    }

    abstract protected function isKartingContent(): bool;

    protected function isDlc(): bool
    {
        // @phpstan-ignore offsetAccess.nonOffsetAccessible
        return isset($this->rawData['extra_data']['dlc']);
    }

    protected function isRallyCrossContent(): bool
    {
        if (!$this->isDlc()) {
            return false;
        }

        // @phpstan-ignore offsetAccess.nonOffsetAccessible
        return $this->rawData['extra_data']['dlc'] === 'Adrenaline Pack Pt.1';
    }
}
