<?php


namespace App\Service;


/**
 * Class Slugify
 * @package App\Service
 */
class Slugify
{

    /**
     * @param string $input
     * @return mixed
     */
    public function generate ( string $input){


        $slug = iconv('UTF-8', 'ASCII//TRANSLIT', $input);

        $slug = mb_strtolower(preg_replace( '/[^a-zA-Z0-9\-\s]/', '', $slug ));

        $slug = str_replace(' ', '-', trim($slug));

        $slug = preg_replace('/\s\s+/', '-', $slug);

        return $slug;

    }

}