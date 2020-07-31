<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

namespace app\controllers;
use yii\web\Controller;
/**
 * Description of SaluController
 *
 * @author USUARIO
 */
class PruController extends Controller {
    //put your code here
    public function actionIndex()
    {
        return $this->render('salu',[]);
        //$this->decir();
        //return;
    }
    
    function decir()
    {
        echo "Diigo";
        //return ;
    }
}
