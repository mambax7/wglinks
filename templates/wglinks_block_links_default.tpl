<ul class="nav nav-pills nav-stacked">
    <{foreach item=link from=$block}>
        <li>
            <a class="wglinks-block-link" href="<{$wglinks_url}>/index.php?link_id=<{$link.id}>" title="<{$link.tooltip}>" target="_self">
            <{if $link.logo}>
                <img src="<{$wglinks_upload_url}>/images/links/thumbs/<{$link.logo}>" alt="<{$link.tooltip}>" class="wglinks-block-img" style="max-height:<{$imgheight}>">
            <{/if}>
            <{$link.tooltip}></a>
        </li>
    <{/foreach}>
</ul>