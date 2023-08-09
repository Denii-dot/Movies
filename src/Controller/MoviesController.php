<?php

namespace App\Controller;
use App\Repository\MovieRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class MoviesController extends AbstractController
{
    private $movieRepository;

    public function __construct(MovieRepository $movieRepository)
    {
        $this->movieRepository = $movieRepository;
    }

    #[Route('/movies', methods:['GET'], name: 'movies')]
    public function index(): Response
    {
        //findAll() - SELECT * FROM movies;
        //find() - SELECT * FROM movies WHERE id = 6;
        //findBy() - SELECT * FROM movies ORDER BY id DESC;
        //findOneBy() - SELECT * FROM movies WHERE id = 6 AND title = "The Dark Knight " ORDER BY id DESC;
        //count() - SELECT COUNT() FROM movies WHERE id = 1; 
        //getClassName - get name of namespace

        $movies = $this->movieRepository->findAll();

        return $this->render('movies/index.html.twig',[
            'movies' => $movies
        ]);
    }

    #[Route('/movies/{id}', methods:['GET'], name: 'show_movie')]
    public function show($id): Response
    {

        $movie = $this->movieRepository->find($id);

        return $this->render('movies/show.html.twig',[
            'movie' => $movie
        ]);
    }
        
    
}
