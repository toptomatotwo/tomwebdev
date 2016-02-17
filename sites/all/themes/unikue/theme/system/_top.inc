<?php global $base_url;?>
<div class="loading">
    <img class="loading-gif" src="<?php print $base_url.'/'.drupal_get_path('theme','unikue')?>/img/preloader2.gif" alt="preloader2.gif">
  
</div>
<!-- navigation -->
<div class="w-nav navbar" data-collapse="medium" data-animation="default" data-duration="400" data-contain="1">
    <?php if(isset($menu_social)):?>
    <div class="social-div">
        <?php print $menu_social;?>
    </div>
    <?php endif;?>
    <div class="w-container container-nav">
        <a class="w-nav-brand brand" href="<?php print $base_url;?>" data-ix="fade-down"><!-- here is the logo -->
            <!--<img class="logo" src="/sites/default/files/logos/logo-v2.png" alt="LexwebDev logo" data-ix="fade-down"> -->
            Tom Carden <span>Website Portfolio</span>
        </a>
        <!-- nav tag -->
        <?php if($is_portfolio == FALSE):?>
            <?php if($page['navigation']):?>
                <?php print render($page['navigation']);?>
            <?php endif;?>
        <?php else: ?>
            <div class="w-clearfix button-single">
                <?php if(isset($next_link)):?>
                <a class="button single" href="<?php print $next_link;?>" data-ix="fade-down-4"><?php print t('Next project');?></a>
                <?php endif;?>
                <a class="button single fa fa-th" href="<?php print $base_url.'/#project';?>" data-ix="fade-down-3"></a>
                <?php if(isset($prev_link)):?>
                <a class="button single" href="<?php print $prev_link;?>" data-ix="fade-down-2"><?php print t('previous project');?></a>
                <?php endif;?>
            </div>
        <?php endif;?>
        <div class="w-nav-button menu-button">
            <div class="w-icon-nav-menu"></div>
        </div>
    </div>
</div><!-- end navigation -->
<!-- start slider -->

<?php if($page['header']):?>
    <?php print render($page['header']);?>
<?php endif;?>

<?php if(theme_get_setting('enable_dot_navigation')):?>
    <?php if(isset($dot_navigation)):?>
        <?php print $dot_navigation;?>
    <?php endif;?>
<?php endif;?>