<?php


namespace App\Service;


use App\Repository\DemandesRepository;

class Pagination
{

	protected $demandesRepository;

	public function __construct(DemandesRepository $demandesRepository)
	{
		$this->demandesRepository = $demandesRepository;
	}

	public function pagination($currentPage = 1)
	{
		$paginator = [];

//Defines the limit of slice filter in TWIG display (6 articles / page)
		if($currentPage == 1) {
			$paginator['pageFloorSlice'] = 0;
		}
		else{
			$paginator['pageFloorSlice'] = ($currentPage-1)*5;
		}

		$demandes = $this->demandesRepository->findAll();
		// Generate the links to browse the page of 6 articles.
		$countDemandes = [];
		$paginator['page'] = 0;

		for ($i = 0; $i < count($demandes); $i += 5){
			$paginator['page']++;
			$paginator['countDemandes'][$i] = $paginator['page'];
		}

		return $paginator;
	}
}