<?php
    class HomeView {
        
        public function LoadView() {
            include_once "Pages/Home/Templates/Header.Home.php";
            include_once "Pages/Menus/MainMenu.php";
            include_once "Pages/Home/Home.php";
            include_once "Pages/Footer/Footer.php";
            include_once "Pages/Home/Templates/Footer.Home.php";
        }
    }
    
?>