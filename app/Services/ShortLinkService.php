<?php
    namespace App\Services;
    class ShortLinkService{
        public function shorten($long_link){
            return $long_link;
            // $data = [
            //     'long_link'=>
            // ];
            // return ShortLink::firstOrNew($data);
        }
    }
