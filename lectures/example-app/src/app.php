<?php

define("ROOT_DOMAIN", "wa.toad.cz");
define("ROOT_URL", "/~hurtapet/example-app");
define("STATIC_DIR", ROOT_URL . "/static");
define("SRC_DIR", __DIR__);

require SRC_DIR . "/filters.php";
require SRC_DIR . "/model/db.php";
require SRC_DIR . "/model/user.php";
require SRC_DIR . "/model/form.php";
require SRC_DIR . "/model/pages/index.php";
require SRC_DIR . "/model/pages/users.php";
require SRC_DIR . "/controller/utils.php";
require SRC_DIR . "/controller/forms/login.php";
require SRC_DIR . "/controller/forms/logout.php";
require SRC_DIR . "/controller/forms/register.php";

class App {
    public $db;
    public $user;
    public $form;
    public $appData;
    public $filters;

    public function __construct() {
        // Init model

        session_start();

        $db = new DB();
        $user = new User([
            "deps" => [
                "db" => $db
            ]
        ]);
        $form = new Form([
            "deps" => [
                "db" => $db,
                "user" => $user
            ],
            "request" => $_POST
        ]);

        $deps = [
            "db" => $db,
            "form" => $form,
            "user" => $user
        ];

        // Controller handles form requests
        if ($form->isSubmitted("login")) {
            controllerFormLogin($deps);
        } else if ($form->isSubmitted("logout")) {
            controllerFormLogout($deps);
        } else if ($form->isSubmitted("register")) {
            controllerFormRegister($deps);
        }

        // Controller gathers data needed to render current page
        $pageData = [];
        $routeFull = parse_url($_SERVER['REQUEST_URI'])["path"];
        $route = str_replace(ROOT_URL, "", $routeFull);
        switch ($route) {
            case '/':
            case '/index.php':
                $pageData = getDataForPageIndex($deps);
                break;

            case '/users.php':
                $pageData = getDataForPageUsers($deps);
                break;

            default:
                $pageData = [];
                break;
        }

        // And returns all the data current page needs;
        $this->db = $db;
        $this->user = $user;
        $this->form = $form;
        $this->page = $pageData;
        $this->filters = new Filters();
    }
}

$app = new App();

