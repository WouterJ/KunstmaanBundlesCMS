<?php

namespace Kunstmaan\VotingBundle\EventListener\Security;

/**
* Security listener for prevent ip to vote more than maxnumber for an event
*/
class MaxNumberByIpEventListener
{

    /**
    * RepositoryResolver
    */
    protected $repositoryResolver;

    /**
    * Number
    */
    protected $maxNumber;

    /**
    * Constructor
    * @param RepositoryResolver $repositoryResolver entity manager
    * @param integer            $maxNumber          max number
    */
    public function __construct($repositoryResolver, $maxNumber)
    {
        $this->repositoryResolver = $repositoryResolver;
        $this->maxNumber = $maxNumber;
    }

    /**
    * On vote
    * @param Event $event event
    */
    public function onVote($event)
    {

        $repository = $this->repositoryResolver->getRepositoryForEvent($event);

        if (!$repository) {
            return;
        }

        $vote = $repository->countByReferenceAndByIp($event->getReference(),  $event->getRequest()->getClientIp());

        if ($vote >= $this->maxNumber) {
             $event->stopPropagation();
        }
    }

}
