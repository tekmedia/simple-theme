<?php get_header(); ?>
<section id="slider">
    <?php echo do_shortcode('[image-carousel twbs="3"]'); ?>
</section>
<section id="welcome">
    <div class="container">        
        <?php echo do_shortcode('[tm-preims]'); ?>
    </div>
</section>
<section id="portfolio">
    <div class="container">        
        <?php echo do_shortcode('[tm-theme-portfolio]'); ?>
    </div>
</section>
<section id="review">
    <div class="review_overlay">
        <div class="container">        
            <?php echo do_shortcode('[tm-reivews]'); ?>
        </div>
    </div>
</section>
<section id="contact">
    <div class="container">
        <div class="row">
            <div class="colmd-12">
                <div class="section-title">
                    <h2>Связаться с нами</h2>
                    <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Lorem ipsum dolor sit amet, consectetur adipiscing elit.</p>
                </div>
            </div>
        </div>
        <!--End of row-->
        <div class="row">
            <div class="col-md-6">
                <div class="office">
                    <div class="title">
                        <h5>Контакты</h5>
                    </div>
                    <div class="office_location">
                        <div class="address">
                            <i class="fa fa-map-marker"><span><?php if (get_theme_mod( 'header_address' )) echo get_theme_mod( 'header_address' ); ?></span></i>
                        </div>
                        <div class="phone">
                            <i class="fa fa-phone"><span><?php if (get_theme_mod( 'header_phone' )) echo '<a href="tel:' . get_theme_mod( 'header_phone' ) . '">' . get_theme_mod( 'header_phone' ) . '</a>'; ?></span></i>
                        </div>
                        <div class="email">
                            <i class="fa fa-envelope"><span><?php if (get_theme_mod( 'header_email' )) echo get_theme_mod( 'header_email' ); ?></span></i>
                        </div>
                        <div id="map"></div>
                    </div>
                </div>
            </div>
            <div class="col-md-6">
                <div class="msg">
                    <div class="msg_title">
                        <h5>Оправьте сообщение</h5>
                    </div>
                    <div class="form_area">
                        <!-- CONTACT FORM -->
                        <div class="contact-form wow fadeIn animated" data-wow-offset="10" data-wow-duration="1.5s">
                            <div id="message"></div>
                            <form action="includes/mail.php" class="form-horizontal contact-1" role="form" name="contactform" id="contactform">
                                <div class="form-group">
                                    <div class="col-sm-6">
                                        <input type="text" class="form-control" name="name" id="name" placeholder="Как вас зовут?">
                                    </div>
                                    <div class="col-sm-6">
                                        <input type="text" class="form-control" name="email" id="email" placeholder="Email">
                                    </div>
                                </div>
                                <div class="form-group">
                                    <div class="col-sm-12">
                                        <input type="subject" class="form-control" name="subject" id="subject" placeholder="Тема сообщения">
                                        <div class="text_area">
                                            <textarea name="message" id="msg" class="form-control" cols="30" rows="8" placeholder="Текст сообщения"></textarea>
                                        </div>
                                        <button type="submit" class="btn custom-btn" data-loading-text="Отправка...">Отправить</button>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
            <script src="https://api-maps.yandex.ru/2.1/?lang=ru_RU" type="text/javascript"></script>
            <script type="text/javascript">
                ymaps.ready(function () {
                    var myGeocoder = ymaps.geocode("<?php if (get_theme_mod( 'header_address' )) echo get_theme_mod( 'header_address' ); ?>");
                    myGeocoder.then(
                        function (res) {
                            var coords = res.geoObjects.get(0).geometry.getCoordinates();
                            var myMap = new ymaps.Map('map', {
                                center: coords,
                                zoom: 15,
                                behaviors: ['default', 'scrollZoom'],
                                controls: ['zoomControl', 'typeSelector',  'fullscreenControl', 'geolocationControl', 'rulerControl']
                            }, {
                                searchControlProvider: 'yandex#search'
                            }),
                            myPlacemark = new ymaps.Placemark(coords, {
                                hintContent: '<p style="text-align: center"><strong><?php echo bloginfo('name'); ?></strong><br /><?php if (get_theme_mod( 'header_address' )) echo get_theme_mod( 'header_address' ); ?><br /><?php if (get_theme_mod( 'header_phone' )) echo get_theme_mod( 'header_phone' ); ?></p>'
                            }, {
                                // Опции.
                                // Необходимо указать данный тип макета.
                                iconLayout: 'default#image',
                                // Своё изображение иконки метки.
                                //iconImageHref: 'http://kuhniartwood.ru/wp-content/themes/artwood/images/balloon.png',
                                // Размеры метки.
                                //iconImageSize: [55, 86],
                                // Смещение левого верхнего угла иконки относительно
                                // её "ножки" (точки привязки).
                                //iconImageOffset: [-27, -86]
                            });
                        
                        myMap.behaviors.disable('scrollZoom');
                        myMap.geoObjects.add(myPlacemark);
                    });                    
                });
            </script>
        </div>
    </div>
</section>
<?php get_footer(); ?>