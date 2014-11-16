<?php

function image_resizer($width, $height, $filepath)
{
    $filepath = sfConfig::get('sf_web_dir').$filepath;

    if (!is_readable($filepath) or empty($filepath) or !is_file($filepath))
    {
        $filepath = sfConfig::get('sf_web_dir').'/uploads/default/empty.gif';
    }
    $orgFilename = basename($filepath);
    $orgFileDir = dirname($filepath);
    $thumbDir = sfConfig::get('sf_web_dir').'/imgres/'.md5($filepath);
    if (!is_dir($thumbDir))
        mkdir($thumbDir);    
    $thumbDir .= '/'.$width.'x'.$height;
    if (!is_dir($thumbDir))
        mkdir($thumbDir);

    $thumbImagePath = $thumbDir.'/'.$orgFilename;
    if (!is_readable($thumbImagePath))
    {
        $c = new eCrop($filepath);
        $c->setThumbSize($width, $height);

        if ($width > $height)
        {
            $c->cropLargestPossibleArea($thumbImagePath, eCrop::CROP_CENTER, eCrop::CROP_CENTER, $width / $height);
        }
        else
        {
            $c->cropLargestPossibleArea($thumbImagePath, eCrop::CROP_CENTER, eCrop::CROP_CENTER, $width / $height);
        }
    }
    return str_replace($_SERVER['DOCUMENT_ROOT'], '', str_replace('//', '/', $thumbImagePath));
}