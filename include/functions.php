<?php
/*
 You may not change or alter any portion of this comment or credits
 of supporting developers from this source code or any supporting source code
 which is considered copyrighted (c) material of the original comment or credit authors.

 This program is distributed in the hope that it will be useful,
 but WITHOUT ANY WARRANTY; without even the implied warranty of
 MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.
*/

/**
 * wgLinks module for xoops
 *
 * @copyright      module for xoops
 * @license        GPL 2.0 or later
 * @package        wglinks
 * @since          1.0
 * @min_xoops      2.5.7
 * @author         XOOPS on Wedega - Email:<webmaster@wedega.com> - Website:<https://xoops.wedega.com>
 * @version        $Id: 1.0 functions.php 13070 Sun 2016-03-20 15:20:15Z XOOPS Development Team $
 */

/***************Blocks**************
 * @param $cats
 * @return string
 */
function wglinks_block_addCatSelect($cats) {
    $cat_sql = '';
    if(is_array($cats))
    {
        $cat_sql = '('.current($cats);
        array_shift($cats);
        foreach($cats as $cat)
        {
            $cat_sql .= ','.$cat;
        }
        $cat_sql .= ')';
    }
    return $cat_sql;
}

function wglinksMetaKeywords($content)
{
    global $xoopsTpl, $xoTheme;
    $myts = MyTextSanitizer::getInstance();
    $content= $myts->undoHtmlSpecialChars($myts->displayTarea($content));
    if(isset($xoTheme) && is_object($xoTheme)) {
        $xoTheme->addMeta( 'meta', 'keywords', strip_tags($content));
    } else {    // Compatibility for old Xoops versions
        $xoopsTpl->assign('xoops_meta_keywords', strip_tags($content));
    }
}

function wglinksMetaDescription($content)
{
    global $xoopsTpl, $xoTheme;
    $myts = MyTextSanitizer::getInstance();
    $content = $myts->undoHtmlSpecialChars($myts->displayTarea($content));
    if(isset($xoTheme) && is_object($xoTheme)) {
        $xoTheme->addMeta( 'meta', 'description', strip_tags($content));
    } else {    // Compatibility for old Xoops versions
        $xoopsTpl->assign('xoops_meta_description', strip_tags($content));
    }
}

/**
 * Rewrite all url
 *
 * @String  $module  module name
 * @String  $array   array
 * @param $module
 * @param $array
 * @param string $type
 * @return string $type    string replacement for any blank case
 */
function wglinks_RewriteUrl($module, $array, $type = 'content')
{
    $comment = '';
    $wglinks = \XoopsModules\Wglinks\Helper::getInstance();
    $lenght_id = $wglinks->getConfig('lenght_id');
    $rewrite_url = $wglinks->getConfig('rewrite_url');

    if ($lenght_id != 0) {
        $id = $array['content_id'];
        while (strlen($id) < $lenght_id) {
            $id = '0' . $id;
        }
    } else {
        $id = $array['content_id'];
    }

    if (isset($array['topic_alias']) && $array['topic_alias']) {
        $topic_name = $array['topic_alias'];
    } else {
        $topic_name = wglinks_Filter(xoops_getModuleOption('static_name', $module));
    }

    switch ($rewrite_url) {

        case 'none':
            if($topic_name) {
                 $topic_name = 'topic=' . $topic_name . '&amp;';
            }
            $rewrite_base = '/modules/';
            $page = 'page=' . $array['content_alias'];
            return XOOPS_URL . $rewrite_base . $module . '/' . $type . '.php?' . $topic_name . 'id=' . $id . '&amp;' . $page . $comment;
            break;

        case 'rewrite':
            if($topic_name) {
                $topic_name .= '/';
            }
            $rewrite_base = xoops_getModuleOption('rewrite_mode', $module);
            $rewrite_ext = xoops_getModuleOption('rewrite_ext', $module);
            $module_name = '';
            if(xoops_getModuleOption('rewrite_name', $module)) {
                $module_name = xoops_getModuleOption('rewrite_name', $module) . '/';
            }
            $page = $array['content_alias'];
            $type .= '/';
            $id .= '/';
            if ($type == 'content/') {
                $type = '';
            }

            if ($type == 'comment-edit/' || $type == 'comment-reply/' || $type == 'comment-delete/') {
                return XOOPS_URL . $rewrite_base . $module_name . $type . $id . '/';
            }

            return XOOPS_URL . $rewrite_base . $module_name . $type . $topic_name  . $id . $page . $rewrite_ext;
            break;

         case 'short':
            if($topic_name) {
                $topic_name .= '/';
            }
            $rewrite_base = xoops_getModuleOption('rewrite_mode', $module);
            $rewrite_ext = xoops_getModuleOption('rewrite_ext', $module);
            $module_name = '';
            if(xoops_getModuleOption('rewrite_name', $module)) {
                $module_name = xoops_getModuleOption('rewrite_name', $module) . '/';
            }
            $page = $array['content_alias'];
            $type .= '/';
            if ($type == 'content/') {
                $type = '';
            }

            if ($type == 'comment-edit/' || $type == 'comment-reply/' || $type == 'comment-delete/') {
                return XOOPS_URL . $rewrite_base . $module_name . $type . $id . '/';
            }

            return XOOPS_URL . $rewrite_base . $module_name . $type . $topic_name . $page . $rewrite_ext;
            break;
    }
    return void;
}

/**
 * Replace all escape, character, ... for display a correct url
 *
 * @String  $url    string to transform
 * @String  $type   string replacement for any blank case
 * @param $url
 * @param string $type
 * @param string $module
 * @return string $url
 */
function wglinks_Filter($url, $type = '', $module = 'wglinks') {

    // Get regular expression from module setting. default setting is : `[^a-z0-9]`i
    $wglinks = \XoopsModules\Wglinks\Helper::getInstance();
    $regular_expression = $wglinks->getConfig('regular_expression');

    $url = strip_tags($url);
    $url = preg_replace('`\[.*\]`U', '', $url);
    $url = preg_replace('`&(amp;)?#?[a-z0-9]+;`i', '-', $url);
    $url = htmlentities($url, ENT_COMPAT, 'utf-8');
    $url = preg_replace('`&([a-z])(acute|uml|circ|grave|ring|cedil|slash|tilde|caron|lig);`i', "\1", $url);
    $url = preg_replace([$regular_expression, '`[-]+`'], '-', $url);
    $url = ($url == '') ? $type : strtolower(trim($url, '-'));
    return $url;
}
