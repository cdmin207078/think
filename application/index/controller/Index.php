<?php
namespace app\index\controller;

use think\View;
use think\Db;

class Index
{
    public function index()
    {
        echo __DIR__, '<br />';    
        echo ROOT_PATH, '<br />';
        echo APP_PATH, '<br />';
        echo THINK_PATH, '<br />';
        echo EXTEND_PATH, '<br />';
        echo VENDOR_PATH, '<br />';

        echo config('app_name'), '<br />';
        echo config('app_author'), '<br />';
        echo dump(config('app_description')), '<br />';
        

        echo dump(config('app_foo')),'<br />';

        config('app_foo','bar');
        
        echo dump(config('app_foo')),'<br />';
        
        return '<h1>Hello ThinkPHP - 5</h1>';
        // return '<style type="text/css">*{ padding: 0; margin: 0; } .think_default_text{ padding: 4px 48px;} a{color:#2E5CD5;cursor: pointer;text-decoration: none} a:hover{text-decoration:underline; } body{ background: #fff; font-family: "Century Gothic","Microsoft yahei"; color: #333;font-size:18px} h1{ font-size: 100px; font-weight: normal; margin-bottom: 12px; } p{ line-height: 1.6em; font-size: 42px }</style><div style="padding: 24px 48px;"> <h1>:)</h1><p> ThinkPHP V5<br/><span style="font-size:30px">十年磨一剑 - 为API开发设计的高性能框架</span></p><span style="font-size:22px;">[ V5.0 版本由 <a href="http://www.qiniu.com" target="qiniu">七牛云</a> 独家赞助发布 ]</span></div><script type="text/javascript" src="http://tajs.qq.com/stats?sId=9347272" charset="UTF-8"></script><script type="text/javascript" src="http://ad.topthink.com/Public/static/client.js"></script><thinkad id="ad_bd568ce7058a1091"></thinkad>';
    }

    function hello($name='') {

        var_dump($name);
        dump($name);
        if(empty($name)) {
            echo '<h1>请输入姓名</h1>';
        } else {
            echo '<h1>hello, ', $name, '</h1>';
        }
    }

    function get_data() {
        $ret = [
            'id'    =>  1,
            'name'  =>  '陈宁',
            'sex'   =>  '男',
            'age'   =>  28,
            'fav'   => ['coding','music','PING-PONG'],
        ];

        return $ret;
    }

    private function get_posts($key='') {
        // $ret = Db::table('sys_admin');
        $ret = db('sys_admin');

        if(!empty($key)) {
            $ret = $ret->where('account','like','%'.$key.'%')
                       ->whereOr('email','like','%'.$key.'%')
                       ->whereOr('cellphone','like','%'.$key.'%');   
        }

        $ret = $ret->select();

        return $ret;
    }


    function admins() {

        $vm = [
            'UserInfo'    => $this->get_data(),
            'Admins'       => $this->get_posts()
        ];

        $view = new View();

        return $view->fetch('sun',$vm);

        // $data['id'] = 1;
        // $data['name'] = '陈宁';
        // $data['info'] = [
        //     'age' => 28,
        //     'sex' => '男'
        // ];

        return view('sun',$data);

        // return view('sun',[
        //     'id'            => '1',
        //     'info'          => [
        //         'name'  => 'cn',
        //         'age'   => '29',
        //         'sex'   => 'male'
        //     ],
        //     'name'          => '小哪吒'
        // ]);
    }

    function ajax_search_post($key='') {
        $ret = $this->get_posts($key);

        return $ret;
    }
}
