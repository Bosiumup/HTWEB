<?php 
require 'vendor/autoload.php';
use Cloudinary\Configuration\Configuration;
use Cloudinary\Api\Upload\UploadApi;

Configuration::instance([
    'cloud' => [
      'cloud_name' => 'dibdjlwrn', 
      'api_key' => '563737695937891', 
      'api_secret' => 'GiJR0BcEAq_-X0bbVizsmYFjO4o'],
    'url' => [
      'secure' => true]]);
?>