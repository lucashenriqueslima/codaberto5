<?php

    namespace Source\Controllers;

    

    class Web extends Controller
    {
        public function __construct($router)
        {
            parent::__construct($router);
            
           if(!empty($_SESSION["user"])){
               $this->router->redirect("app.home");
          }
        }

        public function login():void
        {
            $head = $this->seo->optimize(
                site("name")."Bem-Vindo",
                site("desc"),
                $this->router->route("web.register"),
                routeImage("Register")

             )->render();

            

            echo $this->view->render("theme/login", [
                "head"=> $head
                ]);
            
        }

        public function register(): void
        {
            $head = $this->seo->optimize(
                site("name")."Crie Sua Conta",
                site("desc"),
                $this->router->route("web.register"),
                routeImage("Register")

             )->render();

             $form_user = new \stdClass();
             $form_user->first_name = null;
             $form_user->last_name = null;
             $form_user->email = null;
             $form_user->cpf = null;


             

            echo $this->view->render("theme/register", [
                "head"=> $head,
                "user"=> $form_user
                ]);
        }

        public function forget(): void
        {
            $head = $this->seo->optimize(
                site("name")."Recupere Sua Senha",
                site("desc"),
                $this->router->route("web.forget"),
                routeImage("Forget")

             )->render();

            

            echo $this->view->render("theme/forget", [
                "head"=> $head
                ]);
        }

        public function reset($data): void
        {
            $head = $this->seo->optimize(
                site("name")."Criar Nova Senha",
                site("desc"),
                $this->router->route("web.reset"),
                routeImage("Reset")
    
             )->render();
    
            
    
            echo $this->view->render("theme/reset", [
                "head"=> $head
                ]);

        }

        public function error($data): void
        {
           $error = filter_var($data["errcode"], FILTER_VALIDATE_INT);

           $head = $this->seo->optimize(
            site("name")."Ooops {$error}",
            site("desc"),
            $this->router->route("web.error"),
            routeImage($error)

         )->render();

        

        echo $this->view->render("theme/error", [
            "head"=> $head,
            "error"=> $error
            ]);
        }

    }