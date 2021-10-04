<?php
    require_once "./models/ViewsModel.php";
    
    class ViewsController extends ViewsModel {
        public function getViewController() {
            if (isset($_GET['route'])) {
                $route = explode("/", $_GET['route']);
                $response = ViewsModel::getViewModel($route[0]);
            } else {
                $response = "index";
            }
            return $response;
        }
    }