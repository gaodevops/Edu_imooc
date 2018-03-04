<?php
/**
 * Created by PhpStorm.
 * User: wangweiqiang
 * Date: 2018/3/4
 * Time: 上午11:17
 */

namespace app\common\Biz;


class RewriteBiz
{

    public function ToHtml($type,$data)
    {

        //  变量在后， 如果少了一个等号则会报错。减少错误机率
        if ('channel' == $type) {
            $html_part = $this -> GetChannelPartHtml('channel',$data);

            $html = file_get_contents(SITE_PATH.'/template/channel.html');
            $html = str_replace('<{lovelife}>',$html_part,$html );


            return file_put_contents(SITE_PATH.'/channel/channel.html',$html);
        }
    }


    public function GetChannelPartHtml($type,$data){

            $html = '';
            $i = 1;
            foreach ($data as $key => $val) {
                $html_part = $sub_channel_part = $sub_brands_part = $four_goods = $foot_goods = '';
                $html_part = file_get_contents(SITE_PATH.'/template/channel_part.html');

                $html_part = str_replace('<{i}>',$i,$html_part );
                $html_part = str_replace('<{channel_title}>',$val['Info']['title'],$html_part );
                foreach ($val['SubChannel'] as $m => $n) {
                    $sub_channel_part .= ' <li><a href="'.$n['url'].'">'.$n['title'].'</a></li>';
                }
                $html_part = str_replace('<{channel_link}>',$sub_channel_part,$html_part );



                $html_part = str_replace('<{main_goods}>','<a href="'.$val['Goods'][1][0]['url'].'"><img src="'.$val['Goods'][1][0]['pic_url'].'"></a>',$html_part );


                foreach ($val['Goods'][2] as $m => $n) {
                    $four_goods .= ' <li><a href="'.$n['url'].'"><p>'.$n['title'].'</p><p>'.$n['subtitle'].'</p><img src="'.$n['pic_url'].'"></a></li>';
                }
                $html_part = str_replace('<{four_goods}>',$four_goods,$html_part );


                foreach ($val['Goods'][3] as $m => $n) {
                    $foot_goods .= ' <li><a href="'.$n['url'].'"><img src="'.$n['pic_url'].'"></a></li>';
                }
                $html_part = str_replace('<{foot_goods}>',$foot_goods,$html_part );


                foreach ($val['Brand'] as $m => $n) {
                    $sub_brands_part .= ' <li><a href="'.$n['url'].'"><img src="'.$n['pic_url'].'"></a></li>';
                }
                $html_part = str_replace('<{brands}>',$sub_brands_part,$html_part );

                $i++;
                $html .=$html_part;
            }
            return $html;

//
//            <{i}>
//            <{channel_title}>
//            <{channel_link}>              <li><a href="#">保暖羽绒</a></li>
//            <{main_goods}> <a href="#"><img src="/img/lovelife/lovelife-list-content-leimg-img1.jpg"></a>
//            <{four_goods}>  *4
//                <li>
//                    <a href="#">
//                        <p>型男衣橱</p>
//                        <p>抢大额神券</p>
//                        <img src="/img/lovelife/lovelife-list-content-riimg-img1.jpg">
//                    </a>
//                </li>
//
//            <{foot_goods}> *3
//                <li>
//                    <a href="#">
//                        <img src="/img/lovelife/lovelife-list-content-mdimg-img1.jpg">
//                    </a>
//                </li>
//
//
//             <{brands}> *6
//                <li>
//                    <a href="#"><img src="/img/lovelife/smimg/loveshopping/img1.jpg"></a>
//                </li>

    }
}