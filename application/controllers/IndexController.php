<?php

class IndexController extends Zend_Controller_Action
{

    public function init()
    {
        /* Initialize action controller here */
    }

    public function indexAction()
    {
				$this->view->headLink()->appendStylesheet('/assets/extra-libs/c3/c3.min.css');
				$this->view->headLink()->appendStylesheet('/assets/libs/chartist/dist/chartist.min.css');
				$this->view->headLink()->appendStylesheet('/assets/extra-libs/jvector/jquery-jvectormap-2.0.2.css');
				$this->view->headLink()->appendStylesheet('/assets/dist/css/style.min.css');
				$this->view->headLink()->appendStylesheet('https://cdn.datatables.net/1.10.19/css/jquery.dataTables.css');
				
				$this->view->headScript()->appendFile('https://code.jquery.com/jquery-3.7.0.js');
				$this->view->headScript()->appendFile('https://cdn.datatables.net/1.13.7/js/jquery.dataTables.min.js');
				$this->view->InlineScript()->appendFile('/assets/libs/bootstrap/dist/js/bootstrap.bundle.min.js');
				$this->view->InlineScript()->appendFile('/assets/dist/js/app-style-switcher.js');
				$this->view->InlineScript()->appendFile('/assets/dist/js/feather.min.js');
				$this->view->InlineScript()->appendFile('/assets/libs/perfect-scrollbar/dist/perfect-scrollbar.jquery.min.js');
				$this->view->InlineScript()->appendFile('/assets/dist/js/sidebarmenu.js');
				$this->view->InlineScript()->appendFile('/assets/dist/js/custom.min.js');
				$this->view->InlineScript()->appendFile('/assets/extra-libs/c3/d3.min.js');
				$this->view->InlineScript()->appendFile('/assets/extra-libs/c3/c3.min.js');
				$this->view->InlineScript()->appendFile('/assets/libs/chartist/dist/chartist.min.js');
				$this->view->InlineScript()->appendFile('/assets/libs/chartist-plugin-tooltips/dist/chartist-plugin-tooltip.min.js');
				$this->view->InlineScript()->appendFile('/assets/extra-libs/jvector/jquery-jvectormap-2.0.2.min.js');
				$this->view->InlineScript()->appendFile('/assets/extra-libs/jvector/jquery-jvectormap-world-mill-en.js');
				$this->view->InlineScript()->appendFile('/assets/dist/js/pages/dashboards/dashboard1.min.js');

				
				
        $modeluserlist = new Application_Model_Index();
        $getdata = $modeluserlist->user_list();
		$listgraph = $modeluserlist->get_list_tabletes();

        // Zend_Debug::dump($listgraph);die('debug');
        $this->view->datauser = $getdata;
        $this->view->tabeltes = $listgraph;
    }

	public function tabletesAction() {
		// die();
		try {
			$authAdapter = Zend_Auth::getInstance();
			$identity = $authAdapter->getIdentity();
			$params = $this->getRequest()->getParams();
		} catch (Exception $e) {
			
		}
		
		$this->_helper->layout->disableLayout();
		$cc = new Application_Model_Index();
		//dibuka
		// $bulan = $params['bulan'];
		// $tahun = $params['tahun'];
		
		$countgraph = $cc->count_list_tabletes();
		$listgraph = $cc->get_list_tabletes();
			// Zend_Debug::dump($_POST);die('a');
		// Zend_Debug::dump($listgraph);die('aa');
		// $getgmws = $cc->get_gmws();
		// $getmgr = $cc->get_mgr();		
		$iTotalRecords = intval($countgraph);
		$iDisplayLength = intval($_POST ['iDisplayLength']);
		$iDisplayLength = $iDisplayLength < 0 ? $iTotalRecords : $iDisplayLength;
		$iDisplayStart = intval($_POST ['iDisplayStart']);
		$sEcho = intval($_POST ['sEcho']);

		$records = array();
		$records ["aaData"] = array();

		$end = $iDisplayStart + $iDisplayLength;
		
		$i = 1;
		foreach ($listgraph as $k => $v){
			$date = new DateTime($v['PERIODE_DATE'] );
			$dtx = $date->format('Y-m-d');
			// $find = array("<b>","</b>", "</i>","</i>");
			 // Zend_Debug::dump($v);die('s');
			$records ["aaData"] [] = array(
				// $iDisplayStart + $k + 1,
				$v['OPR_HAK'],
				$v['OPR_KEWAJIBAN'],
				$v['DOM_SLI'],
				$v['IC_OG'],
				$v['SOKI_KEY'],
				$v['BILLING'],
				$v['ID_BILLING'],
				$v['KATEGORI'],
				$v['CUSTOMER'],
				$v['SEGMENT'],
				$v['BP_NUMBER']		
				);
			$i++;
		}
		// Zend_Debug::dump($records);die();

		$records ["sEcho"] = $sEcho;
		$records ["iTotalRecords"] = $iTotalRecords;
		$records ["iTotalDisplayRecords"] = $iTotalRecords;

		header("Access-Control-Allow-Origin: *");
		header('Content-Type: application/json');
		echo json_encode($records);
		die();
	}

}

