<?php

namespace AppBundle\Repository;

/**
 * AlbumRepository
 *
 * This class was generated by the Doctrine ORM. Add your own custom
 * repository methods below.
 */
class AlbumRepository extends \Doctrine\ORM\EntityRepository
{
    public function findAll()
    {
        return $this->getEntityManager()
            ->getRepository('AppBundle:Album')
            ->findBy(array(), array('name' => 'ASC'));
    }

    public function findAllWithMaxImages($maxImagesCount)
    {
        return $this->getEntityManager()
            ->createQuery(
                'SELECT a FROM AppBundle:Album a LEFT JOIN AppBundle:Image i
                 GROUP BY a.id HAVING COUNT(i.id) < :maxImagesCount
                 ORDER BY a.name ASC'
            )
            ->setParameter('maxImagesCount', $maxImagesCount)
            ->getResult();
    }
}
