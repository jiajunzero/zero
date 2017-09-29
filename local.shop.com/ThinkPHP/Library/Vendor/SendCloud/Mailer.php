<?php

/**
 * Class QQMailer
 * @package App\Mailer
 */
class Mailer {

    protected $url = 'http://api.sendcloud.net/apiv2/mail/sendtemplate';

    /**
     * @param $email
     * @param $token
     * @return string
     */
    protected function sendTo($to, $subject, $view, $data = [])
    {
        $vars = json_encode(['to' => [$to], 'sub' => $data]);
        $param = [
            # 使用api_user和api_key进行验证
            'apiUser'            => 'jiajunzero_test_9xPdRa', 
            'apiKey'             => 'LtrbS27b2kjEMde7',
            # 发信人，用正确邮件地址替代
            'from'               => 'jiajunzero@163.com', 
            'fromName'           => 'jiajunzero',
            
            'xsmtpapi'           => $vars, // 模板中的变量
            'subject'            => $subject, // 模板主题
            'templateInvokeName' => $view, // 模板名称
            'respEmailId'        => 'true'
        ];

        $sendData = http_build_query($param);
        $options = [
            'http' => [
                'method'  => 'POST',
                'header'  => 'Content-Type: application/x-www-form-urlencoded',
                'content' => $sendData
            ]];
        $context = stream_context_create($options);
        
        return json_decode( file_get_contents($this->url, FILE_TEXT, $context), true );
    }
    
    public function welcome($to, $data = [])
    {
        $subject = 'php25期欢迎您注册'; // 邮件主题
        $view = 'active'; // 我们在sencloud定义的模板（邮件的内容里面使用该模板进行内容展示 ，模板里面存在很多的占位符，可以用户自己去定义）
        $data = [
            '%name%' => [$data['name']],
            '%url%' => [$data['url']], 
            '%time%' => [$data['time']]
        ];
        return $this->sendTo($to, $subject, $view, $data);
    }

}

/**
 * 测试代码
 */

// $mail = new Mailer();
// $data = [
//     'name' => 'caoyang',
//     'url' => 'http://www.woaikaifa.com', 
//     'time' => date('Y-m-d H:i:s')
// ];
// $userEmail = '2298535141@qq.com';
// $result = $mail->welcome($userEmail, $data);
