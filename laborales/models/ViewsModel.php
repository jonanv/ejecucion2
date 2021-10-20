<?php
    class ViewsModel {
        protected function getViewModel($view) {
            $whiteList = array("admin", "logout", "entry-guardianships", "executory");

            if (in_array($view, $whiteList)) {
                if (is_file("./views/pages/" . $view . ".php")) {
                    $content = "./views/pages/" . $view . ".php";
                } else {
                    $content = "login";
                }
            } elseif ($view == "login") {
                $content = "login";
            } elseif ($view == "forgot-password") {
                $content = "forgot-password";
            } elseif ($view == "recover-password") {
                $content = "recover-password";
            } elseif ($view == "index") {
                $content = "index";
            } else {
                $content = "404";
            }
            return $content;
        }
    }