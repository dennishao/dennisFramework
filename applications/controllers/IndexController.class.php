<?php

class IndexController extends Controller
{
    public function mainAction()
    {

        //main方法

    }

    public function indexAction()
    {
        //实例化Index模型
        $indexModel = new IndexModel();
        //调用模型类中的getModel方法
        $model = $indexModel->getModel();

        //引入测试类库
        $this->load->library("testLibrary");
        $library = testLibrary::getLibrary();

        //引入测试helper文件
        $this->load->helper("testHelper");
        $heler=getHelper();

        $data['helper']=$heler;
        $data['library'] = $library;
        $data['model'] = $model;
        $data['welcome'] = "这里是首页";
        $this->redirect("index.html", $data);

        //include CURR_VIEW_PATH . "index.html";

    }

}