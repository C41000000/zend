<?php 

namespace Pessoa;

use Zend\ModuleManager\Feature\ConfigProviderInterface;
use Zend\Db\TableGateway\TableGateway;
use Zend\Db\Adapter\AdapterInterface;
use Zend\Db\ResultSet\ResultSet;
use Pessoa\Model\PessoaTable;
use Pessoa\Controller\PessoaController;


class Module implements ConfigProviderInterface{

    public function getConfig(){
        return include __DIR__ . "/../config/module.config.php";
    }

    public function getServiceConfig(){
        return [
            'factories' => [
                Model\PessoaTable::class => function($container){
                    $tableGateway = $container->get(Model\PessoaTableGateway::class);
                    return new PessoaTable($tableGateway);
                },
                Model\PessoaTableGateway::class => function($container){
                    $dbAdapater = $container->get(AdapterInterface::class);
                    $resultSetPrototype = new ResultSet();
                    $resultSetPrototype->setArrayObjectPrototype(new Model\Pessoa());
                    
                    return new TableGateway('pessoa', $dbAdapater, null, $resultSetPrototype);
                },
            ]
        ];
    }

    public function getControllerConfig(){
        return [
            'factories' => [
                PessoaController::class => function($container){
                    $tableGateway = $container->get(Model\PessoaTable::class);
                    return new PessoaController($tableGateway);
                },
            ]
        ];
    }
}