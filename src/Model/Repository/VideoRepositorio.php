<?php

class VideoRepositorio
{
    private PDO $pdo;

    public function __construct(PDO $pdo)
    {
        $this->pdo = $pdo;
    }

    private function formarObjeto($dados)
    {
        return new Video(
            $dados['id'],
            $dados['url'],
            $dados['title']
        );
    }

    public function buscarTodos() 
    {
        $sql = "SELECT * FROM videos ORDER BY id";
        $statement = $this->pdo->query($sql);
        $videos = $statement->fetchAll(PDO::FETCH_ASSOC);

        $todosOsVideos = array_map(function($video) {
            return $this->formarObjeto($video);
        }, $videos);

        return $todosOsVideos;
    }

    public function cadastrarVideos(Video $video)
    {
        $sql = "INSERT INTO videos (url, title) VALUES (?, ?)";
        $statement = $this->pdo->prepare($sql);
        $statement->bindValue(1, $video->getUrl());
        $statement->bindValue(2, $video->getTitle());
        $statement->execute();
    }
}