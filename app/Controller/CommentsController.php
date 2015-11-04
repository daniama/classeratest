<?php

App::uses('Subject', 'Model');
class CommentsController extends AppController {

    public $helpers = array('Html', 'Form');

    public $components = array( 'RequestHandler');

    public function index() {
        return $this->redirect(array('controller' => 'Courses','action' => 'index'));
    }

    public function getComments($subject_id) {
        $message = "";
        $status = false;
        $code = '';
        $comments_object = array();
        $this->render(false);


        if (!$subject_id) {
            $code = '404';
        } else {
            $params = array('subject_id' => $subject_id);
            $comments = $this->Comment->getCommentsOnSubject($params);

            if (!$comments) {
                $code = '405';
            } else {

                foreach ($comments as $comment):
                    $comments_object[] = $comment['Comment'];
                endforeach;
                $status = true;
                $code = '200';
            }
        }

        $this->response->type('json');
        $json_body = json_encode(
                        array(  "comments" => $comments_object,
                                "message" => AppController::getReturnedMessage($code), 
                                "status" => $status, 
                                "code" => $code
               ));
        $this->response->body($json_body);

    }

    public function addComment() {
        
        $message = "";
        $status = false;
        $code = '';
        $this->render(false);
       
        $data = array();
        if ($this->request->is('post')) {
            $this->Comment->create();
            
            $data = array(
                'user_id' => $this->data['user_id'],
                'subject_id' => $this->data['subject_id'],
                'body' => $this->data['body']
                );

            if ($this->Comment->save($data)) {
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

    public function deleteComment() {
        $message = "";
        $status = false;
        $code = '';
        $this->render(false);

        if ($this->request->is('get')) {
            throw new MethodNotAllowedException();
        }

        $id = $this->data['id'];
        $user_id = $this->data['user_id'];

        if ($this->Comment->isOwendBy($id, $user_id)){
            
            if ($this->Comment->delete($id)) {
                    $status = true;
                    $code = '204';
            } else {
                    $code = '407';
            }
        } else{
                $code = '408';
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

    public function editComment() {
        $message = "";
        $status = false;
        $code = '';
        $this->render(false);

        if ($this->request->is('get')) {
            throw new MethodNotAllowedException();
        }

        $id = $this->data['id'];
        $user_id = $this->data['user_id'];

        $data = array(
                'id' => $this->data['id'],
                'user_id' => $this->data['user_id'],
                'subject_id' => $this->data['subject_id'],
                'body' => $this->data['body']
                );   

        if ($this->Comment->isOwendBy($id, $user_id)){
            if ($this->Comment->save($data)) {
                    $status = true;
                    $code = '200';
            } else {
                    $code = '409';
            }
        } else{
                $code = '408';
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
?>