<?php
class Persons extends Trongate {

function index(){
    if(isset($_SESSION['role'])){
        // if($_SESSION['role'] == 'user'){
        //     echo json($_SESSION);
        //     die();
        // }
        $data['view_file'] = 'dashboard';
        //$data['role'] = $result->role;
        $this->template('public', $data);
    }else{

        //$_SESSION['role'];
$data['form_location'] = BASE_URL.'persons/sign_in_check';
$data['view_file'] = 'sign_in';
$this->template('public', $data);
    }
            
}

function create(){
    if(isset($_SESSION['role'])){
        if($_SESSION['role'] == 'admin'){
            $data['form_location'] = BASE_URL.'persons/store';
            $data['view_file'] = 'create';
            $this->template('public', $data);
        }else{
            $this->index();
        }
    }else{
        $this->index();
    }

}

function store(){
    $data = $this->_get_data_from_post();
    $this->model->insert($data, 'persons');
    $flash_msg = 'The record was successfully created';
    set_flashdata($flash_msg);
    redirect('persons/create');
    //$data['view_file'] = 'add';
   // $this->template('public', $data);

    }
    function search(){
        // $data = $this->_get_data_from_post();
        // $this->model->insert($data, 'persons');
        // $flash_msg = 'The record was successfully created';
        // set_flashdata($flash_msg);
        // redirect('persons/create');
        if(isset($_SESSION['role'])){
        $data['form_location'] = BASE_URL.'persons/retrieve';
        $data['view_file'] = 'search';
        $this->template('public', $data);
        }else{
            $this->index();
        }
        }
    function retrieve(){
        if(isset($_SESSION['role'])){
        $temp = (int)trim(post('cnic_phonenum'));
       if($temp){
            $params['phonenum'] = $temp;
            $params['cnic'] = $temp;
            $sql = 'select * from persons
            WHERE phonenum LIKE :phonenum
            OR cnic LIKE :cnic 
            ORDER BY id';
            $all_rows = $this->model->query_bind($sql, $params, 'object');
            if(empty($all_rows)){
                $flash_msg = 'No record found';
                set_flashdata($flash_msg); 
                redirect('persons/search');
            }else{
                if($_SESSION['role'] == 'user'){
                $result = $this->model->get_one_where('id', $_SESSION['id'], 'users');
                $data['remaining_queries'] = $result->remaining_queries	 - 1;
                $result = $this->model->update($_SESSION['id'], $data, 'users');
                $_SESSION['remaining_queries'] = $data['remaining_queries'];
                }
                $flash_msg = 'Record/s found';
                set_flashdata($flash_msg);
                $data['persons'] =  $all_rows;
                $data['form_location'] = BASE_URL.'persons/retrieve';
                $data['view_file'] = 'search';
                $this->template('public', $data);
                //redirect('persons/search');
            }
        }else{
                $flash_msg = 'Invalid Input';
                set_flashdata($flash_msg); 
                redirect('persons/search');
        }
    }else{
        $this->index();
    }

    
        }

function sign_in_check(){
   
    // if(isset($_SESSION['role'])){
    //     print_r('s_r');
    //     if($_SESSION['role'] == 'admin' || $_SESSION['role'] == 'user' ){
    //         print_r('s__r_a__u');

    //         $data['view_file'] = 'dashboard';
    //         //$data['role'] = $result->role;
    //         $this->template('public', $data);
    //     }else{
    //         session_unset();
    //         session_destroy();
    //         print_r('s_i');
    //        $this->index();
    //     }
    // }
    if(isset($_SESSION['role'])){
        $data['view_file'] = 'dashboard';
        //$data['role'] = $result->role;
        $this->template('public', $data);
    }else{
        
        $data['username'] = post('username');
        $result = $this->model->get_one_where('username', post('username'), 'users');
        if($result){
            $submitted_password = post('password');
            if($this->_verify_hash($submitted_password, $result->password)){
                //$data['form_location'] = BASE_URL.'persons/dashboard';
                //echo $result->role;
                $this->_sign_in($result);
              
       }else{
        $flash_msg = 'Wrong Password';
        set_flashdata($flash_msg); 
        //$data['form_location'] = BASE_URL.'persons/login';
        //$data['view_file'] = 'login';
        //$this->template('public', $data);
        redirect('persons');
    
       }
        }else{
        $flash_msg = 'Username does not exist';
        set_flashdata($flash_msg); 
        //$data['form_location'] = BASE_URL.'persons/login';
        //$data['view_file'] = 'login';
        //$this->template('public', $data);
        redirect('persons');
        }
    }

    
}
function logout(){
    unset($_SESSION['role']);
    unset($_SESSION['queries_limit']);
    unset($_SESSION['remaining_queries']);
    unset($_SESSION['id']);
    //unset($_SESSION['flash_data']);
    //session_destroy();
    // setcookie("role", "Admin", time() - 3600);
    $this->index();

}
function add_a_person(){
    if(isset($_SESSION['role']) && $_SESSION['role'] == 'admin'){
    $data['form_location'] = BASE_URL.'persons/store_a_person';
    $data['view_file'] = 'add_a_person';
    $this->template('public', $data);
    }else{
$this->index();
    }
}
function delete_a_person(){
    if(isset($_SESSION['role']) && $_SESSION['role'] == 'admin'){
    $data['form_location'] = BASE_URL.'persons/remove_a_person';
    $data['view_file'] = 'delete_a_person';
    $this->template('public', $data);
    }else{
$this->index();
    }
}
function store_a_person(){
    $data['username'] = post('username');
    $data['password'] = $this->_hash_string(post('password'));
    $params['username'] =  post('username');
            $sql = 'select username from users
            WHERE username LIKE :username';
    $result = $this->model->query_bind($sql, $params, 'object');
 
    if($result){
        $flash_msg = 'This username already exists! Please try another username';
                set_flashdata($flash_msg); 
                redirect('persons/add_a_person');
    }else{
// //             $params = array();
// //             $params['id'] = 1;
// //             $params['user_level_id'] = post('role');
// //             $params['code'] = make_rand_str(32);
// //             $sql = 'INSERT INTO `trongate_users` (`id`, `code`, `user_level_id`) VALUES
// // (1, $code, $user_level_id)';


// $result = $this->model->query_bind($sql, $params ,'object');
// echo $result;
// die();

        $data['role'] = post('role');
        if( $data['role'] ==  'user'){
            $data['queries_limit'] =  post('queries_limit', true);
            $data['remaining_queries'] = $data['queries_limit'];
        }else{
            $data['queries_limit'] =  null;
            $data['remaining_queries'] = null;
        }
        // echo $data['queries_limit'];
        // die();
        //$data['trongate_user_id'] = 1;  
        $result = $this->model->insert($data, 'users');
        if($result){
            $flash_msg = 'Successfully created another user';
            set_flashdata($flash_msg); 
            redirect('persons/add_a_person');
        }
    }
    
    echo $result;
    echo json($data);
    // $data['form_location'] = BASE_URL.'persons/store_a_person';
    // $data['view_file'] = 'add_a_person';
    // $this->template('public', $data);
}
function _hash_string($str) {
    $hashed_string = password_hash($str, PASSWORD_BCRYPT, array(
        'cost' => 11
    ));
    return $hashed_string;
}
function _verify_hash($plain_text_str, $hashed_string) {
    $result = password_verify($plain_text_str, $hashed_string);
    return $result; //TRUE or FALSE
}

function _sign_in($result){

    $_SESSION['role'] =  $result->role;
    $_SESSION['id'] =  $result->id;
    if($_SESSION['role'] == 'user'){
        $_SESSION['queries_limit'] = $result->queries_limit;
        $_SESSION['remaining_queries'] = $result->remaining_queries;
    }
    $data['view_file'] = 'dashboard';
    //$data['role'] = $result->role;
    $this->template('public', $data);
}

    function _get_data_from_post() {
        $data['first_name'] = post('first_name', true);
        $data['last_name'] = post('last_name', true);
        $data['cnic'] = post('cnic', true);
        $data['phonenum'] = post('phonenum', true);
        $data['address_line_1'] = post('address_line_1', true);
        $data['address_line_2'] = post('address_line_2', true);
        $data['city'] = post('city', true);
        $data['state__province__region'] = post('state__province__region', true);
        $data['country'] = post('country', true);        
        return $data;
    }
}
