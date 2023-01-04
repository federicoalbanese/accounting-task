<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

/**
 * Class Document
 *
 * @package App\Models
 * @property integer        id
 * @property string         name
 * @property string         status
 * @property int|null       assigned_to
 * @property \DateTime      created_at
 * @property \DateTime      updated_at
 */
class CustomerDocument extends Model
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
     * @return CustomerDocument
     */
    public function setName(string $name): CustomerDocument
    {
        $this->name = $name;

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
     * @return CustomerDocument
     */
    public function setStatus(string $status): CustomerDocument
    {
        $this->status = $status;

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
     * @return CustomerDocument
     */
    public function setAssignedTo(?int $assigned_to): CustomerDocument
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
