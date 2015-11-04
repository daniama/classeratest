<?php

class UsersController extends AppController {

    public $components = array('RequestHandler');

    
    public function register() {
        
        $message = "";
        $status = false;
        $code = '';
       
        $data = array();
        if ($this->request->is('post')) {
            $this->User->create();
            
            $data = array(
                'username' => $this->data['username'],
                'password' => $this->data['password'],
                'role_id' => $this->data['role_id'],
                'school_id' => $this->data['school_id'],
                'level_id' => $this->data['level_id'],
                
                'first_name' => $this->data['first_name'],
                'father_name' => $this->data['father_name'],
                'grandfather_name' => $this->data['grandfather_name'],
                'family_name' => $this->data['family_name'],
                'address' => $this->data['address'],
                'phone_number' => $this->data['phone_number'],
                'mobile_number' => $this->data['mobile_number'],
                'email' => $this->data['email'],
                'nationality_id' => $this->data['nationality_id']);

            if ($this->User->save($data)) {
                $status = true;
                $code = '203';
            } else {
                $code = '406';
            }
        }

        $this->response->type('json');
        $json_body = json_encode(
                        array(  
                                "message"=>AppController::getReturnedMessage($code),  
                                "status"=>$status, 
                                "code"=>$code
            ));
        $this->response->body($json_body);

    }




}
