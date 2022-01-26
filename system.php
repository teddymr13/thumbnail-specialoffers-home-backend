<?php
require_once 'traits/intropagetrait.php';
require_once 'traits/mainslidertrait.php';

class System extends Controller {
    use IntroPageTrait, MainSliderTrait;

    protected function administrators(){
        if($this->registry->template->login_check){
            $page_id = '15|0';
            if(UserHelper::checkUserAccess($page_id)) {
                $main_url = 'system/administrators';
                $args = array(
                    'url_id' => FILTER_VALIDATE_INT,
                    'orderby' =>array('filter' => FILTER_VALIDATE_INT, 'options' => array('min_range' => 1, 'max_range' => 4))
                );
                $get = filter_input_array(INPUT_GET, $args);

                if (empty($get['url_id'])) $get['url_id'] = 1;
                if (empty($get['orderby'])) $get['orderby'] = 1;
                $get['order'] = 'ASC';
                if (isset($_GET['order']) && $_GET['order'] === 'DESC') $get['order'] = 'DESC';

                $viewmodel = new UserModel;
                $data_count = $viewmodel->getUserLogin(NULL, "", false, true);
                $totalrow = count($data_count);
                if($totalrow > 0) $totalhlm = intval(ceil ($totalrow / LIST_ITEM_LIMIT));
                else $totalhlm = 1;
                if($get['url_id'] > $totalhlm) header('Location: ' . ROOT_PATH . $main_url . '/');

                $param = array();
                switch ($get['orderby']){
                    case 2: $param['order_by'] = array('nama'=>$get['order']); break;
                    case 3: $param['order_by'] = array('keterangan'=>$get['order'], "email"=>'ASC'); break;
                    case 4: $param['order_by'] = array('keterangan_stat'=>$get['order'], "email"=>'ASC'); break;
                    default: $param['order_by'] = array("email"=>$get['order']); break;
                }
                $limitervalue = array();
                if ($totalrow > LIST_ITEM_LIMIT){
                    $offset = ($get['url_id'] - 1) * LIST_ITEM_LIMIT;
                    $limitervalue["count"] = LIST_ITEM_LIMIT;
                    if (!empty($offset)) $limitervalue["offset"] = $offset;
                }
                if(!empty($limitervalue)) $param['limit'] = $limitervalue;

                $this->registry->template->data_list = $viewmodel->getUserLogin($param, "", true, true);
                $this->registry->template->main_url = $main_url;
                $this->registry->template->hlm = $get['url_id'];
                $this->registry->template->totalrow = $totalrow;
                $this->registry->template->totalhlm = $totalhlm;

                if(!($get['orderby'] == 1 && $get['order'] == 'ASC')) {
                    $this->registry->template->orderby = $get['orderby'];
                    $this->registry->template->order = strtolower($get['order']);
                }

                $this->registry->template->page_title = "Administrators - System";
                $this->registry->template->header_title = "Administrators";
                $this->registry->template->page_id = $page_id;

                $breadcrumb = array();
                $breadcrumb[0]['str'] = "System";
                $breadcrumb[1]['str'] = "Administrators";
                $breadcrumb[1]['active'] = true;
                $this->registry->template->breadcrumb = $breadcrumb;

                if ($totalrow > 0) {
                    $jsSrc = array();
                    $jsSrc[0]['type'] = "js";
                    $jsSrc[0]['src'] = "assets/js/bundles/list-data.js";
                    $jsSrc[1]['type'] = "js";
                    $jsSrc[1]['src'] = $this->registry->default_js_src;
                    $this->registry->template->jsSrc = $jsSrc;
                }

                $this->returnView();
            }
            else Redirect::home();
        }
        else Redirect::signin();
    }
    protected function addadministrator(){
        if($this->registry->template->login_check){
            $page_id = '15|0';
            if(UserHelper::checkUserAccess($page_id)) {
                $viewmodel = new UserModel;
                $this->registry->template->data_status_user = $viewmodel->getMaStatusUser(array("order_by"=>array("keterangan"=>"ASC")));

                if(isset($_POST) && !empty($_POST)){
                    $args = array(
                        'email_address' => FILTER_VALIDATE_EMAIL,
                        'group' => FILTER_VALIDATE_INT,
                        'admin_status' => FILTER_VALIDATE_INT
                    );
                    $post = filter_input_array(INPUT_POST, $args);
                    if(!empty($post['email_address']) && !empty($post['group']) && ($post['admin_status']==0||$post['admin_status']==1)){
                        $check_email = $viewmodel->getUserLogin(array('email'=>$post['email_address']));
                        if(is_array($check_email) && count($check_email)==0) {
                            $new_pass = MainHelper::generateRandomPassword(8, "lower_case,upper_case,numbers");
                            $random_salt = hash('sha512', random_bytes(128));
                            $new_hash_pw = hash('sha512', $random_salt . hash('sha512', $new_pass));

                            $myinfomodel = new MyInfoModel;
                            $info_per = $myinfomodel->getInfo();

                            $viewmodel = new UserModel(NULL, 'i');
                            if($viewmodel->insertUserLogin(array('email'=>$post['email_address'], 'password'=>$new_hash_pw, 'salt'=>$random_salt, 'status_user'=>$post['group'], 'login_terakhir'=>'1970-01-01 20:10:01', 'stat'=>$post['admin_status']))) {
                                $str_sign = $info_per['sebutan']." - Website Control";
                                $message = 'New Account for '.$str_sign.' has been made with this email address. This is the password for sign in <strong>'.$new_pass.'</strong><br/>For security concern, immidiately Sign In, change Your password, and then delete this email from Inbox and Trash folder.<br/><br/>If You never request for this account please kindly contact us at '.$info_per['email'].' to remove the account.<br/><br/>--<br/>' . $str_sign;
                                $message_alt = 'New Account for '.$str_sign.' has been made with this email address. This is the password for sign in: '.$new_pass.'\nFor security concern, immidiately Sign In, change Your password, and then delete this email from Inbox and Trash folder.\n\nIf You never request for this account please kindly contact us at '.$info_per['email'].' to remove the account.\n\n--\n' . $str_sign;
                                SendMail::smtp_mail($post['email_address'], 'New Account', $message, $message_alt);
                                Messages::setMsg('Successfully add new administrator.', 'success', 'Success!');
                            }
                            else Messages::setMsg('Failed to add new administrator.', 'danger', 'Error!');
                        }
                        else Messages::setMsg('Email have been used by another administrator.', 'danger', 'Error!');
                    }
                    else Messages::setMsg('Incomplete input data.', 'danger', 'Error!');
                }

                $this->registry->template->page_title = "Add New | Administrators - System";
                $this->registry->template->header_title = "Add Administrator";
                $this->registry->template->page_id = $page_id;

                $breadcrumb = array();
                $breadcrumb[0]['str'] = "System";
                $breadcrumb[1]['str'] = "Administrators";
                $breadcrumb[1]['href'] = "system/administrators/";
                $breadcrumb[2]['str'] = "Add New";
                $breadcrumb[2]['active'] = true;
                $this->registry->template->breadcrumb = $breadcrumb;

                $jsSrc = array();
                $jsSrc[0]['type'] = "js";
                $jsSrc[0]['src'] = $this->registry->default_js_src;
                $this->registry->template->jsSrc = $jsSrc;

                $this->returnView();
            }
            else Redirect::home();
        }
        else Redirect::signin();
    }
    protected function editadministrator(){
        if($this->registry->template->login_check){
            $page_id = '15|0';
            if(UserHelper::checkUserAccess($page_id)) {
                $url_id = NULL;
                if(isset($_GET['url_id'])) $url_id = intval(filter_var($_GET['url_id'], FILTER_VALIDATE_INT));

                if(!empty($url_id)) {
                    $viewmodel = new UserModel;
                    $this->registry->template->data_status_user = $viewmodel->getMaStatusUser(array("order_by" => array("keterangan" => "ASC")));

                    $data_edit = $viewmodel->getUserLogin(array('id'=>$url_id));
                    if($data_edit && is_array($data_edit) && count($data_edit) == 1) {
                        if (isset($_POST) && !empty($_POST)) {
                            $args = array(
                                'hid_id' => FILTER_VALIDATE_INT,
                                'email_address' => FILTER_VALIDATE_EMAIL,
                                'group' => FILTER_VALIDATE_INT,
                                'admin_status' => FILTER_VALIDATE_INT,
                                'name' => array('filter' => FILTER_SANITIZE_STRING, 'flags' => FILTER_FLAG_STRIP_LOW | FILTER_FLAG_STRIP_HIGH | FILTER_FLAG_STRIP_BACKTICK),
                                'profile_picture' => array('filter' => FILTER_VALIDATE_URL, 'flags' => FILTER_FLAG_SCHEME_REQUIRED | FILTER_FLAG_HOST_REQUIRED)
                            );
                            $post = filter_input_array(INPUT_POST, $args);
                            if (!empty($post['hid_id']) && !empty($post['email_address']) && !empty($post['group']) && ($post['admin_status'] == 0 || $post['admin_status'] == 1)) {
                                if($post['hid_id'] == $url_id) {
                                    $trueEmail = false;
                                    if($data_edit[0]['email'] == $post['email_address']) $trueEmail = true;
                                    else{
                                        $check_email = $viewmodel->getUserLogin(array('email' => $post['email_address']));
                                        if (is_array($check_email) && count($check_email) == 0) $trueEmail = true;
                                    }
                                    if ($trueEmail) {
                                        if (empty($post['profile_picture'])) $post['profile_picture'] = '';

                                        $viewmodel = new UserModel(NULL, 'u');
                                        if ($viewmodel->updateUserLogin(array('email' => $post['email_address'], 'nama' => $post['name'], 'url_pp' => $post['profile_picture'], 'status_user' => $post['group'], 'stat' => $post['admin_status']), array('id'=>$post['hid_id']))) {
                                            $viewmodel = new UserModel;
                                            $data_edit = $viewmodel->getUserLogin(array('id'=>$url_id));
                                            Messages::setMsg('Successfully edit administrator.', 'success', 'Success!');
                                        }
                                        else Messages::setMsg('Failed to edit administrator.', 'danger', 'Error!');
                                    }
                                    else Messages::setMsg('Email have been used by another administrator.', 'danger', 'Error!');
                                }
                                else Messages::setMsg('Invalid ID.', 'danger', 'Error!');
                            }
                            else Messages::setMsg('Incomplete input data.', 'danger', 'Error!');
                        }

                        $this->registry->template->data_edit = $data_edit[0];

                        $this->registry->template->page_title = "Edit | Administrators - System";
                        $this->registry->template->header_title = "Edit Administrator";
                        $this->registry->template->page_id = $page_id;

                        $breadcrumb = array();
                        $breadcrumb[0]['str'] = "System";
                        $breadcrumb[1]['str'] = "Administrators";
                        $breadcrumb[1]['href'] = "system/administrators/";
                        $breadcrumb[2]['str'] = "Edit";
                        $breadcrumb[2]['active'] = true;
                        $this->registry->template->breadcrumb = $breadcrumb;

                        $jsSrc = array();
                        $jsSrc[0]['type'] = "js";
                        $jsSrc[0]['src'] = $this->registry->default_js_src;
                        $this->registry->template->jsSrc = $jsSrc;

                        $this->returnView();
                    }
                    else header('Location: ' . ROOT_PATH . 'system/administrators/');
                }
                else header('Location: ' . ROOT_PATH . 'system/administrators/');
            }
            else Redirect::home();
        }
        else Redirect::signin();
    }
    protected function ajax_remove_user(){
        if($this->registry->template->login_check) {
            $page_id = '15|0';
            if (UserHelper::checkUserAccess($page_id)) {
                $data_id = NULL;
                if(isset($_POST['data_id'])) $data_id = intval(filter_var($_POST['data_id'], FILTER_VALIDATE_INT));

                if(!empty($data_id)){
                    if($data_id != $_SESSION['user_id']) {
                        $viewmodel = new UserModel(NULL, 'd');
                        if ($viewmodel->deleteUserLogin(array("id" => $data_id))) $flag = 1;
                        else $flag = 2;
                    }
                    else $flag = 3;
                }
                else $flag = 4;
            }
            else $flag = 5;
        }
        else $flag = 6;

        if($flag == 1) Messages::setMsg('Remove Success.', 'success', 'Succes!');
        echo $flag;
    }

