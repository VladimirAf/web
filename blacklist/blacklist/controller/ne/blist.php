<?php

class ControllerNeBlist extends Controller
{
    private $error = array();

    public function index()
    {
        $this->load->language('ne/blist');

        $this->document->setTitle($this->language->get('heading_title'));

        $this->load->model('ne/blist');

        if (isset($this->request->get['filter_email'])) {
            $filter_email = $this->request->get['filter_email'];
        } else {
            $filter_email = null;
        }

        if (isset($this->request->get['filter_date'])) {
            $filter_date = $this->request->get['filter_date'];
        } else {
            $filter_date = null;
        }

        if (isset($this->request->get['sort'])) {
            $sort = $this->request->get['sort'];
        } else {
            $sort = 'datetime';
        }

        if (isset($this->request->get['order'])) {
            $order = $this->request->get['order'];
        } else {
            $order = 'ASC';
        }

        if (isset($this->request->get['page'])) {
            $page = $this->request->get['page'];
        } else {
            $page = 1;
        }

        $url = '';

        if (isset($this->request->get['filter_email'])) {
            $url .= '&filter_email=' . $this->request->get['filter_email'];
        }

        if (isset($this->request->get['filter_date'])) {
            $url .= '&filter_date=' . $this->request->get['filter_date'];
        }

        if (isset($this->request->get['sort'])) {
            $url .= '&sort=' . $this->request->get['sort'];
        }

        if (isset($this->request->get['order'])) {
            $url .= '&order=' . $this->request->get['order'];
        }

        if (isset($this->request->get['page'])) {
            $url .= '&page=' . $this->request->get['page'];
        }

        $data_params = array(
            'filter_email' => $filter_email,
            'filter_date' => $filter_date,
            'sort' => $sort,
            'order' => $order,
            'start' => ($page - 1) * $this->config->get('config_limit_admin'),
            'limit' => $this->config->get('config_limit_admin')
        );

        $blist_total = $this->model_ne_blist->getTotal($data_params);

        $data['blisted'] = array();

        $results = $this->model_ne_blist->getList($data_params);

        foreach ($results as $result) {
            $data['blisted'][] = array_merge($result, array('selected' => isset($this->request->post['selected']) && is_array($this->request->post['selected']) && in_array($result['blist_id'], $this->request->post['selected'])));
        }
        unset($result);

        $data['heading_title'] = $this->language->get('heading_title');

        $data['text_no_results'] = $this->language->get('text_no_results');
        $data['text_add_info'] = $this->language->get('text_add_info');
        $data['text_blisted_emails'] = $this->language->get('text_blisted_emails');

        $data['column_email'] = $this->language->get('column_email');
        $data['column_date'] = $this->language->get('column_date');

        $data['button_insert'] = $this->language->get('button_insert');
        $data['button_filter'] = $this->language->get('button_filter');
        $data['button_delete'] = $this->language->get('button_delete');

        $data['token'] = $this->session->data['token'];

        $data['action'] = $this->url->link('ne/blist/add', 'token=' . $this->session->data['token'], true);
        $data['delete'] = $this->url->link('ne/blist/delete', 'token=' . $this->session->data['token'] . $url, true);

        if (isset($this->error['warning'])) {
            $data['error_warning'] = $this->error['warning'];
        } else {
            $data['error_warning'] = $this->config->get('ne_warning');
        }

        if (isset($this->session->data['success'])) {
            $data['success'] = $this->session->data['success'];

            unset($this->session->data['success']);
        } else {
            $data['success'] = '';
        }

        $url = '';

        if (isset($this->request->get['filter_email'])) {
            $url .= '&filter_email=' . $this->request->get['filter_email'];
        }

        if (isset($this->request->get['filter_date'])) {
            $url .= '&filter_date=' . $this->request->get['filter_date'];
        }

        if ($order == 'ASC') {
            $url .= '&order=' . 'DESC';
        } else {
            $url .= '&order=' . 'ASC';
        }

        if (isset($this->request->get['page'])) {
            $url .= '&page=' . $this->request->get['page'];
        }

        $data['sort_email'] = $this->url->link('ne/blist', 'token=' . $this->session->data['token'] . '&sort=email' . $url, true);
        $data['sort_date'] = $this->url->link('ne/blist', 'token=' . $this->session->data['token'] . '&sort=datetime' . $url, true);

        $url = '';

        if (isset($this->request->get['filter_email'])) {
            $url .= '&filter_email=' . $this->request->get['filter_email'];
        }

        if (isset($this->request->get['filter_date'])) {
            $url .= '&filter_date=' . $this->request->get['filter_date'];
        }

        if (isset($this->request->get['sort'])) {
            $url .= '&sort=' . $this->request->get['sort'];
        }

        if (isset($this->request->get['order'])) {
            $url .= '&order=' . $this->request->get['order'];
        }

        if (isset($this->request->post['selected'])) {
            $data['selected'] = (array)$this->request->post['selected'];
        } else {
            $data['selected'] = array();
        }

        $pagination = new Pagination();
        $pagination->total = $blist_total;
        $pagination->page = $page;
        $pagination->limit = $this->config->get('config_limit_admin');
        $pagination->url = $this->url->link('ne/blist', 'token=' . $this->session->data['token'] . $url . '&page={page}', true);

        $data['pagination'] = $pagination->render();

        $data['results'] = sprintf($this->language->get('text_pagination'), ($blist_total) ? (($page - 1) * $this->config->get('config_limit_admin')) + 1 : 0, ((($page - 1) * $this->config->get('config_limit_admin')) > ($blist_total - $this->config->get('config_limit_admin'))) ? $blist_total : ((($page - 1) * $this->config->get('config_limit_admin')) + $this->config->get('config_limit_admin')), $blist_total, ceil($blist_total / $this->config->get('config_limit_admin')));

        $data['filter_email'] = $filter_email;
        $data['filter_date'] = $filter_date;

        $data['sort'] = $sort;
        $data['order'] = $order;

        $data['header'] = $this->load->controller('common/header');
        $data['column_left'] = $this->load->controller('common/column_left');
        $data['footer'] = $this->load->controller('common/footer');

        $this->response->setOutput($this->load->view('ne/blist.tpl', $data));
    }

