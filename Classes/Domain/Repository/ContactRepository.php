<?php
namespace TARS\AnnuaireTars\Domain\Repository;

/***************************************************************
 *
 *  Copyright notice
 *
 *  (c) 2017 Tiphaine GIRARDOT <tiphaine.girardot@etu.u-bordeaux.fr>
 *           Romain DURADE <romain.durade@etu.u-bordeaux.fr>
 *           Alexandre DUVIVIERS <alexandre.duviviers@etu.u-bordeaux.fr>
 *           Sylvain METAYER <sylvain.metayer@etu.u-bordeaux.fr>
 *
 *  All rights reserved
 *
 *  This script is part of the TYPO3 project. The TYPO3 project is
 *  free software; you can redistribute it and/or modify
 *  it under the terms of the GNU General Public License as published by
 *  the Free Software Foundation; either version 3 of the License, or
 *  (at your option) any later version.
 *
 *  The GNU General Public License can be found at
 *  http://www.gnu.org/copyleft/gpl.html.
 *
 *  This script is distributed in the hope that it will be useful,
 *  but WITHOUT ANY WARRANTY; without even the implied warranty of
 *  MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
 *  GNU General Public License for more details.
 *
 *  This copyright notice MUST APPEAR in all copies of the script!
 ***************************************************************/
use TARS\AnnuaireTars\Domain\Model\Organisme;
/**
 * The repository for Contacts
 */
class ContactRepository extends \TYPO3\CMS\Extbase\Persistence\Repository
{

    /**
     * @var array
     */
    protected $defaultOrderings = array(
        'sorting' => \TYPO3\CMS\Extbase\Persistence\QueryInterface::ORDER_ASCENDING
    );


    public function search(array $keywords){
	    $query = $this->createQuery();
	    $searchterms = array();
	    foreach ($keywords as $keyword) {
	    	array_push($searchterms, $query->like('nom', "%$keyword%"));
	    	array_push($searchterms, $query->like('prenom', "%$keyword%"));
	    }

	    $query->matching($query->logicalOr($searchterms));

	    return $query->execute();

    }

    public function findByOrganisme(Organisme $organisme) {


      $query = $this->createQuery();

      $query->matching($query->equals('organisme', $organisme));
      return $query->execute();
    }

}
