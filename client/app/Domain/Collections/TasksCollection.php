<?php

namespace App\Domain\Collections;

use App\Core\Base\Collection;
use App\Domain\Entities\TaskEntity;

/**
 * @property TaskEntity[] $items
 */
class TasksCollection extends Collection
{
    public function sortByPriorityScore(): void
    {
        usort($this->items, function (TaskEntity $a, TaskEntity $b) {
            return $b->getPriorityScore() <=> $a->getPriorityScore();
        });
    }
}
