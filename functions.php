<?php
if (!defined('__TYPECHO_ROOT_DIR__')) exit;
require_once __DIR__ . '/lib/shortcode.lib.php';

function themeConfig($form) {
    $homeTitle = new Typecho_Widget_Helper_Form_Element_Text('homeTitle', NULL, NULL, _t('站点主页标题'), _t('仅用于主页上的标题显示，不填写的话默认使用 设置->基本 中的站点名称'));
    $form->addInput($homeTitle);
    $homeDesc = new Typecho_Widget_Helper_Form_Element_Text('homeDesc', NULL, NULL, _t('站点主页描述'), _t('仅用于主页上的描述显示，不填写的话默认使用 设置->基本 中的站点描述'));
    $form->addInput($homeDesc);
    $logoUrl = new Typecho_Widget_Helper_Form_Element_Text('logoUrl', NULL, NULL, _t('站点LOGO地址'), _t('在这里填入一个图片URL地址, 以在网站标题前加上一个LOGO'));
    $form->addInput($logoUrl);
    $bannerBGUrl = new Typecho_Widget_Helper_Form_Element_Text('bannerBGUrl', NULL, NULL, _t('首页头图地址'), _t('在这里填入一个图片的URL地址, 以在网站显示你的首页头图'));
    $form->addInput($bannerBGUrl);
    $socialQQ = new Typecho_Widget_Helper_Form_Element_Text('socialQQ', NULL, NULL, _t('QQ号'), _t('填写QQ号以展示联系方式'));
    $form->addInput($socialQQ);
    $socialGithubUrl = new Typecho_Widget_Helper_Form_Element_Text('socialGithubUrl', NULL, NULL, _t('Github地址'), _t('填写Github地址以展示联系方式'));
    $form->addInput($socialGithubUrl);
    $socialEmail = new Typecho_Widget_Helper_Form_Element_Text('socialEmail', NULL, NULL, _t('Email'), _t('填写Email以展示联系方式'));
    $form->addInput($socialEmail);
}

class Service {
    /**
     * 获取文章自定义字段[thumbnail]指定图片或首个文章图片
     * @param $post 文章对象
     */
    public static function get_postthumb($post) {
        $thumb = $post->fields->thumbnail;
        if(!$thumb) {
            preg_match_all( "/<[img|IMG].*?src=[\'|\"](.*?)[\'|\"].*?[\/]?>/", $post->content, $matches);
            if(count($matches[1]) > 0) {
                $thumb = $matches[1][0];
            }
        }
        return $thumb;
    }

    /**
     * 短代码 - 友情链接
     */
    public static function shortcode_friends( $atts, $content = '' ) {
        $args = shortcode_atts( array(
            'random' => 'true'
        ), $atts );
        if ( !preg_match_all( "/\[(link)\b(.*?)(?:(\/))?\](?:(.+?)\[\/link\])/s", $content, $matches, PREG_SET_ORDER ) ) {
            return do_shortcode( $content );
        } else {
            if ($args['random'] === 'true') {
                shuffle($matches);
            }
            $out = '<div class="sc-friends">';
            foreach($matches as $key => $val) {
                $out .= '<div class="sc-friends__item">' . do_shortcode($val[0]) . '</div>';
            }
            $out .= '</div>';
            return $out;
        }
    }

    /**
     * 短代码 - 链接
     */
    public static function shortcode_link( $atts, $content = '' ) {
        $args = shortcode_atts( array(
            'href' => '#',
            'target' => '_blank',
            'title' => ''
        ), $atts );
        return <<<EOF
            <a class="sc-link" href="{$args['href']}" target="{$args['target']}">
                <span class="sc-link__name">{$content}</span>
                <span class="sc-link__title">{$args['title']}</span>
            </a>
        EOF;
    }

    /**
     * 解析所有文章内容
     */
    public static function parse_content($content, $widget, $lastContent) {
        $content = empty($lastContent) ? $content : $lastContent;
        if ($widget instanceof Widget_Abstract) {
            add_shortcode( 'link' , 'Service::shortcode_link' );
            add_shortcode( 'friends', 'Service::shortcode_friends' );

            $content = do_shortcode($content);
        }
        return $content;
    }
}

Typecho_Plugin::factory('Widget_Abstract_Contents')->contentEx = array('Service', 'parse_content');
Typecho_Plugin::factory('Widget_Abstract_Contents')->excerptEx = array('Service', 'parse_content');
