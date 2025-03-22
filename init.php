<?php
// (A) RELYING PARTY - CHANGE TO YOUR OWN!
$rp = [
  "name" => "Ubibracelet",
  "id" => "localhost"
];

$saveto = "user.txt"; 
 
// (C) START SESSION & LOAD WEBAUTHN LIBRARY
session_start();
require "vendor/autoload.php";
$WebAuthn = new lbuchs\WebAuthn\WebAuthn($rp["name"], $rp["id"]);
