<?php
    class HomeController {
        private $Model;
        private $View;

        function __construct($Model, $View) {
            $this->Model = $Model;
            $this->View = $View;
        }

        public function LoadView($RequiredAction = false) {
            if (!$RequiredAction) {
                $this->View->LoadView();
            } else {
                $this->View->$RequiredAction();
            }
        }
    }
    
?>