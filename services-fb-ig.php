<?php
/*

 Template Name:  Services FB/IG
Template Post Type: Services

 */

get_header();

?>
    <section class="hero fb_ig_template" id="hero" style="--bg-img:url(<?php the_field('background_image'); ?>)">
        <div class="hero__wrapper">
            <div class="container">
                <div class="hero__inner">
                    <h2 class="hero__title h2_white"><?php the_field('hero_title'); ?></h2>
                </div>
            </div>
        </div>
    </section>
    <section class="fb-ig">
        <div class="fb-ig__wrapper">
            <div class="container">
                <div class="fb-ig__inner d-flex justify-content-between">
                    <div class="fb-ig__text">
                        <div class="fb-ig__descr">
                            <?php the_field('fb_ig_ads_subtitle'); ?>
                        </div>
                        <div class="fb-ig__logo">
                            <img src="<?php the_field('fb_ig_partners_img'); ?>" alt="" loading="lazy">
                        </div>
                    </div>
                    <?php if (have_rows('fb_ig_row_images')): ?>
                        <?php while (have_rows('fb_ig_row_images')): the_row();
                            ?>
                            <div class="fb-ig__images d-flex justify-content-between">
                                <?php if (have_rows('fb_ig_images')): ?>
                                    <?php while (have_rows('fb_ig_images')): the_row();
                                        ?>
                                        <img src="<?php the_sub_field('fb_ig_image'); ?>" alt loading="lazy">
                                    <?php endwhile; ?>
                                <?php endif; ?>
                            </div>
                        <?php endwhile; ?>
                    <?php endif; ?>
                </div>
                <a class="btn btn_secondary btn_large btn_quote" href="#footer">Get a quote</a>
            </div>
        </div>
    </section>
    <section class="ads">
        <div class="ads__wrapper">
            <div class="container">
                <h2 class="ads__title h2_white"><?php the_field('fb_ig_types_title'); ?></h2>
            </div>
            <div class="ads__fb">
                <div class="container">
                    <h4 class="ad__title"><?php the_field('facebook_types_title'); ?></h4>
                </div>
                <div class="ads__list d-md-flex">
                    <?php if (have_rows('facebook_ads_row')): ?>
                        <?php while (have_rows('facebook_ads_row')): the_row();
                            ?>
                            <div class="item" style="--bg-img:url(<?php the_sub_field('facebook_ads_image'); ?>)">
                                <h5><?php the_sub_field('facebook_ads_title'); ?></h5>
                            </div>
                        <?php endwhile; ?>
                    <?php endif; ?>
                </div>
            </div>
            <div class="ads__inst ad">
                <div class="container">
                    <h4 class="ad__title"><?php the_field('instagram_types_title'); ?></h4>
                </div>
                <div class="ad__list d-md-flex">
                    <?php if (have_rows('instagram_ads_row')): ?>
                        <?php while (have_rows('instagram_ads_row')): the_row();
                            ?>
                            <div class="item" style="--bg-img:url(<?php the_sub_field('instagram_ads_image'); ?>)">
                                <h5><?php the_sub_field('instagram_ads_title'); ?></h5>
                            </div>
                        <?php endwhile; ?>
                    <?php endif; ?>
                </div>
            </div>
            <div class="audiences">
                <div class="ads__inst ad targeted">
                    <div class="container">
                        <h4 class="ad__title"><?php the_field('targeted_types_title'); ?></h4>
                        <h6 class="ad__subtitle"><?php the_field('targeted_types_subtitle'); ?></h6>
                    </div>
                    <div class="ad__list d-md-flex">
                        <?php if (have_rows('targeted_ads_row')): ?>
                            <?php while (have_rows('targeted_ads_row')): the_row();
                                ?>
                                <div class="items">
                                    <img src="<?php the_sub_field('targeted_ads_image'); ?>" alt loading="lazy">
                                    <h5><?php the_sub_field('targeted_ads_title'); ?></h5>
                                </div>
                            <?php endwhile; ?>
                        <?php endif; ?>
                    </div>
                </div>
                <div class="ads__inst ad retargeting">
                    <div class="container">
                        <h4 class="ad__title"><?php the_field('retargeting_types_title'); ?></h4>
                        <h6 class="ad__subtitle"><?php the_field('retargeting_types_subtitle'); ?></h6>
                    </div>
                    <div class="ad__list d-md-flex">
                        <?php if (have_rows('retargeting_ads_row')): ?>
                            <?php while (have_rows('retargeting_ads_row')): the_row();
                                ?>
                                <div class="items">
                                    <img src="<?php the_sub_field('retargeting_ads_image'); ?>" alt loading="lazy">
                                    <h5><?php the_sub_field('retargeting_ads_title'); ?></h5>
                                </div>
                            <?php endwhile; ?>
                        <?php endif; ?>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <section class="howwedoit">
        <div class="howwedoit__wrapper">
            <div class="howwedoit__inner">
                <div class="container">
                    <h2 class="howwedoit__title"><?php the_field('how_we_do_title'); ?></h2>
                    <div class="howwedoit__text">
                        <p><?php the_field('how_we_do_subtitle'); ?></p>
                    </div>
                </div>
                <ul class="howwedoit__list">
                    <?php if (have_rows('howwedoit__list')): ?>
                        <?php $i = 0; ?>
                        <?php while (have_rows('howwedoit__list')): the_row();
                            $i++;
                            ?>
                            <li class="howwedoit__item item">
                                <div class="container d-lg-flex justify-content-between">
                                    <div class="item__text" data-count="0<?php echo $i; ?>">
                                        <h4 class="item__title"><?php the_sub_field('list_title'); ?></h4>
                                        <div class="item__descr">
                                            <?php the_sub_field('list_description'); ?>
                                        </div>
                                    </div>
                                    <div class="item__images d-flex justify-content-between">
                                        <?php if (have_rows('step_image')): ?>
                                            <?php while (have_rows('step_image')): the_row();
                                                ?>
                                                <img src="<?php the_sub_field('photo'); ?>" alt="">
                                            <?php endwhile; ?>
                                        <?php endif; ?>
                                    </div>
                                </div>
                            </li>
                        <?php endwhile; ?>
                    <?php endif; ?>
                    <div class="container">
                        <a class="btn btn_secondary btn_large btn_quote" href="#footer">get a quote</a>
                    </div>
                </ul>
            </div>
        </div>
    </section>
    <section class="case" id="services">
        <div class="container d-lg-flex justify-content-between align-items-center">
            <h2 class="case__title h2_white"><?php the_field('title_case_studies'); ?></h2>
            <div class="case__subtitle">
                <p><?php the_field('descriptions_case_studies'); ?></p>
            </div>
        </div>
        <div class="case__slider">
            <div class="swiper">
                <div class="swiper-wrapper">
                    <?php
                    global $post;
                    $args = array(
                        'post_type' => 'Case Studies',
                    );
                    $the_query = new WP_Query($args); ?>

                    <?php if ($the_query->have_posts()) : ?>
                        <?php while ($the_query->have_posts()) : $the_query->the_post();

                            $image = wp_get_attachment_image_src(get_post_thumbnail_id($post->ID), ' ');
                            ?>
                            <div class="swiper-slide case__item slide d-flex flex-column justify-content-between"
                                 style="--bg-img: url(<?php echo $image[0]; ?>)">
                                <div class="slide__head">
                                    <h5 class="slide__title"><?php the_title(); ?></h5>
                                    <div class="slide__subtitle">
                                        <?php $category_detail = get_the_category($post->ID);
                                        foreach ($category_detail as $cd) {
                                            ?>
                                            <p><?php echo $cd->cat_name; ?></p>
                                            <?php
                                        }
                                        ?>

                                    </div>
                                </div>
                                <div class="slide__results results d-flex">
                                    <?php
                                    $sales_for_st = get_field('sales_for_st');
                                    $return_for_st = get_field('return_for_st');
                                    if ($sales_for_st) {
                                        ?>
                                        <div class="sales">
                                            <p><?php echo $sales_for_st; ?></p>
                                        </div>
                                        <?php
                                    } if ($return_for_st) {
                                        ?>
                                        <div class="return">
                                            <p><?php the_field('return_for_st'); ?></p>
                                        </div>
                                        <?php
                                    }
                                    ?>
                                </div>
                                <a class="btn btn_primary btn_small" href="<?php the_permalink(); ?>">view case
                                    study</a>
                            </div>
                        <?php endwhile; ?>
                        <?php wp_reset_postdata(); ?>

                    <?php else : ?>
                    <?php endif; ?>
                </div>
                <div class="swiper-pagination"></div>
                <div class="swiper-button-prev swiper-btn">
                    <svg width="23" height="16" viewBox="0 0 23 16" fill="none" xmlns="http://www.w3.org/2000/svg">
                        <path d="M22.8596 7.32789L15.6721 0.140392C15.4849 -0.0467974 15.1817 -0.0467974 14.9946 0.140392C14.8074 0.327582 14.8074 0.630804 14.9946 0.817949L21.3641 7.18751H0.479182C0.214322 7.18751 0 7.40183 0 7.66669C0 7.93155 0.214322 8.14587 0.479182 8.14587H21.3641L14.9946 14.5154C14.8074 14.7026 14.8074 15.0058 14.9946 15.1929C15.0881 15.2865 15.2108 15.3333 15.3334 15.3333C15.456 15.3333 15.5785 15.2865 15.6722 15.1929L22.8597 8.00545C23.0468 7.8183 23.0468 7.51508 22.8596 7.32789Z"
                              fill="#121212"/>
                    </svg>

                </div>
                <div class="swiper-button-next swiper-btn">
                    <svg width="23" height="16" viewBox="0 0 23 16" fill="none" xmlns="http://www.w3.org/2000/svg">
                        <path d="M22.8596 7.32789L15.6721 0.140392C15.4849 -0.0467974 15.1817 -0.0467974 14.9946 0.140392C14.8074 0.327582 14.8074 0.630804 14.9946 0.817949L21.3641 7.18751H0.479182C0.214322 7.18751 0 7.40183 0 7.66669C0 7.93155 0.214322 8.14587 0.479182 8.14587H21.3641L14.9946 14.5154C14.8074 14.7026 14.8074 15.0058 14.9946 15.1929C15.0881 15.2865 15.2108 15.3333 15.3334 15.3333C15.456 15.3333 15.5785 15.2865 15.6722 15.1929L22.8597 8.00545C23.0468 7.8183 23.0468 7.51508 22.8596 7.32789Z"
                              fill="#121212"/>
                    </svg>

                </div>
            </div>
        </div>
    </section>
    <section class="feedback" id="testimonials">
        <div class="feedback__wrapper">
            <div class="container">
                <h2 class="feedback__title"><?php the_field('testimonial_title'); ?></h2>
                <div class="swiper-buttons d-flex">
                    <div class="prev-button swiper-btn">
                        <svg width="23" height="16" viewBox="0 0 23 16" fill="none" xmlns="http://www.w3.org/2000/svg">
                            <path d="M22.8596 7.32789L15.6721 0.140392C15.4849 -0.0467974 15.1817 -0.0467974 14.9946 0.140392C14.8074 0.327582 14.8074 0.630804 14.9946 0.817949L21.3641 7.18751H0.479182C0.214322 7.18751 0 7.40183 0 7.66669C0 7.93155 0.214322 8.14587 0.479182 8.14587H21.3641L14.9946 14.5154C14.8074 14.7026 14.8074 15.0058 14.9946 15.1929C15.0881 15.2865 15.2108 15.3333 15.3334 15.3333C15.456 15.3333 15.5785 15.2865 15.6722 15.1929L22.8597 8.00545C23.0468 7.8183 23.0468 7.51508 22.8596 7.32789Z"
                                  fill="#121212"/>
                        </svg>

                    </div>
                    <div class="next-button swiper-btn">
                        <svg width="23" height="16" viewBox="0 0 23 16" fill="none" xmlns="http://www.w3.org/2000/svg">
                            <path d="M22.8596 7.32789L15.6721 0.140392C15.4849 -0.0467974 15.1817 -0.0467974 14.9946 0.140392C14.8074 0.327582 14.8074 0.630804 14.9946 0.817949L21.3641 7.18751H0.479182C0.214322 7.18751 0 7.40183 0 7.66669C0 7.93155 0.214322 8.14587 0.479182 8.14587H21.3641L14.9946 14.5154C14.8074 14.7026 14.8074 15.0058 14.9946 15.1929C15.0881 15.2865 15.2108 15.3333 15.3334 15.3333C15.456 15.3333 15.5785 15.2865 15.6722 15.1929L22.8597 8.00545C23.0468 7.8183 23.0468 7.51508 22.8596 7.32789Z"
                                  fill="#121212"/>
                        </svg>

                    </div>
                </div>
            </div>
            <div class="feedback__slider swiper">
                <ul class="swiper-wrapper feedback__list">
                    <?php if (have_rows('testimonial_slider')): ?>
                        <?php while (have_rows('testimonial_slider')): the_row();
                            ?>
                            <li class="swiper-slide feedback__item item d-flex flex-column justify-content-center">
                                <?php if (get_sub_field('video_feedback')) {
                                    ?>
                                    <div class="item__video">
                                        <video class="video" height="196" style="width: 100%">
                                            <source src="<?php echo get_sub_field('link_on_video'); ?>" type="video/mp4"
                                                    id="theVideo">
                                        </video>
                                        <div class="play">
                                            <img src="/wp-content/uploads/2022/08/Polygon-1.svg" alt loading="lazy">
                                        </div>
                                    </div>
                                    <?php
                                } else {
                                    ?>
                                    <div class="item__text">
                                        <p><?php the_sub_field('text_feedback'); ?></p>
                                    </div>
                                    <?php
                                } ?>


                                <div class="item__user d-flex">
                                    <div class="image"
                                         style="--bg-img: url(<?php the_sub_field('person_picture'); ?>)"></div>
                                    <div class="sign">
                                        <p><?php the_sub_field('person_name'); ?></p>
                                    </div>
                                </div>
                            </li>
                        <?php endwhile; ?>
                    <?php endif; ?>
                </ul>
            </div>
            <div class="container">
                <?php
                $testimonial_free_consl = get_field('testimonial_free_consl');
                if ($testimonial_free_consl):
                    $link_url = $testimonial_free_consl['url'];
                    $link_title = $testimonial_free_consl['title'];
                    $link_target = $testimonial_free_consl['target'] ? $testimonial_free_consl['target'] : '_self';
                    ?>
                    <a class="btn btn_secondary btn_large" href="<?php echo esc_url($link_url); ?>"
                       target="<?php echo esc_attr($link_target); ?>"><?php echo esc_html($link_title); ?></a>
                <?php endif; ?>
            </div>
        </div>
    </section>
<?php
get_footer();
