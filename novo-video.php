<?php

require 'src/conexao.php';
require 'src/Model/Videos.php';
require 'src/Model/Repository/VideoRepositorio.php';

$video = new Video(null,
    $_POST['url'],
    $_POST['title']
);

$videoRepositorio = new videoRepositorio($pdo);
$cad = $videoRepositorio->cadastrarVideos($video);
if ($cad === false) {
    header("Location: index.php?sucesso=0");
} else {
    header("Location: index.php?sucesso=1");
}