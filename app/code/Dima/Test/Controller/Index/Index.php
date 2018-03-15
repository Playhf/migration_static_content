<?php

namespace Dima\Test\Controller\Index;

use Magento\Framework\App\Action\Context;

class Index extends \Magento\Framework\App\Action\Action
{

    protected $_resultPageFactory;

    public function __construct(Context $context, \Magento\Framework\View\Result\PageFactory $resultPageFactory)
    {
        $this->_resultPageFactory = $resultPageFactory;
        parent::__construct($context);
    }

    public function execute()
    {
//        $resultPage = $this->_resultPageFactory->create();
//        return $resultPage;

        $msg = 'rofl';

        $example = function () use (
            $msg,
            &$example
        ) {
            var_dump($msg, $example);
        };
        $example();
        $msg = 'boo';
        $example();

        echo 'gg';
    }
}