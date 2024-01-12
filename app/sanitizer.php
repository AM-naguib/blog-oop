<?php 

class Sanitizer{
    public function sanitiz($string){
        return trim(html_entity_decode(htmlspecialchars($string)));
    }
}