<{foreach item=link from=$block}>
    <p>
        <{if $link.logo}>
            <p class="center">
                <a href="<{$wglinks_url}>/index.php?link_id=<{$link.id}>" title="<{$link.tooltip}>" target="_self">
                    <img src="<{$wglinks_upload_url}>/images/links/thumbs/<{$link.logo}>" alt="<{$link.tooltip}>" class="wglinks-link-img img-responsive" style="max-height:<{$imgheight}>">
                </a>
            </p>
        <{/if}>
        <p class="center">
            <a href="<{$wglinks_url}>/index.php?link_id=<{$link.id}>" title="<{$link.tooltip}>" target="_self"><{$link.tooltip}></a>
        </p>
    </p>
<{/foreach}>