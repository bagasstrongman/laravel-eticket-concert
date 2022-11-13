<?php

namespace App\Services;

use App\Contracts\Models;

class Service
{
    /**
     * @var userInterface
     */
    protected $userInterface;

    /**
     * @var auditInterface
     */
    protected $auditInterface;

    /**
     * Account service constructor.
     * 
     * @param App\Contracts\Models\UserInterface $userInterface
     * @param App\Contracts\Models\AuditInterface $auditInterface
     */
    public function __construct(
        Models\UserInterface $userInterface,
        Models\AuditInterface $auditInterface,
    )
    {
        $this->userInterface = $userInterface;
        $this->auditInterface = $auditInterface;
    }
}
