<?php
	class ControllerAccountAccount extends Controller {
		protected $error = array();

		public function index() {

		}
		public function signup() {
			$this->load->language("account/account");
			$this->load->model("user/user");

			if($this->request->server["REQUEST_METHOD"] == "POST" && $this->validateSignUp()) {
				$this->model_user_user->createNewUser($this->request->post, $this->request->server["REMOTE_ADDR"]);
				$this->session->data['success'] = $this->language->get("success_signup");
				$this->response->redirect($this->url->link("common/home"));
			}

			$this->document->setTitle($this->language->get("heading_title"));
			// Form data
			$this->data["email"] = isset($this->request->post["email"]) ? $this->request->post["email"] : '';
			$this->data["username"]	= isset($this->request->post["username"]) ? $this->request->post["username"] : "";
			$this->data["password"] = "";
			// Form action
			$this->data["action"] = $this->url->link("account/account/signup");
			// Form labels
			$this->data["label_username"] = $this->language->get("label_username");
			$this->data["label_email"] = $this->language->get("label_email");
			$this->data["label_password"] = $this->language->get("label_password");
			$this->data["label_password_confirm"] = $this->language->get("label_password_confirm");
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

		}

		private function validateSignUp() {
			if(!isset($this->request->post["username"]) || !preg_match("/\w{4,64}/i", $this->request->post["username"]) || $this->model_user_user->usernameExists($this->request->post["username"]))
				$this->error["username"] = $this->language->get("error_username");
			if(!isset($this->request->post["email"]) || !preg_match("/\w+@\w+\.[a-z]+(\.[a-z]{1,4})?/i", $this->request->post["email"]) || $this->model_user_user->emailExists($this->request->post["email"]))
				$this->error["email"] = $this->language->get("error_email");;
			if(!isset($this->request->post["password"]) || !preg_match("/.{8,64}/i", $this->request->post["password"]))
				$this->error["password"] = $this->language->get("error_password");;
			if(!isset($this->request->post["passowrd_confirm"]) || $this->request->post["password"] != $this->request->post["password"])
				$this->error["password_confirm"] = $this->language->get("error_password_confirm");;
			return ($this->error) ? false : true;
		}
	}
?>