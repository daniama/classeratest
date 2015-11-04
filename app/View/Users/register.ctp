            <?php /*  'username' => $this->data['username'],
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
                'nationality_id' => $this->data['nationality_id']);*/ ?>

<h1>Users Registration</h1>
<?php
echo $this->Form->create('User');

echo $this->Form->input('username');
echo $this->Form->input('password', array('type' => 'password'));


echo $this->Form->end('Register User');
?>