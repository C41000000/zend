<?php


namespace Pessoa\Controller;

use Pessoa\Model\PessoaTable;
use Zend\Mvc\Controller\AbstractActionController;
use Zend\Mvc\Plugin\FlashMessenger\FlashMessenger;
use Zend\View\Model\ViewModel;
use \Pessoa\Form\PessoaForm;
use \Pessoa\Model\Pessoa;
use Zend\View\View;



class PessoaController extends AbstractActionController{

    private $table;

    public function __construct($table){
        $this->table = $table;
    }

    public function indexAction(): ViewModel
    {



        return new ViewModel(['pessoas' => $this->table->findAll()]);
    }

    public function adicionarAction(){
        $form = new PessoaForm();
        $form->get('submit')->setValue('Adicionar');

        $request = $this->getRequest();

        if(!$request->isPost()){
            return new ViewModel(['form' => $form]);    
        }
        
        $form->setData($request->getPost());

        if(!$form->isValid()){
            return new ViewModel(['form' => $form]);    
        }
        $pessoa = new Pessoa();
        $pessoa->exchangeArray($form->getData());
        $this->table->salvarPessoa($pessoa);
        $msg = new FlashMessenger();
        $msg->addSuccessMessage("Criado com sucesso!");

        $this->redirect()->toRoute('pessoa');
        
    }


    public function removerAction(){

        $id = $this->params()->fromRoute('id');
        if(!$id){
            $this->redirect()->toRoute('pessoa');
        }
        try{
            $pessoa = $this->table->getPessoa($id);
        }catch(\Exception $ex){
            $this->redirect()->toRoute('pessoa');
        }

        $request = $this->getRequest();

        if($request->isPost()){
            $del = $request->getPost('del', 'nao');
            if($del == "sim"){

                $this->table->removerPessoa($request->getPost('id'));
            }
            $this->redirect()->toRoute('pessoa');
        }

        return ['id' => $id, 'pessoa' => $this->table->getPessoa($id)];

        $this->redirect()->toRoute('pessoa');
    }

    public function editarAction(){
        $id = (int)$this->params()->fromRoute('id');

        if(!$id){
            $this->redirect()->toRoute('pessoa', ['action' => 'adicionar']);
        }

        try{
            $pessoa = $this->table->getPessoa($id);

        }catch(\Exception $x){
            $this->redirect()->toRoute('pessoa');
        }

        $form = new PessoaForm();
        $form->bind($pessoa);
        $form->get('submit')->setValue('Salvar');

        $request = $this->getRequest();
        $viewData = ['id' => $id, 'form' => $form];
        if(!$request->isPost()){
            return $viewData;
        }

        $form->setData($request->getPost());
        if(!$form->isValid()){
            return $viewData;
        }


        $this->table->salvarPessoa($form->getData());
        $this->redirect()->toRoute('pessoa');
    }


}