    protected function administratorgroups(){
        if($this->registry->template->login_check){
            $page_id = '15|1';
            if(UserHelper::checkUserAccess($page_id)) {
                $main_url = 'system/administrator-groups';
                $get = filter_input_array(INPUT_GET, FILTER_VALIDATE_INT);

                if (empty($get['url_id'])) $get['url_id'] = 1;
                $get['orderby'] = 1;
                $get['order'] = 'ASC';
                if (isset($_GET['order']) && $_GET['order'] === 'DESC') $get['order'] = 'DESC';

                $viewmodel = new UserModel;
                $data_count = $viewmodel->getMaStatusUser(NULL, "", true);
                $totalrow = count($data_count);
                if($totalrow > 0) $totalhlm = intval(ceil ($totalrow / LIST_ITEM_LIMIT));
                else $totalhlm = 1;
                if($get['url_id'] > $totalhlm || $get['orderby'] != 1) header('Location: ' . ROOT_PATH . $main_url . '/');

                $param = array();
                $param['order_by'] = array("keterangan"=>$get['order']);
                $limitervalue = array();
                if ($totalrow > LIST_ITEM_LIMIT){
                    $offset = ($get['url_id'] - 1) * LIST_ITEM_LIMIT;
                    $limitervalue["count"] = LIST_ITEM_LIMIT;
                    if (!empty($offset)) $limitervalue["offset"] = $offset;
                }
                if(!empty($limitervalue)) $param['limit'] = $limitervalue;

                $this->registry->template->data_list = $viewmodel->getMaStatusUser($param, "", true);
                $this->registry->template->main_url = $main_url;
                $this->registry->template->hlm = $get['url_id'];
                $this->registry->template->totalrow = $totalrow;
                $this->registry->template->totalhlm = $totalhlm;

                if(!($get['orderby'] == 1 && $get['order'] == 'ASC')) {
                    $this->registry->template->orderby = $get['orderby'];
                    $this->registry->template->order = strtolower($get['order']);
                }

                $this->registry->template->page_title = "Administrator Groups - System";
                $this->registry->template->header_title = "Administrator Groups";
                $this->registry->template->page_id = $page_id;

                $breadcrumb = array();
                $breadcrumb[0]['str'] = "System";
                $breadcrumb[1]['str'] = "Administrator Groups";
                $breadcrumb[1]['active'] = true;
                $this->registry->template->breadcrumb = $breadcrumb;

                if ($totalrow > 0) {
                    $jsSrc = array();
                    $jsSrc[0]['type'] = "js";
                    $jsSrc[0]['src'] = "assets/js/bundles/list-data.js";
                    $jsSrc[1]['type'] = "js";
                    $jsSrc[1]['src'] = $this->registry->default_js_src;
                    $this->registry->template->jsSrc = $jsSrc;
                }

                $this->returnView();
            }
            else Redirect::home();
        }
        else Redirect::signin();
    }
    private function createAccessPermissionString(){
        $str_access_permission = '1,1|0';
        for($i=2; $i<=16; $i++) {
            $post_check_parent = '';
            if(isset($_POST['check_' . $i . "_all"])) $post_check_parent = intval(filter_var($_POST['check_' . $i . "_all"], FILTER_VALIDATE_INT));
            if(!empty($post_check_parent) && isset($_POST['check_' . $i])) {
                $str_access_permission .= ',' . $post_check_parent;
                foreach ($_POST['check_' . $i] as $access_permission) {
                    preg_match('/[\d]+\|[\d]+/', $access_permission, $matches);
                    if(is_array($matches) && !empty($matches)) $str_access_permission .= ',' . $matches[0];
                }
            }
        }
        return $str_access_permission;
    }
    private function formadministratorgroup($type){
        if($this->registry->template->login_check){
            $page_id = '15|1';
            if(UserHelper::checkUserAccess($page_id)) {
                $viewmodel = new UserModel;
                $parent_url = 'system/administrator-groups/';
                $checkUrlId = false;
                if($type==='Add New') $checkUrlId = true;
                elseif($type==='Edit'){
                    $url_id = NULL;
                    if(isset($_GET['url_id'])) $url_id = intval(filter_var($_GET['url_id'], FILTER_VALIDATE_INT));
                    if($url_id > 1) {
                        $data_edit = $viewmodel->getMaStatusUser(array('id' => $url_id));
                        if ($data_edit && is_array($data_edit) && count($data_edit) == 1) $checkUrlId = true;
                        else header('Location: ' . ROOT_PATH . $parent_url);
                    }
                    else header('Location: ' . ROOT_PATH . $parent_url);
                }

                if($checkUrlId){
                    if (isset($_POST) && !empty($_POST)) {
                        if($type==='Add New') {
                            $group_name = '';
                            if(isset($_POST['group_name'])) $group_name = filter_var($_POST['group_name'], FILTER_SANITIZE_STRING, FILTER_FLAG_STRIP_LOW | FILTER_FLAG_STRIP_HIGH | FILTER_FLAG_STRIP_BACKTICK);
                            if(!empty($group_name)) {
                                $check = $viewmodel->getMaStatusUser(array('keterangan'=>$group_name));
                                if(is_array($check) && count($check)==0) {
                                    $viewmodel = new UserModel(NULL, 'i');
                                    if ($viewmodel->insertMaStatusUser(array('keterangan' => $group_name, 'hak_akses' => $this->createAccessPermissionString()))) Messages::setMsg('Successfully add new administrator group.', 'success', 'Success!');
                                    else Messages::setMsg('Failed to add new administrator group.', 'danger', 'Error!');
                                }
                                else Messages::setMsg('Administrator group with this name is already exist.', 'danger', 'Error!');
                            }
                            else Messages::setMsg('Incomplete input data.', 'danger', 'Error!');
                        }
                        elseif($type==='Edit') {
                            $args = array(
                                'hid_id' => FILTER_VALIDATE_INT,
                                'group_name' => array('filter' => FILTER_SANITIZE_STRING, 'flags' => FILTER_FLAG_STRIP_LOW | FILTER_FLAG_STRIP_HIGH | FILTER_FLAG_STRIP_BACKTICK)
                            );
                            $post = filter_input_array(INPUT_POST, $args);
                            if (!empty($post['hid_id']) && !empty($post['group_name'])) {
                                if ($post['hid_id'] == $url_id) {
                                    $trueCheck = false;
                                    if (strtolower($post['group_name']) == strtolower($data_edit[0]['keterangan'])) $trueCheck = true;
                                    else {
                                        $check = $viewmodel->getMaStatusUser(array('keterangan' => $post['group_name']));
                                        if (is_array($check) && count($check) == 0) $trueCheck = true;
                                    }
                                    if ($trueCheck) {
                                        $viewmodel = new UserModel(NULL, 'u');
                                        if ($viewmodel->updateMaStatusUser(array('keterangan' => $post['group_name'], 'hak_akses' => $this->createAccessPermissionString()), array('id' => $post['hid_id']))) {
                                            $viewmodel = new UserModel;
                                            $data_edit = $viewmodel->getMaStatusUser(array('id' => $url_id));
                                            Messages::setMsg('Successfully edit administrator group.', 'success', 'Success!');
                                        }
                                        else Messages::setMsg('Failed to edit administrator group.', 'danger', 'Error!');
                                    }
                                    else Messages::setMsg('Administrator group with this name is already exist.', 'danger', 'Error!');
                                }
                                else Messages::setMsg('Invalid ID.', 'danger', 'Error!');
                            }
                            else Messages::setMsg('Incomplete input data.', 'danger', 'Error!');
                        }
                    }

                    if($type==='Edit') $this->registry->template->data_edit = $data_edit[0];
                    $this->registry->template->page_title = $type . " | Administrator Groups - System";
                    $this->registry->template->header_title = $type . " Administrator Group";
                    $this->registry->template->page_id = $page_id;

                    $breadcrumb = array();
                    $breadcrumb[0]['str'] = "System";
                    $breadcrumb[1]['str'] = "Administrator Groups";
                    $breadcrumb[1]['href'] = $parent_url;
                    $breadcrumb[2]['str'] = $type;
                    $breadcrumb[2]['active'] = true;
                    $this->registry->template->breadcrumb = $breadcrumb;

                    $jsSrc = array();
                    $jsSrc[0]['type'] = "js";
                    $jsSrc[0]['src'] = "assets/js/system/accesspermissioncheckboxes.js";
                    $jsSrc[1]['type'] = "js";
                    $jsSrc[1]['src'] = "assets/js/system/formadministratorgroup.js";
                    $this->registry->template->jsSrc = $jsSrc;

                    $this->returnView(true, 'system/formadministratorgroup.php');
                }
                else header('Location: ' . ROOT_PATH . $parent_url);
            }
            else Redirect::home();
        }
        else Redirect::signin();
    }
    protected function addadministratorgroup(){
        $this->formadministratorgroup('Add New');
    }
    protected function editadministratorgroup(){
        $this->formadministratorgroup('Edit');
    }
    protected function ajax_remove_ma_status_user(){
        if($this->registry->template->login_check) {
            $page_id = '15|1';
            if (UserHelper::checkUserAccess($page_id)) {
                $data_id = NULL;
                if(isset($_POST['data_id'])) $data_id = intval(filter_var($_POST['data_id'], FILTER_VALIDATE_INT));

                if(!empty($data_id)){
                    if($data_id > 1) {
                        $viewmodel = new UserModel(NULL, 'd');
                        if ($viewmodel->deleteMaStatusUser(array("id" => $data_id))) $flag = 1;
                        else $flag = 2;
                    }
                    else $flag = 3;
                }
                else $flag = 4;
            }
            else $flag = 5;
        }
        else $flag = 6;

        if($flag == 1) Messages::setMsg('Remove Success.', 'success', 'Succes!');
        echo $flag;
    }

