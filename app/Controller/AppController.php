<?php

App::uses('Controller', 'Controller');


class AppController extends Controller {

    public $components = array('RequestHandler');
    
    private $returned_messages = array(
        '200' => 'your Operation Has Been Done Successfully', 
        '201' => '', 
        '202' => 'user is licensed..', 
        '203' => 'Your Data has been saved Successfully', 
        '204' => 'Your Data has been Deleted Successfully', 
        '205' => '', 
       
        '400' =>'This user do nat have Licenses',
        '404' => 'Lesson Is Not Defined', 
        '405' => 'No comments Are Added On This Lesson!', 
        '406' => 'Unable To Save Your Data', 
        '407' => 'Unable to Complete Delete Operation', 
        '408' => 'You Do Not Have Permission to Complete This Operation', 
        '409' => 'Unable to Update Your Data', 
        '410' => '' 
    );

	

    public function beforeFilter() {

    }

    public function getReturnedMessage($code) {

        return (empty($code))?'':Set::enum($code, $this->returned_messages);

    }


}
