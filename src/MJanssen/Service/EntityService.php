<?php
namespace MJanssen\Service;

use Doctrine\ORM\EntityRepository;

class EntityService
{
    /**
     * @var EntityRepository
     */
    protected $entityRepository;

    /**
     * @param EntityRepository $entityRepository
     */
    public function __construct(EntityRepository $entityRepository)
    {
        $this->entityRepository = $entityRepository;
    }

    /**
     * @param $identifier
     * @return null|object
     */
    public function get($identifier)
    {
        return $this->entityRepository->find($identifier);
    }
} 