    protected function homepage(){
        $this->introPage();
    }
    protected function edithomepage(){
        if($this->registry->template->login_check){
            $page_id = '15|2';
            if(UserHelper::checkUserAccess($page_id)) {
                $url_id = NULL;
                if(isset($_GET['url_id'])) $url_id = intval(filter_var($_GET['url_id'], FILTER_VALIDATE_INT));

                if(!empty($url_id)) {
                    $viewmodel = new HomeModel;
                    $data_edit = $viewmodel->getHomeThumbnail(array('id'=>$url_id));
                    $data_edit_main_pic = $viewmodel->getHomeMainPic(array('id_country'=>$url_id, 'order_by'=>array('urutan'=>'ASC')));
                    if($data_edit && is_array($data_edit) && count($data_edit) == 1 && is_array($data_edit_main_pic)) {
                        if (isset($_POST) && !empty($_POST)) {
                            $args = array(
                                'picture_store' => array('filter' => FILTER_VALIDATE_URL, 'flags' => FILTER_FLAG_SCHEME_REQUIRED | FILTER_FLAG_HOST_REQUIRED),
                                /*'picture_marketplace' => array('filter' => FILTER_VALIDATE_URL, 'flags' => FILTER_FLAG_SCHEME_REQUIRED | FILTER_FLAG_HOST_REQUIRED),*/
                                'picture_hotel' => array('filter' => FILTER_VALIDATE_URL, 'flags' => FILTER_FLAG_SCHEME_REQUIRED | FILTER_FLAG_HOST_REQUIRED),
                                'picture_restaurant' => array('filter' => FILTER_VALIDATE_URL, 'flags' => FILTER_FLAG_SCHEME_REQUIRED | FILTER_FLAG_HOST_REQUIRED),
                                'picture_article' => array('filter' => FILTER_VALIDATE_URL, 'flags' => FILTER_FLAG_SCHEME_REQUIRED | FILTER_FLAG_HOST_REQUIRED),
                                'picture_beauty' => array('filter' => FILTER_VALIDATE_URL, 'flags' => FILTER_FLAG_SCHEME_REQUIRED | FILTER_FLAG_HOST_REQUIRED),
                                'picture_magazine' => array('filter' => FILTER_VALIDATE_URL, 'flags' => FILTER_FLAG_SCHEME_REQUIRED | FILTER_FLAG_HOST_REQUIRED),
                                'picture_industry' => array('filter' => FILTER_VALIDATE_URL, 'flags' => FILTER_FLAG_SCHEME_REQUIRED | FILTER_FLAG_HOST_REQUIRED),
                                'picture_evoucher' => array('filter' => FILTER_VALIDATE_URL, 'flags' => FILTER_FLAG_SCHEME_REQUIRED | FILTER_FLAG_HOST_REQUIRED),
                                'picture_specialoffers' => array('filter' => FILTER_VALIDATE_URL, 'flags' => FILTER_FLAG_SCHEME_REQUIRED | FILTER_FLAG_HOST_REQUIRED)
                            );
                            $post = filter_input_array(INPUT_POST, $args);
                            if(isset($_POST['hid_id']) && $_POST['hid_id'] == $url_id && !empty($post['picture_store']) /*&& !empty($post['picture_marketplace']) */&& !empty($post['picture_hotel']) && !empty($post['picture_restaurant']) && !empty($post['picture_article']) && !empty($post['picture_beauty']) && !empty($post['picture_magazine']) && !empty($post['picture_industry']) && !empty($post['picture_evoucher']) && !empty($post['picture_specialoffers'])) {
                                $viewmodel = new HomeModel(NULL, 'u');
                                $update_thumbnail = $viewmodel->updateHomeThumbnail(array('store'=>$post['picture_store']/*, 'marketplace'=>$post['picture_marketplace']*/, 'hotel'=>$post['picture_hotel'], 'restaurant'=>$post['picture_restaurant'], 'article'=>$post['picture_article'], 'beauty'=>$post['picture_beauty'], 'magazine'=>$post['picture_magazine'], 'industry'=>$post['picture_industry'], 'evoucher'=>$post['picture_evoucher'], 'specialoffers'=>$post['picture_specialoffers']), array('id'=>$url_id));

                                $insert_main_slider = $this->insertMainSlider('home', $url_id, $_POST['picture'], $_POST['video_or_link'], $_POST['order'], true);

                                $viewmodel = new HomeModel;
                                if($update_thumbnail) $data_edit = $viewmodel->getHomeThumbnail(array('id'=>$url_id));
                                if($insert_main_slider) $data_edit_main_pic = $viewmodel->getHomeMainPic(array('id_country'=>$url_id, 'order_by'=>array('urutan'=>'ASC')));

                                if($update_thumbnail && $insert_main_slider) Messages::setMsg('Successfully update home page.', 'success', 'Success!');
                                else Messages::setMsg('Failed to update home page.', 'danger', 'Error!');
                            }
                            else Messages::setMsg('Incomplete Input Data.', 'danger', 'Error!');
                        }

                        $this->registry->template->data_edit_main_pic = $data_edit_main_pic;
                        $this->registry->template->data_edit = $data_edit[0];

                        $this->registry->template->page_title = "Edit | Home Page - System";
                        $this->registry->template->header_title = "Edit Home Page";
                        $this->registry->template->page_id = $page_id;

                        $breadcrumb = array();
                        $breadcrumb[0]['str'] = "System";
                        $breadcrumb[1]['str'] = "Home Page";
                        $breadcrumb[1]['href'] = "system/home-page/";
                        $breadcrumb[2]['str'] = "Edit";
                        $breadcrumb[2]['active'] = true;
                        $this->registry->template->breadcrumb = $breadcrumb;

                        $jsSrc = array();
                        $jsSrc[0]['type'] = "js";
                        $jsSrc[0]['src'] = 'assets/js/bundles/slider-main.js';
                        $jsSrc[1]['type'] = "js";
                        $jsSrc[1]['src'] = $this->registry->default_js_src;
                        $this->registry->template->jsSrc = $jsSrc;

                        $this->registry->imageCSP .= " https://i.ytimg.com";

                        $this->returnView();
                    }
                    else header('Location: ' . ROOT_PATH . 'system/home-page/');
                }
                else header('Location: ' . ROOT_PATH . 'system/home-page/');
            }
            else Redirect::home();
        }
        else Redirect::signin();
    }

