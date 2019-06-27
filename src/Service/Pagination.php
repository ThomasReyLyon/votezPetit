<?php


namespace App\Service;


class Pagination
{

	public function pagination()
	{

//Defines the limit of slice filter in TWIG display (6 articles / page)
		if($request->get('page') == 1) {
			$pageFloorSlice = $request->get('page')-1;
		}
		else{
			$pageFloorSlice = ($request->get('page')-1)*6;
		}

		// Generate the links to browse the page of 6 articles.
		$countArticles = [];
		$page = 0;
		for ($i = 0; $i < count($articles); $i += 6){
			$page++;
			$countArticles[$i] = $page;
		}

		$currentPage = $request->get('page');
		return;
	}
}