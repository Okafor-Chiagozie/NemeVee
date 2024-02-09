<?php

namespace App\Utils;


class Extra{   
   /**
    * Removes all the tags in a given string
    *
    * @param  mixed $content
    * @return mixed
    */
   public function remove_tags($content) :mixed
   {
      return preg_replace('/<[^>]+>/', ' ', $content);
   }
   
   /**
    * Calculates the duration it takes to read a string
    *
    * @return int
    */
   public function minuteRead($string) :int
   {
      return ceil(str_word_count($this->remove_tags($string))/200);
   }




}
