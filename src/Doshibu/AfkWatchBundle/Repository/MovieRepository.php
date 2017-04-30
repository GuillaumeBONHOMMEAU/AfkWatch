<?php

namespace Doshibu\AfkWatchBundle\Repository;

use Doctrine\ORM\EntityRepository;
use Doctrine\ORM\Query;
use Doctrine\ORM\Tools\Pagination\Paginator;

/**
 * MovieRepository
 *
 * This class was generated by the Doctrine ORM. Add your own custom
 * repository methods below.
 */
class MovieRepository extends EntityRepository
{
	public function getAll($asArray=false)
	{
		$qb = $this
			->createQueryBuilder('m')
			->getQuery();

		return ($asArray) ? $qb->getResult(Query::HYDRATE_ARRAY) : $qb->getResult();
	}

	public function getAllWithGenres($limit=20, $asArray=false)
	{
		$qb = $this
			->createQueryBuilder('m')
			->leftJoin('m.genders', 'genres')
			->addSelect('genres')
			->join('m.imageLarge', 'imageL')
			->addSelect('imageL')
			->join('m.imageSmall', 'imageS')		
			->addSelect('imageS')
			->orderBy('m.addedAt', 'DESC')
			->getQuery()
			->setMaxResults($limit);

		return ($asArray) ? $qb->getResult(Query::HYDRATE_ARRAY) : $qb->getResult();
	}

	public function findByGenre($slug, $page, $nbPerPage)
	{
		$qb = $this->createQueryBuilder('m')
			->leftJoin('m.genders', 'genres')
			->addSelect('genres')
			->join('m.imageLarge', 'imageL')
			->addSelect('imageL')
			->join('m.imageSmall', 'imageS')		
			->addSelect('imageS')
			->where('genres.slug = :slug')
			->setParameter('slug', $slug)
			->orderBy('m.addedAt', 'DESC')
			->getQuery();

		$qb->setFirstResult(($page-1) * $nbPerPage)
			->setMaxResults($nbPerPage);

		return new Paginator($qb, true);
	}

	public function findByPays($slug, $page, $nbPerPage)
	{
		$qb = $this->createQueryBuilder('m')
			->leftJoin('m.countries', 'pays')
			->addSelect('pays')
			->leftJoin('m.imageLarge', 'imageL')
			->addSelect('imageL')
			->leftJoin('m.imageSmall', 'imageS')
			->addSelect('imageS')
			->where('pays.slug = :slug')
			->setParameter('slug', $slug)
			->orderBy('m.addedAt', 'DESC')
			->getQuery();

		$qb->setFirstResult(($page-1) * $nbPerPage)
			->setMaxResults($nbPerPage);

		return new Paginator($qb, true);
	}

	public function findMostPopular($limit=35, $asArray=false)
	{
		$qb = $this->createQueryBuilder('m')
			->leftJoin('m.imageLarge', 'imageL')
			->addSelect('imageL')
			->leftJoin('m.imageSmall', 'imageS')
			->addSelect('imageS')
			->orderBy('m.nbViews', 'DESC')
			->getQuery()
			->setMaxResults($limit);

		return ($asArray) ? $qb->getResult(Query::HYDRATE_ARRAY) : $qb->getResult();
	}

	public function findMostPopularByGenre($slug, $limit=10, $asArray=false)
	{
		$qb = $this->createQueryBuilder('m')
			->leftJoin('m.genders', 'genres')
			->addSelect('genres')
			->join('m.imageLarge', 'imageL')
			->addSelect('imageL')
			->join('m.imageSmall', 'imageS')		
			->addSelect('imageS')
			->where('genres.slug = :slug')
			->setParameter('slug', $slug)
			->orderBy('m.nbViews', 'DESC')
			->getQuery()
			->setMaxResults($limit);

		return ($asArray) ? $qb->getResult(Query::HYDRATE_ARRAY) : $qb->getResult();
	}

