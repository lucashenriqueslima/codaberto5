<?php

    namespace Source\Controllers;

    use Source\Models\User;

    class Auth extends Controller
    {
        public function __construct($router)
        {
            parent::__construct($router);
        }

        public function login ($data): void
        {
            $email = filter_var($data["email"], FILTER_VALIDATE_EMAIL);
            $passwd = filter_var($data["passwd"], FILTER_DEFAULT);
            
            if(!$email || !$passwd){
                echo $this->ajaxResponse("message", [
                    "type" => "alert",
                    "message" => "Dados inválidos. Informe seu e-mail ou cpf na área de login e sua senha para logar!"
                ]);
                return;
            }

          
            $userByEmail = (new User())->find("email = :e" , "e = {$email}")->fetch();
           

            if(!$userByEmail || !password_verify($passwd, $userByEmail->passwd) ){
                echo $this->ajaxResponse("message", [
                    "type" => "alert",
                    "message" => "Login ou senha incorreto(s)!"
                ]);
                return;
            }

            $_SESSION["user"] = $userByEmail->id;

            echo $this->ajaxResponse("redirect", [
                "url" => $this->router->route("app.home")
            ]);

           
        }

        public function register($data): void
        {
            $data = filter_var_array($data, FILTER_SANITIZE_STRIPPED);
         #verifica se tem algum campo em branco!
            if(in_array("", $data)){
                echo $this->ajaxResponse("message", [
                    "type" => "error",
                    "message" => "Favor, preencha todos os campos para efetuar cadastro!"
                ]);

                return;
            }
            

            if(!filter_var($data["email"], FILTER_VALIDATE_EMAIL)){
                echo $this->ajaxResponse("message", [
                    "type" => "error",
                    "message" => "Favor, preencha todos os campos para efetuar cadastro!"
                ]);
                return;
            }

            $checkEmail = (new User())->find("email = :e", "e={$data["email"]}")->count();

            if($checkEmail){
                echo $this->ajaxResponse("message", [
                    "type" => "error",
                    "message" => "E-mail já cadastrado"
                ]);
                return;
            }

            $checkCPF = (new User())->find("cpf = :c", "c={$data["cpf"]}")->count();

            if($checkCPF){
                echo $this->ajaxResponse("message", [
                    "type" => "error",
                    "message" => "CPF já cadastrado"
                ]);
                return;
            }

            
            if (empty($data["passwd"]) || strlen($data["passwd"]) < 6){
                echo $this->ajaxResponse("message", [
                    "type" => "error",
                    "message" => "Insira uma senha com pelo menos 6 caracteres"
                ]);
                return;
            }




            
            $user = new User();
            $user->first_name = $data["first_name"];
            $user->last_name = $data["last_name"];
            $user->email = $data["email"];
            $user->cpf = $data["cpf"];
            $user->passwd = password_hash($data["passwd"], PASSWORD_DEFAULT);

            $user->save(); 

            $_SESSION["user"] = $user->id;

            echo $this->ajaxResponse("redirect", [
                "url"=>$this->router->route("app.home")
            ]);
         
        }
    }