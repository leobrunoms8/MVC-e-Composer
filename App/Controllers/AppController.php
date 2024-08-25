<?php
    namespace App\Controllers;

    use MF\Controller\Action;
    use MF\Model\Container;

    class AppController extends Action {

        public function timeline(){

            $this->validaAutenticacao();

            $tweet = Container::getModel('Tweet');

            $tweet->__set('id_usuario', $_SESSION['id']);

            $pagina = isset($_GET['pagina']) ? $_GET['pagina'] : 1;
            $totalRegistrosPorPagina = 10;
            $deslocamento = ($pagina - 1) * $totalRegistrosPorPagina;
            $this->view->paginaAtiva = $pagina;

            $totalTweets = $tweet->getTotalRegistros();
            $this->view->totaDePaginas = ceil($totalTweets['total'] / $totalRegistrosPorPagina);

            $tweets = $tweet->getAll($totalRegistrosPorPagina, $deslocamento);

            $this->view->tweets = $tweets;

            $usuario = Container::getModel('Usuario');
            $usuario->__set('id', $_SESSION['id']);

            $this->view->infoUsuario = $usuario->getInfoUsuario();
            $this->view->totalTweets = $usuario->getTotalTweets();
            $this->view->totalSeguindo = $usuario->getTotalSeguindo();
            $this->view->totalSeguidores = $usuario->getTotalSeguidores();

            $this->render('timeline');
                        
        }

        public function tweet(){

            $this->validaAutenticacao();

            $tweet = Container::getModel('Tweet');

            $tweet->__set('id_usuario', $_SESSION['id']);
            $tweet->__set('tweet', $_POST['tweet']);

            $tweet->salvar();

            header('Location: /timeline');

        }

        public function validaAutenticacao(){
            session_start();

            if(!isset($_SESSION['id']) ||  empty($_SESSION['id'])|| !isset($_SESSION['nome']) || empty($_SESSION['nome'])){
                header('Location: /?login=erro');
            }else{
                return true;
            }
        }

        public function quemSeguir(){

            $this->validaAutenticacao();

            $pesquisarPor = isset($_GET['pesquisarPor']) ? $_GET['pesquisarPor'] : '';

            $usuarios = array();

            if(!empty($pesquisarPor)){

                $usuario = Container::getModel('Usuario');
                $usuario->__set('nome', $pesquisarPor);
                $usuario->__set('id', $_SESSION['id']);
                $usuarios = $usuario->getAll();

            } 

            $this->view->usuarios = $usuarios;

            $this->render('quemSeguir');
        }

        public function acao(){

            $this->validaAutenticacao();

            $acao = isset($_GET['acao']) ? $_GET['acao']: '';
            $id_usuario_seguido = isset($_GET['id_usuario']) ? $_GET['id_usuario']: '';

            $usuario = Container::getModel('Usuario');

            $usuario->__set('id', $_SESSION['id']);

            if($acao == 'seguir'){

                $usuario->seguirUsuario($id_usuario_seguido);

                header('Location: /quem_seguir');

            }else if($acao == 'deixar_de_seguir'){

                $usuario->deixarSeguirUsuario($id_usuario_seguido);

                header('Location: /quem_seguir');

            }
        }

        public function removerTweet(){

            $this->validaAutenticacao();

            $tweet = Container::getModel('Tweet');

            $tweet->__set('id', $_POST['id']);
            $tweet->remover();

            header('Location: /timeline');

        }

    }

?>