	public function findMostPopularByPays($slug, $limit=10, $asArray=false)
	{
		$qb = $this->createQueryBuilder('m')
			->leftJoin('m.countries', 'pays')
			->addSelect('pays')
			->leftJoin('m.imageLarge', 'imageL')
			->addSelect('imageL')
			->leftJoin('m.imageSmall', 'imageS')
			->addSelect('imageS')
			->where('pays.slug = :slug')
			->setParameter('slug', $slug)
			->orderBy('m.nbViews', 'DESC')
			->getQuery()
			->setMaxResults($limit);

		return ($asArray) ? $qb->getResult(Query::HYDRATE_ARRAY) : $qb->getResult();
	}

	public function getOneById($id)
	{
		$qb = $this->createQueryBuilder('m')
			->leftJoin('m.genders', 'genres')
			->addSelect('genres')
			->leftJoin('m.countries', 'pays')
			->addSelect('pays')
			->leftJoin('m.imageLarge', 'imageL')
			->addSelect('imageL')
			->leftJoin('m.imageSmall', 'imageS')
			->addSelect('imageS')
			->where('m.id = :id')
			->setParameter('id', $id)
			->getQuery()
			->getResult();

		return $qb;
	}

	public function getOneBySlug($slug)
	{
		$qb = $this->createQueryBuilder('m')
			->leftJoin('m.genders', 'genres')
			->addSelect('genres')
			->leftJoin('m.countries', 'pays')
			->addSelect('pays')
			->leftJoin('m.imageLarge', 'imageL')
			->addSelect('imageL')
			->leftJoin('m.imageSmall', 'imageS')
			->addSelect('imageS')
			->where('m.slug = :slug')
			->setParameter('slug', $slug)
			->getQuery()
			->getResult();

		return $qb;
	}
	
	public function findMostPopularByGenres($genres, $limit=10, $asArray=false)
	{
		$qb = $this->createQueryBuilder('m')
			->leftJoin('m.genders', 'genres')
			->addSelect('genres')
			->leftJoin('m.imageLarge', 'imageL')
			->addSelect('imageL')
			->leftJoin('m.imageSmall', 'imageS')
			->addSelect('imageS');

		$i=0;
		foreach($genres as $genre)
		{
			if($i=0)
			{
				$qb->where('genres.slug = :slug')
					->setParameter('slug', $genre->getSlug());
				++$i;
			}
			else
			{
				$qb->orWhere('genres.slug = :slug')
					->setParameter('slug', $genre->getSlug());
			}
		}

		$qb = $qb->orderBy('m.nbViews', 'DESC')->getQuery()->setMaxResults($limit);

		return ($asArray) ? $qb->getResult(Query::HYDRATE_ARRAY) : $qb->getResult();
	}

	public function findByPrefix($prefix, $page, $nbPerPage)
	{
		$qb = $this->createQueryBuilder('m')
			->leftJoin('m.genders', 'genres')
			->addSelect('genres')
			->leftJoin('m.countries', 'pays')
			->addSelect('pays')
			->leftJoin('m.imageLarge', 'imageL')
			->addSelect('imageL')
			->leftJoin('m.imageSmall', 'imageS')
			->addSelect('imageS');

		if($prefix === 'int')
		{
			$qb->where('m.name LIKE :int0')
				->setParameter('int0', (strval(0).'%'));
			
			for($i=1; $i<=9; $i++)
			{
				$qb->orWhere('m.name LIKE :int'.$i)
					->setParameter('int'.$i, (strval($i).'%'));
			}
		}
		else
		{
			$qb->where("m.name LIKE :letterMin")
				->setParameter('letterMin', strtolower($prefix).'%')
				->orWhere("m.name LIKE :letterMaj")
				->setParameter('letterMaj', strtoupper($prefix).'%');
		}
		
		$qb->orderBy('m.name', 'ASC')
			->getQuery();

		$qb->setFirstResult(($page-1) * $nbPerPage)
			->setMaxResults($nbPerPage);

		return new Paginator($qb, true);
	}
}
