<?php 

class Administracion_resumenController extends Administracion_mainController
{
  public $botonpanel = 9;

  public function indexAction()
  {
    $resultados_model = new Administracion_Model_DbTable_Resultados();
    $zonas_model = new Administracion_Model_DbTable_Zonas();
    $candidatos_model = new Administracion_Model_DbTable_Candidatos();
    $get_zonas = $zonas_model->getList("", "");
    $get_candidatos = $candidatos_model->getList("", "");
    $response = array();
    foreach($get_zonas as $zona){
      $response[$zona->id]['nombre'] = $zona->zona;
      foreach($get_candidatos as $candidato){
        $get_resultados = $resultados_model->getList("candidato = '".$candidato->id."'", "");
        $response[$zona->id][$candidato->id]['candidato'] = $candidato->nombre;
        $response[$zona->id][$candidato->id]['votos'] = count($get_resultados);
      }
    }
    // echo '<pre>';
    //   print_r($response);
    // echo '</pre>';
    $this->_view->resultados = $response;
  }
}