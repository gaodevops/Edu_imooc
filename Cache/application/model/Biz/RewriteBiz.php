<?php
/**
 * 把数据生成对应的静态文件，
 * Created by PhpStorm.
 * User: mail
 * Date: 2018/3/5
 * Time: 18:25
 */

namespace app\model\Biz;


class RewriteBiz
{

    /**
     * 将传入的json格式生成对应的折腾文件，
     * @param $json
     */
    public function ToJson($json)
    {
        return file_put_contents(SITE_PATH.'/public/json/banner.json',$json);
    }


    /**
     * 将传送过来的，array生成html文件，
     * @param $type
     * @param $html
     */
    public function ToHtml($type , $data){

        if ('channel' == $type){

//            1.通过数组来取到对应的四个模块的html，
            $html_part = $this->GetChannelPart($data);
//            2.取到整页面的html模板，
            $html_template = file_get_contents(SITE_PATH.'/public/template/channel.html');
//            3.将四个栏目替换到模板的对应位置，
            $res_html = str_replace('<{channel_list}>' ,$html_part,$html_template);
//            4.将合成后的html生成为静态文件，
             $file = fopen(SITE_PATH.'/public/channel/channel.html','w') or die ('Unable to openFile!');
             $res = fwrite($file,$res_html);
             fclose($file);
             if ($res) {
                 return true;
             }else{
                 return false;
             }



        }
//        .......

    }

    /**
     * 接收频道取得的数据，并转换成html，
     * @param $data
     */
    public function GetChannelPart($data ,$i = 1){
        $html = file_get_contents(SITE_PATH.'/public/template/channel_part.html');
        $res_html = '';
        foreach ($data as $channel_data) {
            $part_html = $html;
            $part_sub_channel = $part_goods =$part_goods_foot =$part_brand =  '';
            $part_html = str_replace('<{i}>',$i,$part_html);
            $part_html = str_replace('<{channel_title}>',$channel_data['Info']['title'],$part_html);
            //子栏目部分，
            foreach ($channel_data['SubChannel'] as $sub_channel) {
                $part_sub_channel .= "<li><a href=\"".$sub_channel['url']."\">".$sub_channel['title']."</a></li>";
            }
            $part_html =  str_replace('<{channel_link}>',$part_sub_channel,$part_html);

            //商品部分，
            $part_html = str_replace('<{main_goods}>','<a href="'.$channel_data['Goods'][1][0]['url'].'"><img src="'.$channel_data['Goods'][1][0]['pic_url'].'"></a>',$part_html);

            //小商品部分，
            foreach ($channel_data['Goods'][2] as $good) {
                $part_goods .=   '<li><a href="'.$good['url'].'"><p>'.$good['title'].'</p><p>'.$good['subtitle'].'</p><img src="'.$good['pic_url'].'"></a></li>';
            }
            $part_html =  str_replace('<{four_goods}>',$part_goods,$part_html);

            //小商品部分，
            foreach ($channel_data['Goods'][3] as $good) {
                $part_goods_foot .=   '<li><a href="'.$good['url'].'"><p>'.$good['title'].'</p><p>'.$good['subtitle'].'</p><img src="'.$good['pic_url'].'"></a></li>';
            }
            $part_html =  str_replace('<{foot_goods}>',$part_goods_foot,$part_html);

            //品牌，，
            foreach ($channel_data['Brand'] as $good) {
                $part_brand .=   '<li><a href="'.$good['url'].'"><img src="'.$good['pic_url'].'"></a></li>';
            }
            $part_html =  str_replace('<{brands}>',$part_brand,$part_html);



            $res_html .=$part_html;
            $i++;
        }

        return $res_html;

    }



}