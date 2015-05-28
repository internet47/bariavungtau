<?php

$user = 'admin';
$login = '123456';




$xdoc = new DomDocument;
$xdoc->Load('desserts.xml');
$root = $xdoc->firstChild;
$newAdmin = $xdoc->createElement('admin');
$root->appendChild($newAdmin);


$newUser = $xdoc->createElement('user');
$newAdmin->appendChild($newUser);
$userText = $xdoc->createTextNode($user);
$newUser->appendChild($userText);

$newLogin = $xdoc->createElement('login');
$newAdmin->appendChild($newLogin);
$loginText = $xdoc->createTextNode($login);
$newLogin->appendChild($loginText);


$xdoc->save('desserts.xml');?>