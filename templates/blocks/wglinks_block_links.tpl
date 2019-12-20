<{if $block}>
    <{if ($blockStyle == '2cards' || $blockStyle == '3cards' || $blockStyle == '4cards' || $blockStyle == '6cards' || $blockStyle == '12cards')}>
        <{include file='db:wglinks_block_links_cards.tpl' link=$link}>
    <{else}>
        <{include file='db:wglinks_block_links_default.tpl' link=$link}>
    <{/if}>
    <{if $showMore}>
        <div class="wglinks-block-more"><a class="btn btn-primary wg-color1" href="<{$wglinks_url}>/index.php<{if $cat_ids}>?cat_ids=<{$cat_ids}><{/if}>" title="<{$smarty.const._MA_WGLINKS_SHOW_MORE}>" target="_self"><{$smarty.const._MA_WGLINKS_SHOW_MORE}></a></div>
    <{/if}>
<{/if}>