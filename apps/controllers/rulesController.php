<?php 
class rulesController extends Controller {
    public function index()
    {
        $data['user'] = $_SESSION['user_id'];
        $data['rules'] = $this->model('Rule')->getAllRules();

        $this->view('layouts/header', $data);
        $this->view('pages/rules/index', $data);
        $this->view('layouts/footer');
    }

    public function show($id)
    {
        $data['rules'] = $this->model('Rule')->getRuleById($id);
        $data['rule_details'] = $this->model('RuleDetail')->getRules($id);

        $this->view('pages/rules/show', $data);
    }

    public function update()
    {
        if ($this->model('RuleDetail')->update(json_decode($_POST['data'])) > 0) {
            echo true;
        }
    }
}