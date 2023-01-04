<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

/**
 * Class Document
 *
 * @package App\Models
 * @property integer   id
 * @property string    name
 * @property string    priority
 * @property string    status
 * @property int       created_by
 * @property int|null  assigned_to
 * @property \DateTime created_at
 * @property \DateTime updated_at
 */
class Document extends Model
{
    /**
     * @return int
     */
    public function getId(): int
    {
        return $this->id;
    }

    /**
     * @return string
     */
    public function getName(): string
    {
        return $this->name;
    }

    /**
     * @param string $name
     *
     * @return Document
     */
    public function setName(string $name): Document
    {
        $this->name = $name;

        return $this;
    }

    /**
     * @return string
     */
    public function getPriority(): string
    {
        return $this->priority;
    }

    /**
     * @param string $priority
     *
     * @return Document
     */
    public function setPriority(string $priority): Document
    {
        $this->priority = $priority;

        return $this;
    }

    /**
     * @return string
     */
    public function getStatus(): string
    {
        return $this->status;
    }

    /**
     * @param string $status
     *
     * @return Document
     */
    public function setStatus(string $status): Document
    {
        $this->status = $status;

        return $this;
    }

    /**
     * @return int
     */
    public function getCreatedBy(): int
    {
        return $this->created_by;
    }

    /**
     * @param int $created_by
     *
     * @return Document
     */
    public function setCreatedBy(int $created_by): Document
    {
        $this->created_by = $created_by;

        return $this;
    }

    /**
     * @return int|null
     */
    public function getAssignedTo(): ?int
    {
        return $this->assigned_to;
    }

    /**
     * @param int|null $assigned_to
     *
     * @return Document
     */
    public function setAssignedTo(?int $assigned_to): Document
    {
        $this->assigned_to = $assigned_to;

        return $this;
    }

    /**
     * @return \DateTime
     */
    public function getCreatedAt(): \DateTime
    {
        return $this->created_at;
    }


    /**
     * @return \DateTime
     */
    public function getUpdatedAt(): \DateTime
    {
        return $this->updated_at;
    }
}