    protected function settings(){
        if($this->registry->template->login_check){
            $page_id = '15|3';
            if(UserHelper::checkUserAccess($page_id)) {
                if(isset($_POST) && !empty($_POST)) {
                    $args = array(
                        'company_name' => array('filter' => FILTER_SANITIZE_STRING, 'flags' => FILTER_FLAG_STRIP_LOW | FILTER_FLAG_STRIP_HIGH | FILTER_FLAG_STRIP_BACKTICK),
                        'name' => array('filter' => FILTER_SANITIZE_STRING, 'flags' => FILTER_FLAG_STRIP_LOW | FILTER_FLAG_STRIP_HIGH | FILTER_FLAG_STRIP_BACKTICK),
                        'title_text' => array('filter' => FILTER_SANITIZE_STRING, 'flags' => FILTER_FLAG_STRIP_LOW | FILTER_FLAG_STRIP_HIGH | FILTER_FLAG_STRIP_BACKTICK),
                        'short_description' => array('filter' => FILTER_SANITIZE_STRING, 'flags' => FILTER_FLAG_STRIP_LOW | FILTER_FLAG_STRIP_HIGH | FILTER_FLAG_STRIP_BACKTICK),
                        'address' => array('filter' => FILTER_SANITIZE_STRING, 'flags' => FILTER_FLAG_STRIP_LOW | FILTER_FLAG_STRIP_HIGH | FILTER_FLAG_STRIP_BACKTICK),
                        'google_map' => array('filter' => FILTER_VALIDATE_URL, 'flags' => FILTER_FLAG_SCHEME_REQUIRED | FILTER_FLAG_HOST_REQUIRED),
                        'telp' => FILTER_SANITIZE_NUMBER_INT,
                        'fax' => FILTER_SANITIZE_NUMBER_INT,
                        'email' => FILTER_VALIDATE_EMAIL,
                        'paypal_account' => FILTER_VALIDATE_EMAIL
                    );
                    $post = filter_input_array(INPUT_POST, $args);
                    $post['keywords'] = NULL;
                    if(isset($_POST['keywords'])) $post['keywords'] = Validator::checkKeyword($_POST['keywords']);
                    $post['about'] = NULL;
                    if(isset($_POST['about'])) $post['about'] = MainHelper::quotTo39(Validator::purifyHtml($_POST['about']));
                    $post['about_two'] = NULL;
                    if(isset($_POST['about_two'])) $post['about_two'] = MainHelper::quotTo39(Validator::purifyHtml($_POST['about_two']));

                    if (!empty($post['company_name']) && !empty($post['name']) && !empty($post['title_text']) && !empty($post['short_description']) && !empty($post['keywords']) && !empty($post['about']) && !empty($post['about_two']) && !empty($post['address']) && !empty($post['telp']) && !empty($post['email']) && !empty($post['paypal_account'])) {
                        if(empty($post['google_map'])) $post['google_map'] = NULL;
                        $viewmodel = new MyInfoModel(NULL, 'u');
                        if($viewmodel->updateInfo(array('nama_pt'=>$post['company_name'], 'sebutan'=>$post['name'], 'title_teks'=>$post['title_text'], 'desp'=>$post['short_description'], 'kkp'=>$post['keywords'], 'about'=>$post['about'], 'about_two'=>$post['about_two'], 'alamat'=>$post['address'], 'google_map'=>$post['google_map'], 'telp'=>$post['telp'], 'faks'=>$post['fax'], 'email'=>$post['email'], 'ppac'=>$post['paypal_account']), array('id'=>1))) Messages::setMsg('Succesfully update system settings.', 'success', 'Success!');
                        else Messages::setMsg('Failed to update system settings.', 'danger', 'Error!');
                    }
                    else Messages::setMsg('Incomplete Input Data.', 'danger', 'Error!');
                }
                //PRODUCT
                if(isset($_POST) && !empty($_POST)) {
                    $count_row = NULL;
                    if(isset($_POST['count_row'])) $count_row = intval(filter_var($_POST['count_row'], FILTER_VALIDATE_INT));
                    if(!empty($count_row)){
                        $viewmodel = new MyInfoModel(NULL, 'd');
                        $viewmodel->deleteProductHome();

                        $data = array('id_product'=>$_POST['id_product'], 'url_product'=>$_POST['url_product']);
                        $args = array(
                            'id_product'=>array('filter' => FILTER_SANITIZE_STRING, 'flags' => FILTER_FORCE_ARRAY | FILTER_FLAG_STRIP_LOW | FILTER_FLAG_STRIP_HIGH | FILTER_FLAG_STRIP_BACKTICK),
                            'url_product'=>array('filter' => FILTER_VALIDATE_URL, 'flags' => FILTER_FORCE_ARRAY | FILTER_FLAG_SCHEME_REQUIRED | FILTER_FLAG_HOST_REQUIRED)
                        );
                        $data = filter_var_array($data, $args);
                        $viewmodel = new MyInfoModel(NULL, 'i');
                        if ($viewmodel->insertProductHome($data['id_product'], $data['url_product'])) Messages::setMsg('Successfully update.', 'success', 'Success!');
                        else Messages::setMsg('Failed to update.', 'danger', 'Error!');
                    }
                }

                if(isset($_POST) && !empty($_POST)) {
                    $count_row = NULL;
                    if(isset($_POST['count_row'])) $count_row = intval(filter_var($_POST['count_row'], FILTER_VALIDATE_INT));
                    if(!empty($count_row)){
                        $viewmodel = new MyInfoModel(NULL, 'd');
                        $viewmodel->deleteDeksripsiProduct();

                        $data = array('judul_section_product'=>$_POST['judul_section_product'], 'title_section_product'=>$_POST['title_section_product'], 'deksripsi_section_product'=>$_POST['deksripsi_section_product']);
                        $args = array(
                            'judul_section_product'=>array('filter' => FILTER_SANITIZE_STRING, 'flags' => FILTER_FORCE_ARRAY | FILTER_FLAG_STRIP_LOW | FILTER_FLAG_STRIP_HIGH | FILTER_FLAG_STRIP_BACKTICK),
                            'title_section_product'=>array('filter' => FILTER_SANITIZE_STRING, 'flags' => FILTER_FORCE_ARRAY | FILTER_FLAG_STRIP_LOW | FILTER_FLAG_STRIP_HIGH | FILTER_FLAG_STRIP_BACKTICK),
                            'deksripsi_section_product'=>array('filter' => FILTER_SANITIZE_STRING, 'flags' => FILTER_FORCE_ARRAY | FILTER_FLAG_STRIP_LOW | FILTER_FLAG_STRIP_HIGH | FILTER_FLAG_STRIP_BACKTICK)
                        );
                        $data = filter_var_array($data, $args);
                        $viewmodel = new MyInfoModel(NULL, 'i');
                        if ($viewmodel->insertDeksripsiProduct($data['judul_section_product'], $data['title_section_product'], $data['deksripsi_section_product'])) Messages::setMsg('Successfully update.', 'success', 'Success!');
                        else Messages::setMsg('Failed to update.', 'danger', 'Error!');
                    }
                }

                // Row Product 2
                if(isset($_POST) && !empty($_POST)) {
                    $count_row = NULL;
                    if(isset($_POST['count_row'])) $count_row = intval(filter_var($_POST['count_row'], FILTER_VALIDATE_INT));
                    if(!empty($count_row)){
                        $viewmodel = new MyInfoModel(NULL, 'd');
                        $viewmodel->deleteProductRowTwoHome();

                        $data = array('id_productrowtwo'=>$_POST['id_productrowtwo'], 'url_productrowtwo'=>$_POST['url_productrowtwo']);
                        $args = array(
                            'id_productrowtwo'=>array('filter' => FILTER_SANITIZE_STRING, 'flags' => FILTER_FORCE_ARRAY | FILTER_FLAG_STRIP_LOW | FILTER_FLAG_STRIP_HIGH | FILTER_FLAG_STRIP_BACKTICK),
                            'url_productrowtwo'=>array('filter' => FILTER_VALIDATE_URL, 'flags' => FILTER_FORCE_ARRAY | FILTER_FLAG_SCHEME_REQUIRED | FILTER_FLAG_HOST_REQUIRED)
                        );
                        $data = filter_var_array($data, $args);
                        $viewmodel = new MyInfoModel(NULL, 'i');
                        if ($viewmodel->insertProductRowTwoHome($data['id_productrowtwo'], $data['url_productrowtwo'])) Messages::setMsg('Successfully update.', 'success', 'Success!');
                        else Messages::setMsg('Failed to update.', 'danger', 'Error!');
                    }
                }

                if(isset($_POST) && !empty($_POST)) {
                    $count_row = NULL;
                    if(isset($_POST['count_row'])) $count_row = intval(filter_var($_POST['count_row'], FILTER_VALIDATE_INT));
                    if(!empty($count_row)){
                        $viewmodel = new MyInfoModel(NULL, 'd');
                        $viewmodel->deleteDeksripsiProductRowTwo();

                        $data = array('title_section_productrowtwo'=>$_POST['title_section_productrowtwo']);
                        $args = array(
                            'title_section_productrowtwo'=>array('filter' => FILTER_SANITIZE_STRING, 'flags' => FILTER_FORCE_ARRAY | FILTER_FLAG_STRIP_LOW | FILTER_FLAG_STRIP_HIGH | FILTER_FLAG_STRIP_BACKTICK)
                        );
                        $data = filter_var_array($data, $args);
                        $viewmodel = new MyInfoModel(NULL, 'i');
                        if ($viewmodel->insertDeksripsiProductRowTwo($data['title_section_productrowtwo'])) Messages::setMsg('Successfully update.', 'success', 'Success!');
                        else Messages::setMsg('Failed to update.', 'danger', 'Error!');
                    }
                }
                // END PRODUCT
                //MAGAZINE
                if(isset($_POST) && !empty($_POST)) {
                    $count_row = NULL;
                    if(isset($_POST['count_row'])) $count_row = intval(filter_var($_POST['count_row'], FILTER_VALIDATE_INT));
                    if(!empty($count_row)){
                        $viewmodel = new MyInfoModel(NULL, 'd');
                        $viewmodel->deleteMagazineHome();

                        $data = array('id_magazine'=>$_POST['id_magazine']);
                        $args = array(
                            'id_magazine'=>array('filter' => FILTER_SANITIZE_STRING, 'flags' => FILTER_FORCE_ARRAY | FILTER_FLAG_STRIP_LOW | FILTER_FLAG_STRIP_HIGH | FILTER_FLAG_STRIP_BACKTICK)
                        );
                        $data = filter_var_array($data, $args);
                        $viewmodel = new MyInfoModel(NULL, 'i');
                        if ($viewmodel->insertMagazineHome($data['id_magazine'])) Messages::setMsg('Successfully update.', 'success', 'Success!');
                        else Messages::setMsg('Failed to update.', 'danger', 'Error!');
                    }
                }

                if(isset($_POST) && !empty($_POST)) {
                    $count_row = NULL;
                    if(isset($_POST['count_row'])) $count_row = intval(filter_var($_POST['count_row'], FILTER_VALIDATE_INT));
                    if(!empty($count_row)){
                        $viewmodel = new MyInfoModel(NULL, 'd');
                        $viewmodel->deleteDeksripsiMagazine();

                        $data = array('judul_section_magazine'=>$_POST['judul_section_magazine'], 'title_section_magazine'=>$_POST['title_section_magazine'], 'deksripsi_section_magazine'=>$_POST['deksripsi_section_magazine']);
                        $args = array(
                            'judul_section_magazine'=>array('filter' => FILTER_SANITIZE_STRING, 'flags' => FILTER_FORCE_ARRAY | FILTER_FLAG_STRIP_LOW | FILTER_FLAG_STRIP_HIGH | FILTER_FLAG_STRIP_BACKTICK),
                            'title_section_magazine'=>array('filter' => FILTER_SANITIZE_STRING, 'flags' => FILTER_FORCE_ARRAY | FILTER_FLAG_STRIP_LOW | FILTER_FLAG_STRIP_HIGH | FILTER_FLAG_STRIP_BACKTICK),
                            'deksripsi_section_magazine'=>array('filter' => FILTER_SANITIZE_STRING, 'flags' => FILTER_FORCE_ARRAY | FILTER_FLAG_STRIP_LOW | FILTER_FLAG_STRIP_HIGH | FILTER_FLAG_STRIP_BACKTICK)
                        );
                        $data = filter_var_array($data, $args);
                        $viewmodel = new MyInfoModel(NULL, 'i');
                        if ($viewmodel->insertDeksripsiMagazine($data['judul_section_magazine'], $data['title_section_magazine'], $data['deksripsi_section_magazine'])) Messages::setMsg('Successfully update.', 'success', 'Success!');
                        else Messages::setMsg('Failed to update.', 'danger', 'Error!');
                    }
                }

                // row two
                if(isset($_POST) && !empty($_POST)) {
                    $count_row = NULL;
                    if(isset($_POST['count_row'])) $count_row = intval(filter_var($_POST['count_row'], FILTER_VALIDATE_INT));
                    if(!empty($count_row)){
                        $viewmodel = new MyInfoModel(NULL, 'd');
                        $viewmodel->deleteMagazineRowTwoHome();

                        $data = array('id_magazinerowtwo'=>$_POST['id_magazinerowtwo']);
                        $args = array(
                            'id_magazinerowtwo'=>array('filter' => FILTER_SANITIZE_STRING, 'flags' => FILTER_FORCE_ARRAY | FILTER_FLAG_STRIP_LOW | FILTER_FLAG_STRIP_HIGH | FILTER_FLAG_STRIP_BACKTICK)
                        );
                        $data = filter_var_array($data, $args);
                        $viewmodel = new MyInfoModel(NULL, 'i');
                        if ($viewmodel->insertMagazineRowTwoHome($data['id_magazinerowtwo'])) Messages::setMsg('Successfully update.', 'success', 'Success!');
                        else Messages::setMsg('Failed to update.', 'danger', 'Error!');
                    }
                }

                if(isset($_POST) && !empty($_POST)) {
                    $count_row = NULL;
                    if(isset($_POST['count_row'])) $count_row = intval(filter_var($_POST['count_row'], FILTER_VALIDATE_INT));
                    if(!empty($count_row)){
                        $viewmodel = new MyInfoModel(NULL, 'd');
                        $viewmodel->deleteDeksripsiMagazineRowTwo();

                        $data = array('title_section_magazinerowtwo'=>$_POST['title_section_magazinerowtwo']);
                        $args = array(
                            'title_section_magazinerowtwo'=>array('filter' => FILTER_SANITIZE_STRING, 'flags' => FILTER_FORCE_ARRAY | FILTER_FLAG_STRIP_LOW | FILTER_FLAG_STRIP_HIGH | FILTER_FLAG_STRIP_BACKTICK)
                        );
                        $data = filter_var_array($data, $args);
                        $viewmodel = new MyInfoModel(NULL, 'i');
                        if ($viewmodel->insertDeksripsiMagazineRowTwo($data['title_section_magazinerowtwo'])) Messages::setMsg('Successfully update.', 'success', 'Success!');
                        else Messages::setMsg('Failed to update.', 'danger', 'Error!');
                    }
                }
                // END MAGAZINE
                // NEWSFEED
                if(isset($_POST) && !empty($_POST)) {
                    $count_row = NULL;
                    if(isset($_POST['count_row'])) $count_row = intval(filter_var($_POST['count_row'], FILTER_VALIDATE_INT));
                    if(!empty($count_row)){
                        $viewmodel = new MyInfoModel(NULL, 'd');
                        $viewmodel->deleteNewsfeedHome();

                        $data = array('id_article'=>$_POST['id_article']);
                        $args = array(
                            'id_article'=>array('filter' => FILTER_SANITIZE_STRING, 'flags' => FILTER_FORCE_ARRAY | FILTER_FLAG_STRIP_LOW | FILTER_FLAG_STRIP_HIGH | FILTER_FLAG_STRIP_BACKTICK)
                        );
                        $data = filter_var_array($data, $args);
                        $viewmodel = new MyInfoModel(NULL, 'i');
                        if ($viewmodel->insertNewsfeedHome($data['id_article'])) Messages::setMsg('Successfully update.', 'success', 'Success!');
                        else Messages::setMsg('Failed to update.', 'danger', 'Error!');
                    }
                }

                if(isset($_POST) && !empty($_POST)) {
                    $count_row = NULL;
                    if(isset($_POST['count_row'])) $count_row = intval(filter_var($_POST['count_row'], FILTER_VALIDATE_INT));
                    if(!empty($count_row)){
                        $viewmodel = new MyInfoModel(NULL, 'd');
                        $viewmodel->deleteDeksripsiNewsfeed();

                        $data = array('judul_section_article'=>$_POST['judul_section_article'], 'title_section_article'=>$_POST['title_section_article'], 'deksripsi_section_article'=>$_POST['deksripsi_section_article']);
                        $args = array(
                            'judul_section_article'=>array('filter' => FILTER_SANITIZE_STRING, 'flags' => FILTER_FORCE_ARRAY | FILTER_FLAG_STRIP_LOW | FILTER_FLAG_STRIP_HIGH | FILTER_FLAG_STRIP_BACKTICK),
                            'title_section_article'=>array('filter' => FILTER_SANITIZE_STRING, 'flags' => FILTER_FORCE_ARRAY | FILTER_FLAG_STRIP_LOW | FILTER_FLAG_STRIP_HIGH | FILTER_FLAG_STRIP_BACKTICK),
                            'deksripsi_section_article'=>array('filter' => FILTER_SANITIZE_STRING, 'flags' => FILTER_FORCE_ARRAY | FILTER_FLAG_STRIP_LOW | FILTER_FLAG_STRIP_HIGH | FILTER_FLAG_STRIP_BACKTICK)
                        );
                        $data = filter_var_array($data, $args);
                        $viewmodel = new MyInfoModel(NULL, 'i');
                        if ($viewmodel->insertDeksripsiNewsfeed($data['judul_section_article'], $data['title_section_article'], $data['deksripsi_section_article'])) Messages::setMsg('Successfully update.', 'success', 'Success!');
                        else Messages::setMsg('Failed to update.', 'danger', 'Error!');
                    }
                }
                // row two
                 if(isset($_POST) && !empty($_POST)) {
                    $count_row = NULL;
                    if(isset($_POST['count_row'])) $count_row = intval(filter_var($_POST['count_row'], FILTER_VALIDATE_INT));
                    if(!empty($count_row)){
                        $viewmodel = new MyInfoModel(NULL, 'd');
                        $viewmodel->deleteNewsfeedRowTwoHome();

                        $data = array('id_articlerowtwo'=>$_POST['id_articlerowtwo']);
                        $args = array(
                            'id_articlerowtwo'=>array('filter' => FILTER_SANITIZE_STRING, 'flags' => FILTER_FORCE_ARRAY | FILTER_FLAG_STRIP_LOW | FILTER_FLAG_STRIP_HIGH | FILTER_FLAG_STRIP_BACKTICK)
                        );
                        $data = filter_var_array($data, $args);
                        $viewmodel = new MyInfoModel(NULL, 'i');
                        if ($viewmodel->insertNewsfeedRowTwoHome($data['id_articlerowtwo'])) Messages::setMsg('Successfully update.', 'success', 'Success!');
                        else Messages::setMsg('Failed to update.', 'danger', 'Error!');
                    }
                }

                if(isset($_POST) && !empty($_POST)) {
                    $count_row = NULL;
                    if(isset($_POST['count_row'])) $count_row = intval(filter_var($_POST['count_row'], FILTER_VALIDATE_INT));
                    if(!empty($count_row)){
                        $viewmodel = new MyInfoModel(NULL, 'd');
                        $viewmodel->deleteDeksripsiNewsfeedRowTwo();

                        $data = array('title_section_articlerowtwo'=>$_POST['title_section_articlerowtwo']);
                        $args = array(
                         
                            'title_section_articlerowtwo'=>array('filter' => FILTER_SANITIZE_STRING, 'flags' => FILTER_FORCE_ARRAY | FILTER_FLAG_STRIP_LOW | FILTER_FLAG_STRIP_HIGH | FILTER_FLAG_STRIP_BACKTICK)
                        
                        );
                        $data = filter_var_array($data, $args);
                        $viewmodel = new MyInfoModel(NULL, 'i');
                        if ($viewmodel->insertDeksripsiNewsfeedRowTwo($data['title_section_articlerowtwo'])) Messages::setMsg('Successfully update.', 'success', 'Success!');
                        else Messages::setMsg('Failed to update.', 'danger', 'Error!');
                    }
                }
                
                // END NEWSFEED
                // VOUCHER
                if(isset($_POST) && !empty($_POST)) {
                    $count_row = NULL;
                    if(isset($_POST['count_row'])) $count_row = intval(filter_var($_POST['count_row'], FILTER_VALIDATE_INT));
                    if(!empty($count_row)){
                        $viewmodel = new MyInfoModel(NULL, 'd');
                        $viewmodel->deleteVoucherHome();

                        $data = array('id_voucher'=>$_POST['id_voucher']);
                        $args = array(
                            'id_voucher'=>array('filter' => FILTER_SANITIZE_STRING, 'flags' => FILTER_FORCE_ARRAY | FILTER_FLAG_STRIP_LOW | FILTER_FLAG_STRIP_HIGH | FILTER_FLAG_STRIP_BACKTICK)
                        );
                        $data = filter_var_array($data, $args);
                        $viewmodel = new MyInfoModel(NULL, 'i');
                        if ($viewmodel->insertVoucherHome($data['id_voucher'])) Messages::setMsg('Successfully update.', 'success', 'Success!');
                        else Messages::setMsg('Failed to update.', 'danger', 'Error!');
                    }
                }

                if(isset($_POST) && !empty($_POST)) {
                    $count_row = NULL;
                    if(isset($_POST['count_row'])) $count_row = intval(filter_var($_POST['count_row'], FILTER_VALIDATE_INT));
                    if(!empty($count_row)){
                        $viewmodel = new MyInfoModel(NULL, 'd');
                        $viewmodel->deleteDeksripsiVoucher();

                        $data = array('judul_section_voucher'=>$_POST['judul_section_voucher'], 'title_section_voucher'=>$_POST['title_section_voucher'], 'deksripsi_section_voucher'=>$_POST['deksripsi_section_voucher']);
                        $args = array(
                            'judul_section_voucher'=>array('filter' => FILTER_SANITIZE_STRING, 'flags' => FILTER_FORCE_ARRAY | FILTER_FLAG_STRIP_LOW | FILTER_FLAG_STRIP_HIGH | FILTER_FLAG_STRIP_BACKTICK),
                            'title_section_voucher'=>array('filter' => FILTER_SANITIZE_STRING, 'flags' => FILTER_FORCE_ARRAY | FILTER_FLAG_STRIP_LOW | FILTER_FLAG_STRIP_HIGH | FILTER_FLAG_STRIP_BACKTICK),
                            'deksripsi_section_voucher'=>array('filter' => FILTER_SANITIZE_STRING, 'flags' => FILTER_FORCE_ARRAY | FILTER_FLAG_STRIP_LOW | FILTER_FLAG_STRIP_HIGH | FILTER_FLAG_STRIP_BACKTICK)
                        );
                        $data = filter_var_array($data, $args);
                        $viewmodel = new MyInfoModel(NULL, 'i');
                        if ($viewmodel->insertDeksripsiVoucher($data['judul_section_voucher'], $data['title_section_voucher'], $data['deksripsi_section_voucher'])) Messages::setMsg('Successfully update.', 'success', 'Success!');
                        else Messages::setMsg('Failed to update.', 'danger', 'Error!');
                    }
                }

                // row two
                 if(isset($_POST) && !empty($_POST)) {
                    $count_row = NULL;
                    if(isset($_POST['count_row'])) $count_row = intval(filter_var($_POST['count_row'], FILTER_VALIDATE_INT));
                    if(!empty($count_row)){
                        $viewmodel = new MyInfoModel(NULL, 'd');
                        $viewmodel->deleteVoucherRowTwoHome();

                        $data = array('id_voucherrowtwo'=>$_POST['id_voucherrowtwo']);
                        $args = array(
                            'id_voucherrowtwo'=>array('filter' => FILTER_SANITIZE_STRING, 'flags' => FILTER_FORCE_ARRAY | FILTER_FLAG_STRIP_LOW | FILTER_FLAG_STRIP_HIGH | FILTER_FLAG_STRIP_BACKTICK)
                        );
                        $data = filter_var_array($data, $args);
                        $viewmodel = new MyInfoModel(NULL, 'i');
                        if ($viewmodel->insertVoucherRowTwoHome($data['id_voucherrowtwo'])) Messages::setMsg('Successfully update.', 'success', 'Success!');
                        else Messages::setMsg('Failed to update.', 'danger', 'Error!');
                    }
                }
                if(isset($_POST) && !empty($_POST)) {
                    $count_row = NULL;
                    if(isset($_POST['count_row'])) $count_row = intval(filter_var($_POST['count_row'], FILTER_VALIDATE_INT));
                    if(!empty($count_row)){
                        $viewmodel = new MyInfoModel(NULL, 'd');
                        $viewmodel->deleteDeksripsiVoucherrowtwo();

                        $data = array('title_section_voucherrowtwo'=>$_POST['title_section_voucherrowtwo']);
                        $args = array(
                            'title_section_voucherrowtwo'=>array('filter' => FILTER_SANITIZE_STRING, 'flags' => FILTER_FORCE_ARRAY | FILTER_FLAG_STRIP_LOW | FILTER_FLAG_STRIP_HIGH | FILTER_FLAG_STRIP_BACKTICK)
                        );
                        $data = filter_var_array($data, $args);
                        $viewmodel = new MyInfoModel(NULL, 'i');
                        if ($viewmodel->insertDeksripsiVoucherrowtwo($data['title_section_voucherrowtwo'])) Messages::setMsg('Successfully update.', 'success', 'Success!');
                        else Messages::setMsg('Failed to update.', 'danger', 'Error!');
                    }
                }
                // END VOUCHER

                // SPECIALOFFERS
                if(isset($_POST) && !empty($_POST)) {
                    $count_row = NULL;
                    if(isset($_POST['count_row'])) $count_row = intval(filter_var($_POST['count_row'], FILTER_VALIDATE_INT));
                    if(!empty($count_row)){
                        $viewmodel = new MyInfoModel(NULL, 'd');
                        $viewmodel->deleteSpecialOffersHome();

                        $data = array('id_specialoffers'=>$_POST['id_specialoffers']);
                        $args = array(
                            'id_specialoffers'=>array('filter' => FILTER_SANITIZE_STRING, 'flags' => FILTER_FORCE_ARRAY | FILTER_FLAG_STRIP_LOW | FILTER_FLAG_STRIP_HIGH | FILTER_FLAG_STRIP_BACKTICK)
                        );
                        $data = filter_var_array($data, $args);
                        $viewmodel = new MyInfoModel(NULL, 'i');
                        if ($viewmodel->insertSpecialOffersHome($data['id_specialoffers'])) Messages::setMsg('Successfully update.', 'success', 'Success!');
                        else Messages::setMsg('Failed to update.', 'danger', 'Error!');
                    }
                }

                if(isset($_POST) && !empty($_POST)) {
                    $count_row = NULL;
                    if(isset($_POST['count_row'])) $count_row = intval(filter_var($_POST['count_row'], FILTER_VALIDATE_INT));
                    if(!empty($count_row)){
                        $viewmodel = new MyInfoModel(NULL, 'd');
                        $viewmodel->deleteDeksripsiSpecialOffers();

                        $data = array('judul_section_specialoffers'=>$_POST['judul_section_specialoffers'], 'title_section_specialoffers'=>$_POST['title_section_specialoffers'], 'deksripsi_section_specialoffers'=>$_POST['deksripsi_section_specialoffers']);
                        $args = array(
                            'judul_section_specialoffers'=>array('filter' => FILTER_SANITIZE_STRING, 'flags' => FILTER_FORCE_ARRAY | FILTER_FLAG_STRIP_LOW | FILTER_FLAG_STRIP_HIGH | FILTER_FLAG_STRIP_BACKTICK),
                            'title_section_specialoffers'=>array('filter' => FILTER_SANITIZE_STRING, 'flags' => FILTER_FORCE_ARRAY | FILTER_FLAG_STRIP_LOW | FILTER_FLAG_STRIP_HIGH | FILTER_FLAG_STRIP_BACKTICK),
                            'deksripsi_section_specialoffers'=>array('filter' => FILTER_SANITIZE_STRING, 'flags' => FILTER_FORCE_ARRAY | FILTER_FLAG_STRIP_LOW | FILTER_FLAG_STRIP_HIGH | FILTER_FLAG_STRIP_BACKTICK)
                        );
                        $data = filter_var_array($data, $args);
                        $viewmodel = new MyInfoModel(NULL, 'i');
                        if ($viewmodel->insertDeksripsiSpecialOffers($data['judul_section_specialoffers'], $data['title_section_specialoffers'], $data['deksripsi_section_specialoffers'])) Messages::setMsg('Successfully update.', 'success', 'Success!');
                        else Messages::setMsg('Failed to update.', 'danger', 'Error!');
                    }
                }

                // row two
                if(isset($_POST) && !empty($_POST)) {
                    $count_row = NULL;
                    if(isset($_POST['count_row'])) $count_row = intval(filter_var($_POST['count_row'], FILTER_VALIDATE_INT));
                    if(!empty($count_row)){
                        $viewmodel = new MyInfoModel(NULL, 'd');
                        $viewmodel->deleteSpecialOffersRowTwoHome();

                        $data = array('id_specialoffersrowtwo'=>$_POST['id_specialoffersrowtwo']);
                        $args = array(
                            'id_specialoffersrowtwo'=>array('filter' => FILTER_SANITIZE_STRING, 'flags' => FILTER_FORCE_ARRAY | FILTER_FLAG_STRIP_LOW | FILTER_FLAG_STRIP_HIGH | FILTER_FLAG_STRIP_BACKTICK)
                        );
                        $data = filter_var_array($data, $args);
                        $viewmodel = new MyInfoModel(NULL, 'i');
                        if ($viewmodel->insertSpecialOffersRowTwoHome($data['id_specialoffersrowtwo'])) Messages::setMsg('Successfully update.', 'success', 'Success!');
                        else Messages::setMsg('Failed to update.', 'danger', 'Error!');
                    }
                }
                if(isset($_POST) && !empty($_POST)) {
                    $count_row = NULL;
                    if(isset($_POST['count_row'])) $count_row = intval(filter_var($_POST['count_row'], FILTER_VALIDATE_INT));
                    if(!empty($count_row)){
                        $viewmodel = new MyInfoModel(NULL, 'd');
                        $viewmodel->deleteDeksripsiSpecialOffersrowtwo();

                        $data = array('title_section_specialoffersrowtwo'=>$_POST['title_section_specialoffersrowtwo']);
                        $args = array(
                            'title_section_specialoffersrowtwo'=>array('filter' => FILTER_SANITIZE_STRING, 'flags' => FILTER_FORCE_ARRAY | FILTER_FLAG_STRIP_LOW | FILTER_FLAG_STRIP_HIGH | FILTER_FLAG_STRIP_BACKTICK)
                        );
                        $data = filter_var_array($data, $args);
                        $viewmodel = new MyInfoModel(NULL, 'i');
                        if ($viewmodel->insertDeksripsiSpecialOffersrowtwo($data['title_section_specialoffersrowtwo'])) Messages::setMsg('Successfully update.', 'success', 'Success!');
                        else Messages::setMsg('Failed to update.', 'danger', 'Error!');
                    }
                }
                // END SPECIALOFFERS
                // ADS BANNER
                /*if(isset($_POST) && !empty($_POST)) {
                    $count_row = NULL;
                    if(isset($_POST['count_row'])) $count_row = intval(filter_var($_POST['count_row'], FILTER_VALIDATE_INT));
                    if(!empty($count_row)){
                        $viewmodel = new MyInfoModel(NULL, 'd');
                        $viewmodel->deleteAdsBenner();

                        $data = array('url_gbr'=>$_POST['url_gbr']);
                        $args = array(
                            'url_gbr'=>array('filter' => FILTER_VALIDATE_URL, 'flags' => FILTER_FORCE_ARRAY | FILTER_FLAG_SCHEME_REQUIRED | FILTER_FLAG_HOST_REQUIRED)
                        );
                        $data = filter_var_array($data, $args);
                        $viewmodel = new MyInfoModel(NULL, 'i');
                        if ($viewmodel->insertAdsBenner($data['url_gbr'])) Messages::setMsg('Successfully update.', 'success', 'Success!');
                        else Messages::setMsg('Failed to update.', 'danger', 'Error!');
                    }
                }*/
                /*if(isset($_POST) && !empty($_POST)) {
                    $count_row = NULL;
                    if(isset($_POST['count_row'])) $count_row = intval(filter_var($_POST['count_row'], FILTER_VALIDATE_INT));
                    if(!empty($count_row)){
                        $viewmodel = new MyInfoModel(NULL, 'd');
                        $viewmodel->deleteAdsBennerBody();

                        $data = array('url_gbradsbody'=>$_POST['url_gbradsbody']);
                        $args = array(
                            'url_gbradsbody'=>array('filter' => FILTER_VALIDATE_URL, 'flags' => FILTER_FORCE_ARRAY | FILTER_FLAG_SCHEME_REQUIRED | FILTER_FLAG_HOST_REQUIRED)
                        );
                        $data = filter_var_array($data, $args);
                        $viewmodel = new MyInfoModel(NULL, 'i');
                        if ($viewmodel->insertAdsBennerBody($data['url_gbradsbody'])) Messages::setMsg('Successfully update.', 'success', 'Success!');
                        else Messages::setMsg('Failed to update.', 'danger', 'Error!');
                    }
                }*/
                /*if(isset($_POST) && !empty($_POST)) {
                    $count_row = NULL;
                    if(isset($_POST['count_row'])) $count_row = intval(filter_var($_POST['count_row'], FILTER_VALIDATE_INT));
                    if(!empty($count_row)){
                        $viewmodel = new MyInfoModel(NULL, 'd');
                        $viewmodel->deleteAdsBennerFooter();

                        $data = array('url_gbradsfooter'=>$_POST['url_gbradsfooter']);
                        $args = array(
                            'url_gbradsfooter'=>array('filter' => FILTER_VALIDATE_URL, 'flags' => FILTER_FORCE_ARRAY | FILTER_FLAG_SCHEME_REQUIRED | FILTER_FLAG_HOST_REQUIRED)
                        );
                        $data = filter_var_array($data, $args);
                        $viewmodel = new MyInfoModel(NULL, 'i');
                        if ($viewmodel->insertAdsBennerFooter($data['url_gbradsfooter'])) Messages::setMsg('Successfully update.', 'success', 'Success!');
                        else Messages::setMsg('Failed to update.', 'danger', 'Error!');
                    }
                }*/
                if(isset($_POST) && !empty($_POST)) {
                    $count_row = NULL;
                    if(isset($_POST['count_row'])) $count_row = intval(filter_var($_POST['count_row'], FILTER_VALIDATE_INT));
                    if(!empty($count_row)){
                        $viewmodel = new MyInfoModel(NULL, 'd');
                        $viewmodel->deleteAdsBennerHeadertwo();

                        $data = array('url_gbradsheadertwo'=>$_POST['url_gbradsheadertwo'], 'url_linkadsheadertwo'=>$_POST['url_linkadsheadertwo']);
                        $args = array(
                            'url_gbradsheadertwo'=>array('filter' => FILTER_VALIDATE_URL, 'flags' => FILTER_FORCE_ARRAY | FILTER_FLAG_SCHEME_REQUIRED | FILTER_FLAG_HOST_REQUIRED),
                            'url_linkadsheadertwo'=>array('filter' => FILTER_VALIDATE_URL, 'flags' => FILTER_FORCE_ARRAY | FILTER_FLAG_SCHEME_REQUIRED | FILTER_FLAG_HOST_REQUIRED)
                        );
                        $data = filter_var_array($data, $args);
                        $viewmodel = new MyInfoModel(NULL, 'i');
                        if ($viewmodel->insertAdsBennerHeadertwo($data['url_gbradsheadertwo'], $data['url_linkadsheadertwo'])) Messages::setMsg('Successfully update.', 'success', 'Success!');
                        else Messages::setMsg('Failed to update.', 'danger', 'Error!');
                    }
                }
                if(isset($_POST) && !empty($_POST)){
                    $count_row = NULL;
                    if(isset($_POST['count_row'])) $count_row = intval(filter_var($_POST['count_row'], FILTER_VALIDATE_INT));
                    if(!empty($count_row)){
                        $viewmodel = new MyInfoModel(NULL, 'd');
                        $viewmodel->deleteAdsBennerBodytwo();

                        $data = array('url_gbradsbodytwo'=>$_POST['url_gbradsbodytwo'], 'url_linkadsbodytwo'=>$_POST['url_linkadsbodytwo']);
                        $args = array(
                            'url_gbradsbodytwo'=>array('filter' => FILTER_VALIDATE_URL, 'flags' => FILTER_FORCE_ARRAY | FILTER_FLAG_SCHEME_REQUIRED | FILTER_FLAG_HOST_REQUIRED),
                            'url_linkadsbodytwo'=>array('filter' => FILTER_VALIDATE_URL, 'flags' => FILTER_FORCE_ARRAY | FILTER_FLAG_SCHEME_REQUIRED | FILTER_FLAG_HOST_REQUIRED)
                        );
                        $data = filter_var_array($data, $args);
                        $viewmodel = new MyInfoModel(NULL, 'i');
                        if ($viewmodel->insertAdsBennerBodytwo($data['url_gbradsbodytwo'], $data['url_linkadsbodytwo'])) Messages::setMsg('Successfully update.', 'success', 'Success!');
                        else Messages::setMsg('Failed to update.', 'danger', 'Error!');
                    }
                }

                if(isset($_POST) && !empty($_POST)){
                    $count_row = NULL;
                    if(isset($_POST['count_row'])) $count_row = intval(filter_var($_POST['count_row'], FILTER_VALIDATE_INT));
                    if(!empty($count_row)){
                        $viewmodel = new MyInfoModel(NULL, 'd');
                        $viewmodel->deleteAdsBennerFootertwo();

                        $data = array('url_gbradsfootertwo'=>$_POST['url_gbradsfootertwo'], 'url_linkadsfootertwo'=>$_POST['url_linkadsfootertwo']);
                        $args = array(
                            'url_gbradsfootertwo'=>array('filter' => FILTER_VALIDATE_URL, 'flags' => FILTER_FORCE_ARRAY | FILTER_FLAG_SCHEME_REQUIRED | FILTER_FLAG_HOST_REQUIRED),
                            'url_linkadsfootertwo'=>array('filter' => FILTER_VALIDATE_URL, 'flags' => FILTER_FORCE_ARRAY | FILTER_FLAG_SCHEME_REQUIRED | FILTER_FLAG_HOST_REQUIRED)
                        );
                        $data = filter_var_array($data, $args);
                        $viewmodel = new MyInfoModel(NULL, 'i');
                        if ($viewmodel->insertAdsBennerFootertwo($data['url_gbradsfootertwo'], $data['url_linkadsfootertwo'])) Messages::setMsg('Successfully update.', 'success', 'Success!');
                        else Messages::setMsg('Failed to update.', 'danger', 'Error!');
                    }
                }

                /*if(isset($_POST) && !empty($_POST)){
                    $count_row = NULL;
                    if(isset($_POST['count_row'])) $count_row = intval(filter_var($_POST['count_row'], FILTER_VALIDATE_INT));
                    if(!empty($count_row)){
                        $viewmodel = new MyInfoModel(NULL, 'd');
                        $viewmodel->deleteAdsBennerSide();

                        $data = array('url_gbradsside'=>$_POST['url_gbradsside'], 'url_linkadsside'=>$_POST['url_linkadsside']);
                        $args = array(
                            'url_gbradsside'=>array('filter' => FILTER_VALIDATE_URL, 'flags' => FILTER_FORCE_ARRAY | FILTER_FLAG_SCHEME_REQUIRED | FILTER_FLAG_HOST_REQUIRED),
                            'url_linkadsside'=>array('filter' => FILTER_VALIDATE_URL, 'flags' => FILTER_FORCE_ARRAY | FILTER_FLAG_SCHEME_REQUIRED | FILTER_FLAG_HOST_REQUIRED)
                        );
                        $data = filter_var_array($data, $args);
                        $viewmodel = new MyInfoModel(NULL, 'i');
                        if ($viewmodel->insertAdsBennerSide($data['url_gbradsside'], $data['url_linkadsside'])) Messages::setMsg('Successfully update.', 'success', 'Success!');
                        else Messages::setMsg('Failed to update.', 'danger', 'Error!');
                    }
                }*/

                if(isset($_POST) && !empty($_POST)){
                    $count_row = NULL;
                    if(isset($_POST['count_row'])) $count_row = intval(filter_var($_POST['count_row'], FILTER_VALIDATE_INT));
                    if(!empty($count_row)){
                        $viewmodel = new MyInfoModel(NULL, 'd');
                        $viewmodel->deleteAdsBennerDetailPage();

                        $data = array('url_gbradsdetailpage'=>$_POST['url_gbradsdetailpage'], 'url_linkadsdetailpage'=>$_POST['url_linkadsdetailpage']);
                        $args = array(
                            'url_gbradsdetailpage'=>array('filter' => FILTER_VALIDATE_URL, 'flags' => FILTER_FORCE_ARRAY | FILTER_FLAG_SCHEME_REQUIRED | FILTER_FLAG_HOST_REQUIRED),
                            'url_linkadsdetailpage'=>array('filter' => FILTER_VALIDATE_URL, 'flags' => FILTER_FORCE_ARRAY | FILTER_FLAG_SCHEME_REQUIRED | FILTER_FLAG_HOST_REQUIRED)
                        );
                        $data = filter_var_array($data, $args);
                        $viewmodel = new MyInfoModel(NULL, 'i');
                        if ($viewmodel->insertAdsBennerDetailPage($data['url_gbradsdetailpage'], $data['url_linkadsdetailpage'])) Messages::setMsg('Successfully update.', 'success', 'Success!');
                        else Messages::setMsg('Failed to update.', 'danger', 'Error!');
                    }
                }
                if(isset($_POST) && !empty($_POST)){
                    $count_row = NULL;
                    if(isset($_POST['count_row'])) $count_row = intval(filter_var($_POST['count_row'], FILTER_VALIDATE_INT));
                    if(!empty($count_row)){
                        $viewmodel = new MyInfoModel(NULL, 'd');
                        $viewmodel->deleteAdsBennerfthomepage();

                        $data = array('url_gbradsfthomepage'=>$_POST['url_gbradsfthomepage'], 'url_linkadsfthomepage'=>$_POST['url_linkadsfthomepage']);
                        $args = array(
                            'url_gbradsfthomepage'=>array('filter' => FILTER_VALIDATE_URL, 'flags' => FILTER_FORCE_ARRAY | FILTER_FLAG_SCHEME_REQUIRED | FILTER_FLAG_HOST_REQUIRED),
                            'url_linkadsfthomepage'=>array('filter' => FILTER_VALIDATE_URL, 'flags' => FILTER_FORCE_ARRAY | FILTER_FLAG_SCHEME_REQUIRED | FILTER_FLAG_HOST_REQUIRED)
                        );
                        $data = filter_var_array($data, $args);
                        $viewmodel = new MyInfoModel(NULL, 'i');
                        if ($viewmodel->insertAdsBennerfthomepage($data['url_gbradsfthomepage'], $data['url_linkadsfthomepage'])) Messages::setMsg('Successfully update.', 'success', 'Success!');
                        else Messages::setMsg('Failed to update.', 'danger', 'Error!');
                    }
                }
                if(isset($_POST) && !empty($_POST)){
                    $count_row = NULL;
                    if(isset($_POST['count_row'])) $count_row = intval(filter_var($_POST['count_row'], FILTER_VALIDATE_INT));
                    if(!empty($count_row)){
                        $viewmodel = new MyInfoModel(NULL, 'd');
                        $viewmodel->deleteAdsBennerslider();

                        $data = array('url_gbrslider'=>$_POST['url_gbrslider'], 'url_linkslider'=>$_POST['url_linkslider']);
                        $args = array(
                            'url_gbrslider'=>array('filter' => FILTER_VALIDATE_URL, 'flags' => FILTER_FORCE_ARRAY | FILTER_FLAG_SCHEME_REQUIRED | FILTER_FLAG_HOST_REQUIRED),
                            'url_linkslider'=>array('filter' => FILTER_VALIDATE_URL, 'flags' => FILTER_FORCE_ARRAY | FILTER_FLAG_SCHEME_REQUIRED | FILTER_FLAG_HOST_REQUIRED)
                        );
                        $data = filter_var_array($data, $args);
                        $viewmodel = new MyInfoModel(NULL, 'i');
                        if ($viewmodel->insertAdsBennerslider($data['url_gbrslider'], $data['url_linkslider'])) Messages::setMsg('Successfully update.', 'success', 'Success!');
                        else Messages::setMsg('Failed to update.', 'danger', 'Error!');
                    }
                }

                if(isset($_POST) && !empty($_POST)){
                    $count_row = NULL;
                    if(isset($_POST['count_row'])) $count_row = intval(filter_var($_POST['count_row'], FILTER_VALIDATE_INT));
                    if(!empty($count_row)){
                        $viewmodel = new MyInfoModel(NULL, 'd');
                        $viewmodel->deleteAdsBennerslidertwo();

                        $data = array('url_gbrslidertwo'=>$_POST['url_gbrslidertwo'], 'url_linkslidertwo'=>$_POST['url_linkslidertwo']);
                        $args = array(
                            'url_gbrslidertwo'=>array('filter' => FILTER_VALIDATE_URL, 'flags' => FILTER_FORCE_ARRAY | FILTER_FLAG_SCHEME_REQUIRED | FILTER_FLAG_HOST_REQUIRED),
                            'url_linkslidertwo'=>array('filter' => FILTER_VALIDATE_URL, 'flags' => FILTER_FORCE_ARRAY | FILTER_FLAG_SCHEME_REQUIRED | FILTER_FLAG_HOST_REQUIRED)
                        );
                        $data = filter_var_array($data, $args);
                        $viewmodel = new MyInfoModel(NULL, 'i');
                        if ($viewmodel->insertAdsBennerslidertwo($data['url_gbrslidertwo'], $data['url_linkslidertwo'])) Messages::setMsg('Successfully update.', 'success', 'Success!');
                        else Messages::setMsg('Failed to update.', 'danger', 'Error!');
                    }
                }

                if(isset($_POST) && !empty($_POST)){
                    $count_row = NULL;
                    if(isset($_POST['count_row'])) $count_row = intval(filter_var($_POST['count_row'], FILTER_VALIDATE_INT));
                    if(!empty($count_row)){
                        $viewmodel = new MyInfoModel(NULL, 'd');
                        $viewmodel->deleteAdsBennerPopup();

                        $data = array('url_gbrpopup'=>$_POST['url_gbrpopup'], 'url_linkspopup'=>$_POST['url_linkspopup']);
                        $args = array(
                            'url_gbrpopup'=>array('filter' => FILTER_VALIDATE_URL, 'flags' => FILTER_FORCE_ARRAY | FILTER_FLAG_SCHEME_REQUIRED | FILTER_FLAG_HOST_REQUIRED),
                            'url_linkspopup'=>array('filter' => FILTER_VALIDATE_URL, 'flags' => FILTER_FORCE_ARRAY | FILTER_FLAG_SCHEME_REQUIRED | FILTER_FLAG_HOST_REQUIRED)
                        );
                        $data = filter_var_array($data, $args);
                        $viewmodel = new MyInfoModel(NULL, 'i');
                        if ($viewmodel->insertAdsBennerPopup($data['url_gbrpopup'], $data['url_linkspopup'])) Messages::setMsg('Successfully update.', 'success', 'Success!');
                        else Messages::setMsg('Failed to update.', 'danger', 'Error!');
                    }
                }
                // END BANNER

           
                $viewmodel = new MyInfoModel;
                $this->registry->template->info_per = $viewmodel->getInfo();
                $this->registry->template->data_product = $viewmodel->getProductHome();
                $this->registry->template->deksripsi_product = $viewmodel->getDeksripsiProduct();
                $this->registry->template->data_magazine = $viewmodel->getMagazineHome();
                $this->registry->template->deksripsi_magazine = $viewmodel->getDeksripsiMagazine();
                $this->registry->template->data_article = $viewmodel->getNewsfeedHome();
                $this->registry->template->deksripsi_article = $viewmodel->getDeksripsiNewsfeed();
                $this->registry->template->data_voucher = $viewmodel->getVoucherHome();
                $this->registry->template->deksripsi_voucher = $viewmodel->getDeksripsiVoucher();
                $this->registry->template->data_specialoffers = $viewmodel->getSpecialOffersHome();
                $this->registry->template->deksripsi_specialoffers = $viewmodel->getDeksripsiSpecialOffers();
                $this->registry->template->data_productrowtwo = $viewmodel->getProductRowTwoHome();
                $this->registry->template->deksripsi_productrowtwo = $viewmodel->getDeksripsiProductRowTwo();
                $this->registry->template->data_magazinerowtwo = $viewmodel->getMagazineRowTwoHome();
                $this->registry->template->deksripsi_magazinerowtwo = $viewmodel->getDeksripsiMagazineRowTwo();
                $this->registry->template->data_articlerowtwo = $viewmodel->getNewsfeedRowTwoHome();
                $this->registry->template->deksripsi_articlerowtwo = $viewmodel->getDeksripsiNewsfeedRowTwo();
                $this->registry->template->data_voucherrowtwo = $viewmodel->getVoucherRowTwoHome();
                $this->registry->template->deksripsi_voucherrowtwo = $viewmodel->getDeksripsiVoucherrowtwo();
                $this->registry->template->data_specialoffersrowtwo = $viewmodel->getSpecialOffersRowTwoHome();
                $this->registry->template->deksripsi_specialoffersrowtwo = $viewmodel->getDeksripsiSpecialOffersrowtwo();
                /*$this->registry->template->bennersadds = $viewmodel->getAdsBenner();
                $this->registry->template->bennersaddsbody = $viewmodel->getAdsBennerBody();
                $this->registry->template->bennersaddsfooter = $viewmodel->getAdsBennerFooter();
                $this->registry->template->bennersaddsside = $viewmodel->getAdsBennerSide();*/

                $this->registry->template->bennersaddsheadertwo = $viewmodel->getAdsBennerHeadertwo();
                $this->registry->template->bennersaddsbodytwo = $viewmodel->getAdsBennerBodytwo();
                $this->registry->template->bennersaddsfootertwo = $viewmodel->getAdsBennerFootertwo();
                
                $this->registry->template->bennersaddsdetailpage = $viewmodel->getAdsBennerDetailPage();
                $this->registry->template->bennersaddsfthomepage = $viewmodel->getAdsBennerfthomepage();
                $this->registry->template->bennersaddsslider = $viewmodel->getAdsBennerslider();
                $this->registry->template->bennersaddsslidertwo = $viewmodel->getAdsBennerslidertwo();
                $this->registry->template->bennersaddspopup = $viewmodel->getAdsBennerPopup();
             

                $this->registry->template->page_title = "Settings - System";
                $this->registry->template->header_title = "Settings";
                $this->registry->template->page_id = $page_id;

                $breadcrumb = array();
                $breadcrumb[0]['str'] = "System";
                $breadcrumb[1]['str'] = "Settings";
                $breadcrumb[1]['active'] = true;
                $this->registry->template->breadcrumb = $breadcrumb;

                $jsSrc = array();
                $jsSrc[0]['type'] = "js";
                $jsSrc[0]['src'] = "assets/js/bundles/TinyMCE-4.7.5/tinymce.min.js";
                $jsSrc[1]['type'] = "js";
                $jsSrc[1]['src'] = "assets/js/bundles/tinymce-init.js";
                $jsSrc[2]['type'] = "js";
                $jsSrc[2]['src'] = 'assets/js/system/form_product_home.js';
                $jsSrc[3]['type'] = "js";
                $jsSrc[3]['src'] = 'assets/js/system/form_magazine_home.js';
                $jsSrc[4]['type'] = "js";
                $jsSrc[4]['src'] = 'assets/js/system/form_article_home.js';
                $jsSrc[5]['type'] = "js";
                $jsSrc[5]['src'] = 'assets/js/system/form_voucher_home.js';
                $jsSrc[6]['type'] = "js";
                $jsSrc[6]['src'] = 'assets/js/system/form_productrowtwo_home.js';
                $jsSrc[7]['type'] = "js";
                $jsSrc[7]['src'] = 'assets/js/system/form_magazinerowtwo_home.js';
                $jsSrc[8]['type'] = "js";
                $jsSrc[8]['src'] = 'assets/js/system/form_articlerowtwo_home.js';
                $jsSrc[9]['type'] = "js";
                $jsSrc[9]['src'] = 'assets/js/system/form_voucherrowtwo_home.js';
                $jsSrc[10]['type'] = "js";
                $jsSrc[10]['src'] = 'assets/js/system/form_specialoffers_home.js';
                $jsSrc[11]['type'] = "js";
                $jsSrc[11]['src'] = 'assets/js/system/form_specialoffersrowtwo_home.js';
                $jsSrc[12]['type'] = "js";
                $jsSrc[12]['src'] = 'assets/js/system/form_adsbenner.js';
                $jsSrc[13]['type'] = "js";
                $jsSrc[13]['src'] = 'assets/js/system/form_adsbennerbody.js';
                $jsSrc[14]['type'] = "js";
                $jsSrc[14]['src'] = 'assets/js/system/form_adsbennerfooter.js';

                $jsSrc[15]['type'] = "js";
                $jsSrc[15]['src'] = 'assets/js/system/form_adsbennerheadertwo.js';
                $jsSrc[16]['type'] = "js";
                $jsSrc[16]['src'] = 'assets/js/system/form_adsbennerbodytwo.js';
                $jsSrc[17]['type'] = "js";
                $jsSrc[17]['src'] = 'assets/js/system/form_adsbennerfootertwo.js';
                $jsSrc[18]['type'] = "js";
                $jsSrc[18]['src'] = 'assets/js/system/form_adsbennerside.js';
                $jsSrc[19]['type'] = "js";
                $jsSrc[19]['src'] = 'assets/js/system/form_adsbennerdetailpage.js';
                $jsSrc[20]['type'] = "js";
                $jsSrc[20]['src'] = 'assets/js/system/form_adsbennerfthomepage.js';
                $jsSrc[21]['type'] = "js";
                $jsSrc[21]['src'] = 'assets/js/system/form_adsbennerslider.js';
                $jsSrc[22]['type'] = "js";
                $jsSrc[22]['src'] = 'assets/js/system/form_adsbennerslidertwo.js';
                $jsSrc[23]['type'] = "js";
                $jsSrc[23]['src'] = 'assets/js/system/form_adspopup.js';
            
                $jsSrc[24]['type'] = "js";
                $jsSrc[24]['src'] = $this->registry->default_js_src;
                $this->registry->template->jsSrc = $jsSrc;

                $this->registry->imageCSP .= " blob:";
                $this->registry->styleCSP .= " 'unsafe-inline'";

                $this->returnView();
            }
            else Redirect::home();
        }
        else Redirect::signin();
    }

