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

/*

TODOS
    - controllers are weird, they take form instance and modify it :o
    - getDataForPage and controllerForm maybe should be in some namespace or something?
        also automatic calling of these function based on form/page name would be nice
    - filters are little weird, also there is only one function in there

*/

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

        // Controller handles form requests
        if ($form->isSubmitted("login")) {
            controllerFormLogin($form);
        } else if ($form->isSubmitted("logout")) {
            controllerFormLogout($form);
        } else if ($form->isSubmitted("register")) {
            controllerFormRegister($form);
        } else {
            throw new Exception("Unknown form submitted");
        }

        // Controller gathers data needed to render current page
        $pageData = [];
        switch ($_SERVER['REQUEST_URI']) {
            case ROOT_URL . '/':
            case ROOT_URL . '/index.php':
                $pageData = getDataForPageIndex();
                break;

            case ROOT_URL . '/user.php':
                $pageData = getDataForPageUsers($db);
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

$app = main();

