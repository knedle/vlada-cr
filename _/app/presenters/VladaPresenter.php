<?php

/**
 * Homepage presenter.
 */
class VladaPresenter extends BasePresenter
{

	public function renderDefault()
	{
		$osa = $this->getService('timeline');
		$osaData = $this->getService('casovaOsa2')->where('start_parent_id IS NOT NULL OR konec_parent_id IS NOT NULL');
		$this->template->osa = $osa->order('datum ASC, typ DESC');

		// preskladat podslozky, usetrim sql
		$podrizeni = array();
		foreach ($osaData as $value) {

			$osobaStranaKabinet = array();
			$osobaStranaKabinet['id'] = $value['id'];


			$osobaStranaKabinet['osoba_id'] = $value->osoba_id;
			if (!empty($value->osoba_id)) {
				$osobaStranaKabinet['cele_jmeno'] = $value->osoba->cele_jmeno;
					// TODO - ostatni sloupce
			}
			$osobaStranaKabinet['strana_id'] = $value->strana_id;
			if (!empty($value->strana_id)) {
				$osobaStranaKabinet['strana_nazev'] = $value->strana->nazev;
			}
			$osobaStranaKabinet['kabinet_id'] = $value->kabinet_id;
			if (!empty($value->kabinet_id)) {
				$osobaStranaKabinet['kabinet_nazev'] = $value->kabinet->nazev;
				$osobaStranaKabinet['ministerstvo'] = $value->kabinet->ministerstvo;
			}


			$osoba_id = $value['osoba_id'];

			if (!empty($value->start_parent_id)) {
				$osobaStranaKabinet['poznamka'] = $value->start_poznamka;
				$parent_id = $value['start_parent_id'];
				if (empty($podrizeni['start'][$parent_id][$osoba_id])) {
					$podrizeni['start'][$parent_id][$osoba_id] = $osobaStranaKabinet;
				} else {
					$podrizeni['start'][$parent_id][$osoba_id]['kabinet_nazev'] .= ' a ' . $osobaStranaKabinet['kabinet_nazev'];
				}
			}
			if (!empty($value->konec_parent_id)) {
				$osobaStranaKabinet['poznamka'] = $value->konec_poznamka;
				$parent_id = $value['konec_parent_id'];
				$podrizeni['konec'][$parent_id][$osoba_id] = $osobaStranaKabinet;
			}

// 			if ($value->id == 22) {
// //				dump($value);
// 				dump($osobaStranaKabinet);
// 			}

		}

		$this->template->data = $osaData;
		$this->template->data2 = $podrizeni;
	}

}

