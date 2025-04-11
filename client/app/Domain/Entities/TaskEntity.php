<?php

namespace App\Domain\Entities;

use App\Domain\Enums\TaskStatus;

class TaskEntity
{
    public function __construct(
        private ?int $id = null,
        private ?string $title = null,
        private ?string $description = null,
        private ?TaskStatus $status = null,
        private ?int $importance = null,
        private ?string $deadline = null,
        private ?bool $isOverdue = false,
        private ?float $priorityScore = null,
        private ?string $createdAt = null,
        private ?string $updatedAt = null,
    ) {
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function setId(?int $id): void
    {
        $this->id = $id;
    }

    public function getTitle(): ?string
    {
        return $this->title;
    }

    public function setTitle(?string $title): void
    {
        $this->title = $title;
    }

    public function getDescription(): ?string
    {
        return $this->description;
    }

    public function setDescription(?string $description): void
    {
        $this->description = $description;
    }

    public function getStatus(): ?TaskStatus
    {
        return $this->status;
    }

    public function setStatus(?TaskStatus $status): void
    {
        $this->status = $status;
    }

    public function getImportance(): ?int
    {
        return $this->importance;
    }

    public function setImportance(?int $importance): void
    {
        $this->importance = $importance;
    }

    public function getDeadline(): ?string
    {
        return $this->deadline;
    }

    public function setDeadline(?string $deadline): void
    {
        $this->deadline = $deadline;
    }

    public function getIsOverdue(): ?bool
    {
        return $this->isOverdue;
    }

    public function setIsOverdue(?bool $isOverdue): void
    {
        $this->isOverdue = $isOverdue;
    }

    public function getPriorityScore(): ?float
    {
        return $this->priorityScore;
    }

    public function setPriorityScore(?float $priorityScore): void
    {
        $this->priorityScore = $priorityScore;
    }

    public function getCreatedAt(): ?string
    {
        return $this->createdAt;
    }

    public function setCreatedAt(?string $createdAt): void
    {
        $this->createdAt = $createdAt;
    }

    public function getUpdatedAt(): ?string
    {
        return $this->updatedAt;
    }

    public function setUpdatedAt(?string $updatedAt): void
    {
        $this->updatedAt = $updatedAt;
    }
}
