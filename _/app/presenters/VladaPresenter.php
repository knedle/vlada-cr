<?php

/**
 * Homepage presenter.
 */
class VladaPresenter extends BasePresenter
{

	public function renderDefault()
	{
		$osa = $this->getService('timeline');

		$kabinet = $this->getService('kabinet');
		$osoby = $this->getService('osoby');

		$rokyData = $this->getService('casovaOsa2');
		$roky = array();
		$vlady = array();
		foreach ($rokyData as $rok) {
			// priprava menu roky
			if (is_object($rok->start_datum)) {
				$r = $rok->start_datum->format('Y');
				if ($r > 0) {
					$roky[$r] = $r;
				}
			}
			if (is_object($rok->konec_datum)) {
				$r = $rok->konec_datum->format('Y');
				if ($r > 0) {
					$roky[$r] = $r;
				}
			}
			//priprava menu vlada
			if ($rok->kabinet_id == 2) {
				$r = $rok->start_datum->format('Y');
				$vlady[$rok->start_datum->format('Y-m-d').'#'.$rok->id] = $r . " " .$rok->osoba->cele_jmeno ;
			}
		}

		ksort($roky);
		ksort($vlady);

		// uprava aby v klici byl jen id na ktere budu odkazovat pomoci #
		$vladyTmp = array();
		foreach($vlady as $key => $value) {
			preg_match('/#(\d+)/i', $key, $match);
			$vladyTmp[$match[1]] = $value;
		}
		$vlady = $vladyTmp;

		// casova osa cela nebo je to filtrace
		$osaData = $this->getService('casovaOsa2');
		if (!empty($_GET['osoba'])) {
			$osa->where('osoba_id', $_GET['osoba']);
			$filtrOsoba = clone $osoby;
			$this->template->filtrOsoba = $filtrOsoba->get($_GET['osoba']);
		} elseif (!empty($_GET['kabinet'])) {
			$osa->where('kabinet_id', $_GET['kabinet']);
			$filtrKabinet = clone $kabinet;
			$this->template->filtrKabinet = $filtrKabinet->get($_GET['kabinet']);
		} else {
			$osa->where('parent_id = 0 OR parent_id IS NULL');
		}

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
				if (empty($podrizeni['konec'][$parent_id][$osoba_id])) {
					$podrizeni['konec'][$parent_id][$osoba_id] = $osobaStranaKabinet;
				} else {
					$podrizeni['konec'][$parent_id][$osoba_id]['kabinet_nazev'] .= ' a ' . $osobaStranaKabinet['kabinet_nazev'];
				}
			}

// 			if ($value->id == 22) {
// //				dump($value);
// 				dump($osobaStranaKabinet);
// 			}

		}

		$this->template->osa = $osa->order('datum ASC, poradi ASC, typ DESC');
		$this->template->data = $osaData;
		$this->template->data2 = $podrizeni;
		$this->template->roky = $roky;
		$this->template->vlady = $vlady;
		$this->template->osoby = $osoby->order('prijmeni ASC, jmeno ASC');
		$this->template->kabinet = $kabinet->order('nazev ASC');
	}

}

