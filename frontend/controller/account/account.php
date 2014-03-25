<?php
	class ControllerAccountAccount extends Controller {
		protected $error = array();

		public function index() {
			$this->language->load("account/account");
			$this->load->model("user/user");
			// Check if user not authorized
			if(!$this->user->signedIn()) {
				$this->session->data['warning'] = $this->langauge->get("error_signedin");
				$this->response->redirect($this->url->link("account/account/signin"));
			}
			// Handle form
			if($this->request->server["REQUEST_METHOD"] == "POST" && $this->validate()) {
				echo '<pre>'; print_r($this->request->post); echo '</pre>';exit;
			}
			$userData = $this->model_user_user->getUserData($this->user->get("user_id"));
			$this->document->setTitle(sprintf($this->language->get("heading_account"), $userData["username"]));
			// Users list
			$this->data["users"] = $this->model_user_user->getUsersList($this->user->get("user_id"));
			// Form
			$this->data["action"] = $this->url->link("account/account");
			// Form labels
			$this->data["label_username"]			= $this->language->get("label_username");
			$this->data["label_password"] 			= $this->language->get("label_password");
			$this->data["label_password_confirm"]	= $this->language->get("label_password_confirm");
			$this->data["label_friends"]			= $this->language->get("label_friends");
			$this->data["label_submit"]				= $this->language->get("label_submit");
			$this->data["label_email"]				= $this->language->get("label_email");
			// Form values
			$this->data["username"] = $userData["username"];
			$this->data["email"]    = isset($this->request->post["email"]) ? $this->request->post["email"] : $userData["email"];
			$this->data["friends"]  = isset($this->request->post["friends"]) ? $this->request->post["friends"] : $userData["friends"];
			$this->data["password"] = "";
			$this->data["password_confirm"] = "";
			$this->data["created_at"]	= $userData["created_at"];
			// Form validates
			$this->data["valid_email"]    = isset($this->error["email"]) ? $this->error["email"] : false;
			$this->data["valid_password"] = isset($this->error["password"]) ? $this->error["password"] : false;
			$this->data["valid_password_confirm"] = isset($this->error["password_confirm"]) ? $this->error["password_confirm"] : false;
			// Rendering...
			if (file_exists(DIR_TEMPLATE . $this->config->get('config_template') . '/template/account/account.tpl'))
				$this->template = $this->config->get('config_template') . '/template/account/account.tpl';
			else
				$this->template = 'default/template/account/account.tpl';
			$this->children = array("common/header", "common/column_left", "common/footer");
			$this->response->setOutput($this->render());
		}
		public function signup() {
			$this->load->language("account/account");
			$this->load->model("user/user");

			$this->checkUserSession();

			if($this->request->server["REQUEST_METHOD"] == "POST" && $this->validateSignUp()) {
				$this->model_user_user->createNewUser($this->request->post, $this->request->server["REMOTE_ADDR"]);
				$this->session->data['success'] = $this->language->get("success_signup");
				if(isset($this->request->post["signin"]))
					$this->user->signIn($this->request->post["username"], $this->request->post["password"]);
				$this->response->redirect($this->url->link("common/home"));
			}

			$this->document->setTitle($this->language->get("heading_signup"));
			// Form data
			$this->data["email"] = isset($this->request->post["email"]) ? $this->request->post["email"] : '';
			$this->data["username"]	= isset($this->request->post["username"]) ? $this->request->post["username"] : "";
			$this->data["password"] = "";
			$this->data["signin"] = isset($this->request->post["signin"]) ? true : false;
			// Form action
			$this->data["action"] = $this->url->link("account/account/signup");
			// Form labels
			$this->data["label_username"] = $this->language->get("label_username");
			$this->data["label_email"] = $this->language->get("label_email");
			$this->data["label_password"] = $this->language->get("label_password");
			$this->data["label_password_confirm"] = $this->language->get("label_password_confirm");
			$this->data["label_signin"] = $this->language->get("label_signin");
			$this->data["submit"] = $this->language->get("label_submit");
			// Form placeholders
			$this->data["placeholder_username"] = $this->language->get("placeholder_username");
			$this->data["placeholder_email"] = $this->language->get("placeholder_email");
			$this->data["placeholder_password"] = $this->language->get("placeholder_password");
			$this->data["placeholder_password_confirm"] = $this->language->get("placeholder_password_confirm");
			// Form info
			$this->data["info_username"] = $this->language->get("info_username");
			$this->data["info_email"] = $this->language->get("info_email");
			$this->data["info_password"] = $this->language->get("info_password");
			$this->data["info_password_confirm"] = $this->language->get("info_password_confirm");
			// Form validation error
			if($this->error)
				$this->session->data["warning"] = $this->language->get("error_form");
			$this->data['valid_username'] = isset($this->error["username"]) ? $this->error["username"] : "";
			$this->data['valid_email'] = isset($this->error["email"]) ? $this->error["email"] : "";
			$this->data['valid_password'] = isset($this->error["password"]) ? $this->error["password"] : "";
			$this->data['valid_password_confirm'] = isset($this->error["password_confirm"]) ? $this->error["password_confirm"] : "";
			// Rendering...
			if (file_exists(DIR_TEMPLATE . $this->config->get('config_template') . '/template/account/signup.tpl'))
				$this->template = $this->config->get('config_template') . '/template/account/signup.tpl';
			else
				$this->template = 'default/template/account/signup.tpl';
			$this->children = array("common/header", "common/column_left", "common/footer");
			$this->response->setOutput($this->render());
		}
		public function signin() {
			$this->load->language("account/account");
			$this->load->model("user/user");

			$this->checkUserSession();

			if($this->request->server["REQUEST_METHOD"] == "POST" && $this->validateSignIn()) {
				$this->session->data['success'] = $this->language->get("success_signin");
				$this->response->redirect($this->url->link("common/home"));
			}
			$this->document->setTitle($this->language->get("heading_signin"));
			// Form
			$this->data["action"] = $this->url->link("account/account/signin");
			// Form labels
			$this->data["label_username"] = $this->language->get("label_username");
			$this->data["label_password"] = $this->language->get("label_password");
			$this->data["label_submit"]   = $this->language->get("label_submit");
			// Form placeholders
			$this->data["placeholder_username"] = $this->language->get("placeholder_username");
			$this->data["placeholder_password"] = $this->language->get("placeholder_password");
			// Form values
			$this->data["username"] = isset($this->request->post["username"]) ? $this->request->post["username"] : "";
			$this->data['password'] = "";
			// Form validates
			if($this->error)
				$this->session->data['warning'] = $this->error["warning"];
			// Rendering...
			if (file_exists(DIR_TEMPLATE . $this->config->get('config_template') . '/template/account/signin.tpl'))
				$this->template = $this->config->get('config_template') . '/template/account/signin.tpl';
			else
				$this->template = 'default/template/account/signin.tpl';
			$this->children = array("common/header", "common/column_left", "common/footer");
			$this->response->setOutput($this->render());
		}

		public function signout() {
			$this->user->signOut();
			$this->response->redirect($this->url->link("common/home"));
		}

		private function validateSignIn() {
			if(!isset($this->request->post["username"]) || !isset($this->request->post["password"]) || !$this->user->signIn($this->request->post["username"], $this->request->post["password"]))
				$this->error["warning"] = $this->language->get("error_signin");
			return ($this->error) ? false : true;
		}

		private function validateSignUp() {
			if(!isset($this->request->post["username"]) || !preg_match("/\w{4,64}/i", $this->request->post["username"]) || $this->model_user_user->usernameExists($this->request->post["username"]))
				$this->error["username"] = $this->language->get("error_username");
			if(!isset($this->request->post["email"]) || !preg_match("/\w+@\w+\.[a-z]+(\.[a-z]{1,4})?/i", $this->request->post["email"]) || $this->model_user_user->emailExists($this->request->post["email"]))
				$this->error["email"] = $this->language->get("error_email");;
			if(!isset($this->request->post["password"]) || !preg_match("/.{8,64}/i", $this->request->post["password"]))
				$this->error["password"] = $this->language->get("error_password");;
			if(!isset($this->request->post["password_confirm"]) || $this->request->post["password_confirm"] != $this->request->post["password"])
				$this->error["password_confirm"] = $this->language->get("error_password_confirm");;
			return ($this->error) ? false : true;
		}
		private function checkUserSession() {
			if($this->user->signedIn()) {
				$this->session->data["notice"] = $this->language->get("error_signedin");
				$this->response->redirect($this->url->link("common/home"));
			}
		}
		private function validate() {

		}
	}
?>