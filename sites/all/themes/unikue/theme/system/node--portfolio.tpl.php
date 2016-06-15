<?php$style = 'style_1';if(isset($content['field_portfolio_layout_mode'])){    $style = $content['field_portfolio_layout_mode']['#items'][0]['value'];}$multimedia = field_get_items('node', $node, 'field_portfolio_multimedia');?><?php if ($style == 'style_5'):?>    <div id="node-<?php print $node->nid; ?>" class=" <?php print $classes; ?> clearfix"<?php print $attributes; ?>>    <section class="section-single-5">        <div class="w-container container-single">           <div class="w-row row">                <div class="w-col w-col-4">                                        <?php if(isset($content['field_portfolio_website'][0])):                        $data = $content['field_portfolio_website']['#items'][0]['value'];                        $wid = $content['field_portfolio_website'][0]['entity']['field_collection_item'][$data];                        ?>                                            <?php endif;?>                    <?php if(isset($content['field_portfolio_description'])):?>                        <div><h1 class="portfolio-page-title"><?php print $title;?></h1></div>                        <p class="left p-margin website-link"><?php print $wid['field_portfolio_website_link']['#items'][0]['value'];?></p>                        <p class="left"><?php print $content['field_portfolio_description']['#items'][0]['value'];?></p>                    <?php endif;?>                    <?php if(isset($content['body'])):?>                        <p class="left"><?php print $content['body']['#items'][0]['value'];?></p>                    <?php endif;?>                    <div class="small-tittle"><?php print t('project details');?></div>                    <?php if(isset($content['field_details'])):?>                        <?php print $content['field_details']['#items'][0]['value'];?>                    <?php endif;?>                                        <?php if(isset($content['field_portfolio_website'][0])):                        $data = $content['field_portfolio_website']['#items'][0]['value'];                        $wid = $content['field_portfolio_website'][0]['entity']['field_collection_item'][$data];                        ?>                        <?php if(isset($wid['field_portfolio_website_title'])):?>                        <p class="left p-margin"><span class="darker"><?php print $wid['field_portfolio_website_title']['#title'];?><?php print t(':');?></span> <?php print $wid['field_portfolio_website_title']['#items'][0]['value'];?></p>                    <?php endif;?>                                                            <?php endif;?>                    <?php if(isset($content['sharethis'])):?>                        <?php print render($content['sharethis']);?>                    <?php endif;?>                </div>                <div class="w-col w-col-8">                    <?php                    foreach($multimedia as $key => $value):                        $pid = $value['value'];                        $data = field_view_value('node', $node, 'field_portfolio_multimedia',$multimedia[$key]);?>                                                                                    <?php print render($data['entity']['field_collection_item'][$pid]['field_portfolio_multi_image']);?>                                                <?php endforeach;?>                </div>            </div>        </div>    </section></div><?php endif;?><?php if($style == 'style_3'):?><div id="node-<?php print $node->nid; ?>" class=" <?php print $classes; ?> clearfix"<?php print $attributes; ?>>    <div class="w-container">        <div class="portfolio-tiitle in-left"><?php print $title;?></div>        <?php if(isset($content['field_portfolio_subtitle'])):?>        <div class="subtext-portfolio"><?php print $content['field_portfolio_subtitle']['#items'][0]['value'];?></div>        <?php endif;?>        <div class="portfolio-line"></div>        <div class="w-row row">            <div class="w-col w-col-8">                <div class="w-slider single-slider" data-animation="over" data-duration="500" data-infinite="1" data-hide-arrows="1"><!-- slider begin -->                    <div class="w-slider-mask">                        <?php                        foreach($multimedia as $key => $value):                        $pid = $value['value'];                        $data = field_view_value('node', $node, 'field_portfolio_multimedia',$multimedia[$key]);                        $current_data = $data['entity']['field_collection_item'][$pid];                        ;?>                        <div class="w-slide">                            <?php if(isset($current_data['field_portfolio_multi_text'])):?>                            <div class="slider-text"><?php print $current_data['field_portfolio_multi_text']['#items'][0]['value'];?></div>                            <?php endif;?>                                            <?php if($current_data['field_portfolio_multi_image'][0]['#bundle'] == 'image'):?>                            <img style="width: 100%; height: 413px" src="<?php print file_create_url($current_data['field_portfolio_multi_image'][0]['file']['#item']['uri']);?>">                            <?php else:?>                                    <?php print render($current_data['field_portfolio_multi_image']);?>                                <?php endif;?>                        </div>                        <?php endforeach;?>                    </div>                    <div class="w-slider-arrow-left vertical">                        <div class="w-icon-slider-left arrow-slider"></div>                    </div>                    <div class="w-slider-arrow-right vertical">                        <div class="w-icon-slider-right arrow-slider"></div>                    </div>                    <div class="w-slider-nav w-round slide-nav"></div>                </div>            </div>            <div class="w-col w-col-4 column-iphone">                <?php if(isset($content['field_portfolio_description'])):?>                <div class="small-tittle"><?php print $content['field_portfolio_description']['#title'];?></div>                <p class="left"><?php print $content['field_portfolio_description']['#items'][0]['value'];?></p>                <?php endif;?>                <div class="small-tittle"><?php print t('project details');?></div>                <?php if(isset($content['field_portfolio_website'][0])):                $data = $content['field_portfolio_website']['#items'][0]['value'];                $wid = $content['field_portfolio_website'][0]['entity']['field_collection_item'][$data];                ?>                <?php if(isset($wid['field_portfolio_website_title'])):?>                <p class="left p-margin"><span class="darker"><?php print $wid['field_portfolio_website_title']['#title'];?><?php print t(':');?></span> <?php print $wid['field_portfolio_website_title']['#items'][0]['value'];?></p>                <?php endif;?>                <div class="portfolio-line details"></div>                <p class="left p-margin"><span class="darker"><?php print t('Date:');?></span> <?php print format_date($node->created,'custom','j F, Y');?></p>                <div class="portfolio-line details"></div>                <?php if(isset($wid['field_portfolio_website_link'])):?>                <p class="left p-margin"><span class="darker"><?php print $wid['field_portfolio_website_link']['#title'];?><?php print t(':');?></span> <?php print $wid['field_portfolio_website_link']['#items'][0]['value'];?></p>                <?php endif;?>                <?php endif;?>                <?php if(isset($content['sharethis'])):?>                    <?php print render($content['sharethis']);?>                <?php endif;?>            </div>        </div>    </div>    <div class="logo-section single">        <div class="w-container">            <?php if(isset($content['clients_entity_view_1'])):?>                <?php print render($content['clients_entity_view_1']);?>            <?php endif;?>        </div></div><?php endif;?><?php if ($style == 'style_4'):?>    <section class="section-single-4">        <div class="w-container">            <div class="portfolio-tiitle in-left single-four"><?php print $title;?></div>            <?php if(isset($content['field_portfolio_subtitle'])):?>            <div class="subtext-portfolio four_single"><?php print $content['field_portfolio_subtitle']['#items'][0]['value'];?></div>            <?php endif;?>        </div>    </section>    <div class="section-single">    <div class="w-container container-single">        <div class="w-row row-gall">            <?php            foreach($multimedia as $key => $value):            $pid = $value['value'];            $data = field_view_value('node', $node, 'field_portfolio_multimedia',$multimedia[$key]);            $current_data = $data['entity']['field_collection_item'][$pid];            ?>            <div class="w-col w-col-4 column-gallery">                <?php if($current_data['field_portfolio_multi_image'][0]['#bundle'] == 'image'):?>                <img src="<?php print file_create_url($current_data['field_portfolio_multi_image'][0]['file']['#item']['uri']);?>">                <?php else:?>                                <?php print render($current_data['field_portfolio_multi_image']);?>                            <?php endif;?>                            <?php if(isset($current_data['field_portfolio_multi_text'])):?>                <a class="w-inline-block galler-overlay" href="<?php if(isset($current_data['field_portfolio_multi_link'])): print $current_data['field_portfolio_multi_link']['#items'][0]['value'];  endif;?>">                    <div class="text-gallery"><?php print $current_data['field_portfolio_multi_text']['#items'][0]['value'];?></div>                    <?php endif;?>                </a>            </div>            <?php endforeach;?>        </div>        <div class="w-row row">            <div class="w-col w-col-4 portfolio-description">                <?php if(isset($content['field_portfolio_description'])):?>                <div class="small-tittle"><?php print $content['field_portfolio_description']['#title'];?></div>                <p class="left"><?php print $content['field_portfolio_description']['#items'][0]['value'];?></p>                <?php endif;?>            </div>            <div class="w-col w-col-4 column">                <?php if(isset($content['body'])):?>                <p class="left"><?php print $content['body']['#items'][0]['value'];?></p>                <?php endif;?>            </div>            <div class="w-col w-col-4">                <!-- <div class="small-tittle"><?php print t('project details');?></div> -->                <?php if(isset($content['field_portfolio_website'][0])):                $data = $content['field_portfolio_website']['#items'][0]['value'];                $wid = $content['field_portfolio_website'][0]['entity']['field_collection_item'][$data];                ?>                <?php if(isset($wid['field_portfolio_website_title'])):?>                <p class="left p-margin"><span class="darker"><?php print $wid['field_portfolio_website_title']['#title'];?><?php print t(':');?></span> <?php print $wid['field_portfolio_website_title']['#items'][0]['value'];?></p>                <?php endif;?>                <div class="portfolio-line details"></div>                <p class="left p-margin"><span class="darker"><?php print t('Date:');?></span> <?php print format_date($node->created,'custom','j F, Y');?></p>                <div class="portfolio-line details"></div>                <?php if(isset($wid['field_portfolio_website_link'])):?>                <p class="left p-margin"><span class="darker"><?php print $wid['field_portfolio_website_link']['#title'];?><?php print t(':');?></span> <?php print $wid['field_portfolio_website_link']['#items'][0]['value'];?></p>                <?php endif;?>                <?php endif;?>                <?php if(isset($content['sharethis'])):?>                    <?php print render($content['sharethis']);?>                <?php endif;?>            </div>        </div>    </div>    </div><?php endif;?><?php //print render($content['flippy_pager']);?>