    protected function socialMedia(){
        if($this->registry->template->login_check){
            $page_id = '15|4';
            if(UserHelper::checkUserAccess($page_id)) {
                if(isset($_POST) && !empty($_POST)) {
                    $count_row = NULL;
                    if(isset($_POST['count_row'])) $count_row = intval(filter_var($_POST['count_row'], FILTER_VALIDATE_INT));
                    if(!empty($count_row)){
                        $viewmodel = new MyInfoModel(NULL, 'd');
                        $viewmodel->deleteSocialMedia();

                        $data = array('icon'=>$_POST['hid_icon_class'], 'name'=>$_POST['name'], 'url'=>$_POST['url'], 'order'=>$_POST['order']);
                        $args = array(
                            'icon'=>array('filter' => FILTER_SANITIZE_STRING, 'flags' => FILTER_FORCE_ARRAY | FILTER_FLAG_STRIP_LOW | FILTER_FLAG_STRIP_HIGH | FILTER_FLAG_STRIP_BACKTICK),
                            'name'=>array('filter' => FILTER_SANITIZE_STRING, 'flags' => FILTER_FORCE_ARRAY | FILTER_FLAG_STRIP_LOW | FILTER_FLAG_STRIP_HIGH | FILTER_FLAG_STRIP_BACKTICK),
                            'url'=>array('filter' => FILTER_VALIDATE_URL, 'flags' => FILTER_FORCE_ARRAY | FILTER_FLAG_SCHEME_REQUIRED | FILTER_FLAG_HOST_REQUIRED),
                            'order'=>array('filter' => FILTER_VALIDATE_INT, 'flags' => FILTER_FORCE_ARRAY, 'options' => array('min_range' => 0, 'max_range' => 99))
                        );
                        $data = filter_var_array($data, $args);
                        $viewmodel = new MyInfoModel(NULL, 'i');
                        if ($viewmodel->insertSocialMedia($data['icon'], $data['name'], $data['url'], $data['order'])) Messages::setMsg('Successfully update social media.', 'success', 'Success!');
                        else Messages::setMsg('Failed to update social media.', 'danger', 'Error!');
                    }
                }

                $viewmodel = new MyInfoModel;
                $this->registry->template->data_social_media = $viewmodel->getSocialMedia();

                $this->registry->template->page_title = "Social Media - System";
                $this->registry->template->header_title = "Social Media";
                $this->registry->template->page_id = $page_id;

                $breadcrumb = array();
                $breadcrumb[0]['str'] = "System";
                $breadcrumb[1]['str'] = "Social Media";
                $breadcrumb[1]['active'] = true;
                $this->registry->template->breadcrumb = $breadcrumb;

                $cssSrc = array();
                $cssSrc[0]['type'] = "css";
                $cssSrc[0]['src'] = "https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css";
                $cssSrc[1]['type'] = "css";
                $cssSrc[1]['src'] = "assets/css/fontawesome-iconpicker/fontawesome-iconpicker.min.css";
                $this->registry->template->cssSrc = $cssSrc;

                $jsSrc = array();
                $jsSrc[0]['type'] = "js";
                $jsSrc[0]['src'] = 'assets/js/bundles/fontawesome-iconpicker/fontawesome-iconpicker.min.js';
                $jsSrc[1]['type'] = "js";
                $jsSrc[1]['src'] = $this->registry->default_js_src;
                $this->registry->template->jsSrc = $jsSrc;

                $this->registry->fontCSP .= " https://cdnjs.cloudflare.com";
                $this->registry->styleCSP .= " https://cdnjs.cloudflare.com";
                $this->returnView();
            }
            else Redirect::home();
        }
        else Redirect::signin();
    }
}
?>