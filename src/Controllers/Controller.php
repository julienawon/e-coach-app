<?php

namespace App\Controllers;

use App\Helpers\Assets;
use Twig\Environment;
use Twig\Extra\Intl\IntlExtension;
use Twig\Loader\FilesystemLoader;
use App\Models\Utilisateur;
use Twig\TwigFilter;

abstract class Controller
{

    private $loader;
    private $twig;

    public function __construct()
    {
        if (session_status() === PHP_SESSION_NONE) session_start();

        $this->loader = new FilesystemLoader(dirname(__DIR__) . '/Views');
        $this->twig = new Environment($this->loader, [
            'debug' => true,
        ]);
        $filter = new TwigFilter('is_valid_url', function ($url)
        {
            return filter_var($url, FILTER_VALIDATE_URL) !== false;
        });

        $this->twig->addExtension(new \Twig\Extension\DebugExtension());
        $this->twig->addExtension(new IntlExtension());
        $this->twig->addFilter($filter);
    }

    public function render(?string $view = null, array $params = [])
    {
        $view_path = $view . '.html.twig';
        $assets_path = Assets::assets();
        $data = $params;
        $this->twig->display($view_path, ['assets_path' => $assets_path, 'data' => $data, 'session' => $_SESSION]);
    }


    /**
     *
     * Check if the user is authenticated
     * @return void
     *
     */
    public function checkAuth()
    {
        if (!$this->isAuth()) return header('Location: /401', 401);
    }

    /**
     *
     * Check if the user is authenticated
     * @return void
     *
     */
    public function isAuth(): bool
    {
        if (!isset($_SESSION['auth'])) return false;
        return true;
    }




    /**
     *
     * Check if the user is a coach
     * @return void
     *
     */
    public function checkCoach()
    {
        if (!$this->isCoach()) return header('Location: /403', 403);
    }

    /**
     *
     * Check if the user is a coach
     * @return void
     *
     */
    public function isCoach(): bool
    {
        if (!$this->isAuth()) return false;
        if ($_SESSION['auth'] !== 'coach') return false;
        return true;
    }

    /**
     *
     * Check if the user is a client
     * @return void
     *
     */
    public function checkClient()
    {
        if (!$this->isClient()) return header('Location: /403', 403);
    }

    /**
     *
     * Check if the user is a client
     * @return void
     *
     */
    public function isClient() : bool
    {
        if (!$this->isAuth()) return false;
        if ($_SESSION['auth'] !== 'client') return false;
        return true;
    }

    public function isProfileCompleted(int $id): bool{
        $user = Utilisateur::where('id', $id)->select('est_complete')->first();
        return $user->est_complete ? true : false;
    }


}