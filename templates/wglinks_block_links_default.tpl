<ul class="nav nav-pills nav-stacked">
    <{foreach item=link from=$block}>
        <li>
            <{if $link.logo}>
                <a href="<{$wglinks_url}>/index.php?link_id=<{$link.id}>" title="<{$link.tooltip}>" target="_self">
                    <img src="<{$wglinks_upload_url}>/images/links/thumbs/<{$link.logo}>" alt="<{$link.tooltip}>" class="wglinks-block-img img-responsive" style="max-height:<{$imgheight}>">
                </a>
            <{/if}>
            <a class="wglinks-block-link" href="<{$wglinks_url}>/index.php?link_id=<{$link.id}>" title="<{$link.tooltip}>" target="_self"><{$link.tooltip}></a>
        </li>
    <{/foreach}>
</ul>