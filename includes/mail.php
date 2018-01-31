<?php
$headers = 'From: ' . bloginfo('name') . ' <noreply@' . bloginfo('url') . '>' . "\r\n";
$body = "Имя: " . $_POST['name'] . "\n";
$body .= "E-mail: " . $_POST['email'] . "\n";
$body .= "Тема сообщения: " . $_POST['subject'] . "\n";
$body .= "Текст сообщения: " . $_POST['message'];
$status = wp_mail(bloginfo('admin_email'), 'Сообщение с главной страницы', $body, $headers); ?>

<?php get_header(); ?>
<section class="content">
    <div class="container">
        <div class="post">
            <div class="section-title">
                <h1><?php echo $status; ?></h1>
            </div>
        </div>
    </div>
</section>
<?php get_footer(); ?>