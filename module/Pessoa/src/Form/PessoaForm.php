<?php 

namespace Pessoa\Form;
use Zend\Form\Form;


class PessoaForm extends Form{

    public function __construct(){
        parent::__construct('pessoa', []);
        $this->add(new \Zend\Form\Element\Hidden('id'));
        $this->add(new \Zend\Form\Element\Text('nome',['label' => 'Nome']));
        $this->add(new \Zend\Form\Element\Text('sobrenome',['label' => 'Sobrenome']));
        $this->add(new \Zend\Form\Element\Text('email',['label' => 'Email']));
        $this->add(new \Zend\Form\Element\Text('situacao',['label' => 'Situação']));

        $submit = new \Zend\Form\Element\Submit('submit');
        $submit->setAttributes([
            'value' => 'Salvar',
            'id' => 'submit'
        ]);

        $this->add($submit);
    }
}