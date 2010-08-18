<?php

/**
 * This file is part of the Symfony framework.
 *
 * (c) Matthieu Bontemps <matthieu@knplabs.com>
 * (c) Thibault Duplessis <thibault.duplessis@gmail.com>
 *
 * This source file is subject to the MIT license that is bundled
 * with this source code in the file LICENSE.
 */

namespace Bundle\DoctrineUserBundle\Document;
use Doctrine\ODM\MongoDB\DocumentRepository;
use Bundle\DoctrineUserBundle\DAO\UserRepositoryInterface;

class UserRepository extends DocumentRepository implements UserRepositoryInterface
{
    /**
     * @see UserRepositoryInterface::findOneByUsername
     */
    public function findOneByUsername($username)
    {
        return $this->findOneBy(array('username' => $username));
    }

    /**
     * @see UserRepositoryInterface::findOneByEmail
     */
    public function findOneByEmail($email)
    {
        return $this->findOneBy(array('email' => $email));
    }

    /**
     * @see UserRepositoryInterface::findOneByUsernameOrEmail
     */
    public function findOneByUsernameOrEmail($usernameOrEmail)
    {
        return $this->findOne(array(
            '$or' => array(
                array('username' => $usernameOrEmail),
                array('email' => $usernameOrEmail)
            )
        ));
    }

    /**
     * @see UserRepositoryInterface::getObjectManager
     */
    public function getObjectManager()
    {
        return $this->getDocumentManager();
    }

    /**
     * @see UserRepositoryInterface::getObjectClass
     */
    public function getObjectClass()
    {
        return $this->getDocumentName();
    }

    /**
     * @see UserRepositoryInterface::getObjectIdentifier
     */
    public function getObjectIdentifier()
    {
        return $this->getClassMetadata()->identifier;
    }
}