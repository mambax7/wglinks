<div class='wglinks-link col-xs-12 col-sm-12'>
    <{if $link.logo}>
        <div class='col-xs-12 col-sm-6 right'>
            <a href="<{$link.url}>" title="<{$link.tooltip}>" target="_blank">
                <img src="<{$wglinks_upload_url}>/images/links/large/<{$link.logo}>" alt="<{$link.name}>" class="wglinks-link-img img-responsive">
            </a>
        </div>
        <div class='col-xs-12 col-sm-6 left'>
    <{else}>
        <div class='col-xs-12 col-sm-12 left'>
    <{/if}>
        <{if $link.detail}>
            <span class='wglinks-link-detail'><{$link.detail}></span>
        <{/if}>
        <{if $link.contact || $link.email || $link.phone || $link.address || $link.url }>
            <{if $link.contact}>
                <div class='row'>
                    <{if $title_style == 'glyphicons'}>
                        <div class='col-xs-2 col-sm-2 wglinks-link-icon'><span class="glyphicon glyphicon-user" title="<{$smarty.const._MA_WGLINKS_LINK_CONTACT}>"></span></div>
                        <div class='col-xs-10 col-sm-10 wglinks-link-contact'>
                    <{else}>
                        <div class='col-xs-12 col-sm-12 wglinks-link-contact'>
                            <{$smarty.const._MA_WGLINKS_LINK_CONTACT}>:
                    <{/if}>
                        <{$link.contact}>
                    </div>
                </div>
            <{/if}>
            <{if $link.email}>
                <div class='row'>
                    <{if $title_style == 'glyphicons'}>
                        <div class='col-xs-2 col-sm-2 wglinks-link-icon'><span class="glyphicon glyphicon-envelope" title="<{$smarty.const._MA_WGLINKS_LINK_EMAIL}>"></span></div>
                        <div class='col-xs-10 col-sm-10 wglinks-link-email'>
                    <{else}>
                        <div class='col-xs-12 col-sm-12 wglinks-link-email'>
                            <{$smarty.const._MA_WGLINKS_LINK_EMAIL}>:&nbsp;
                    <{/if}>
                        <{$link.email}>
                    </div>
                </div>
            <{/if}>
            <{if $link.phone}>
                <div class='row'>                
                    <{if $title_style == 'glyphicons'}>
                        <div class='col-xs-2 col-sm-2 wglinks-link-icon'><span class="glyphicon glyphicon-phone" title="<{$smarty.const._MA_WGLINKS_LINK_PHONE}>"></span></div>
                        <div class='col-xs-10 col-sm-10 wglinks-link-phone'>
                    <{else}>
                        <div class='col-xs-12 col-sm-12 wglinks-link-phone'>
                            <{$smarty.const._MA_WGLINKS_LINK_PHONE}>:&nbsp;
                    <{/if}>
                        <{$link.phone}>
                    </div>
                </div>
            <{/if}>
            <{if $link.address}>
                <div class='row'>
                    <{if $title_style == 'glyphicons'}>
                        <div class='col-xs-2 col-sm-2 wglinks-link-icon'><span class="glyphicon glyphicon-map-marker" title="<{$smarty.const._MA_WGLINKS_LINK_ADDRESS}>"></span></div>
                        <div class='col-xs-10 col-sm-10 wglinks-link-address'>
                    <{else}>
                        <div class='col-xs-12 col-sm-12 wglinks-link-address'>
                            <{$smarty.const._MA_WGLINKS_LINK_ADDRESS}>:&nbsp;
                    <{/if}>
                        <{$link.address}>
                    </div>
                </div>
            <{/if}>
            <{if $link.url}>
                <div class='row'>
                    <{if $title_style == 'glyphicons'}>
                        <div class='col-xs-2 col-sm-2 wglinks-link-icon'><span class="glyphicon glyphicon-globe" title="<{$smarty.const._MA_WGLINKS_LINK_URL}>"></span></div>
                        <div class='col-xs-10 col-sm-10 wglinks-link-url'>
                    <{else}>
                        <div class='col-xs-12 col-sm-12 wglinks-link-url'>
                            <{$smarty.const._MA_WGLINKS_LINK_URL}>:&nbsp;
                    <{/if}>
                        <a href="<{$link.url}>" title="<{$link.tooltip}>" target="_blank"><{$link.url_text}></a>
                    </div>
                </div>
            <{/if}>
        <{/if}>
    </div>
</div>