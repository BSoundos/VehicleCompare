<?php
require_once 'Views/newsView.php';


class newsController {


    public function newsGenerate(){
        $v = new newsView();
        $v->newsDisplay();
    }


    public function newsDetailsGenerate($newsId){
        $v = new newsView();
        $v->newsDetailsDisplay($newsId);
    }


    public function get_news_byId_controller($id){
        $mtf = new newsModel();
        $r = $mtf->get_news_byId($id);

        return $r ; 
    }

    public function get_newsdetails_byId_controller($id){
        $mtf = new newsModel();
        $r = $mtf->get_newsdetails_byId($id);

        return $r ; 
    }

    public function get_news_controller(){
        $mtf = new newsModel();
        $r = $mtf->get_news();

        return $r ; 
    }

    public function get_news_details($newsId){
        $mtf = new newsModel();
        $r = $mtf->get_news_details($newsId);

        return $r ; 
    }

    



}
?>