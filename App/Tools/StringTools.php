<?php

namespace App\Tools;

class StringTools
{
  //name display like John D. for John Doe
  public static function anonymName($fist_name, $last_name) :string
  {
    $name = ucfirst(strtolower($fist_name)).' '.strtoupper($last_name[0]).'.';
    return $name;
  }
  public static function slugify($text, string $divider = '-')
{
  // replace non letter or digits by divider
  $text = preg_replace('~[^\pL\d]+~u', $divider, $text);

  // transliterate
  $text = iconv('utf-8', 'us-ascii//TRANSLIT', $text);

  // remove unwanted characters
  $text = preg_replace('~[^-\w]+~', '', $text);

  // trim
  $text = trim($text, $divider);

  // remove duplicate divider
  $text = preg_replace('~-+~', $divider, $text);

  // lowercase
  $text = strtolower($text);

  if (empty($text)) {
    return 'n-a';
  }

  return $text;
}
public static function formatNameImage($file)
{
  $extension = '.'.pathinfo($file['name'], PATHINFO_EXTENSION );
  $baseName = str_replace($extension, "", $file['name']);
  $slugbaseName = self::slugify($baseName);
  $nameImage = $slugbaseName.$extension;
  return $nameImage;
}
}