    public function add()
    {
        $this->load->language('ne/blist');
        $this->load->model('ne/blist');

        $url = '';

        if (isset($this->request->get['filter_email'])) {
            $url .= '&filter_email=' . $this->request->get['filter_email'];
        }

        if (isset($this->request->get['filter_date'])) {
            $url .= '&filter_date=' . $this->request->get['filter_date'];
        }

        if (isset($this->request->get['sort'])) {
            $url .= '&sort=' . $this->request->get['sort'];
        }

        if (isset($this->request->get['order'])) {
            $url .= '&order=' . $this->request->get['order'];
        }

        if (isset($this->request->get['page'])) {
            $url .= '&page=' . $this->request->get['page'];
        }

        if (isset($this->request->post['emails'])) {
            $count = $this->model_ne_blist->add($this->request->post);
            $this->session->data['success'] = sprintf($this->language->get('text_success'), $count);
        }

        $this->response->redirect($this->url->link('ne/blist', 'token=' . $this->session->data['token'] . $url, true));
    }

    public function delete()
    {
        $this->load->language('ne/blist');
        $this->load->model('ne/blist');

        $url = '';

        if (isset($this->request->get['filter_email'])) {
            $url .= '&filter_email=' . $this->request->get['filter_email'];
        }

        if (isset($this->request->get['filter_date'])) {
            $url .= '&filter_date=' . $this->request->get['filter_date'];
        }

        if (isset($this->request->get['sort'])) {
            $url .= '&sort=' . $this->request->get['sort'];
        }

        if (isset($this->request->get['order'])) {
            $url .= '&order=' . $this->request->get['order'];
        }

        if (isset($this->request->get['page'])) {
            $url .= '&page=' . $this->request->get['page'];
        }

        if (isset($this->request->post['selected']) && $this->validate()) {
            foreach ($this->request->post['selected'] as $blist_id) {
                $this->model_ne_blist->delete($blist_id);
            }

            $this->session->data['success'] = $this->language->get('text_success_delete');
        }

        $this->response->redirect($this->url->link('ne/blist', 'token=' . $this->session->data['token'] . $url, true));
    }

    private function validate()
    {
        if (!$this->user->hasPermission('modify', 'ne/blist')) {
            $this->error['warning'] = $this->language->get('error_permission_delete');
        }

        return !$this->error;
    }
}