<!doctype html>
<html <?php language_attributes(); ?>>
<head>
<meta charset="<?php bloginfo('charset'); ?>">
<meta name="viewport" content="width=device-width,initial-scale=1">
<script>document.documentElement.classList.add("js");setTimeout(function(){window.__rv||document.documentElement.classList.add("rv-fallback")},4000)</script>
<link rel="icon" type="image/png" href="<?php echo esc_url(get_template_directory_uri()); ?>/assets/logo-header.png">
<?php wp_head(); ?>
</head>
<body <?php body_class(); ?>>
<?php wp_body_open(); ?>
<a class="skip" href="#main">Skip to main content</a>
<header class="nav"><div class="wrap">
  <a href="<?php echo esc_url(home_url('/')); ?>" class="logo"><img src="<?php echo esc_url(get_template_directory_uri()); ?>/assets/logo-header.png" alt="Executel Communications" width="256" height="116"></a>
  <button class="menu-btn" aria-label="Menu">☰</button>
  <nav aria-label="Main">
    <a href="<?php echo esc_url(home_url('/')); ?>">Home</a>
    <div class="dd"><a href="<?php echo esc_url(executel_url('services')); ?>">Services ▾</a><div><ul>
      <li><a href="<?php echo esc_url(executel_url('call-center-services')); ?>">Call Center Services</a></li>
      <li><a href="<?php echo esc_url(executel_url('answering-services')); ?>">Answering Services</a></li>
      <li><a href="<?php echo esc_url(executel_url('medical-answering-services')); ?>">Medical Answering Service</a></li>
      <li><a href="<?php echo esc_url(executel_url('after-hours-answering-services')); ?>">After Hours Answering Service</a></li>
    </ul></div></div>
    <div class="dd"><a href="<?php echo esc_url(executel_url('ai-agents')); ?>">AI Solutions ▾</a><div><ul>
      <li><a href="<?php echo esc_url(executel_url('ai-agents')); ?>">AI Voice Agents (AI only)</a></li>
      <li><a href="<?php echo esc_url(executel_url('ai-plus-human')); ?>">AI + Human Hybrid</a></li>
    </ul></div></div>
    <div class="dd"><a href="<?php echo esc_url(executel_url('contact')); ?>">Contact ▾</a><div><ul>
      <li><a href="<?php echo esc_url(executel_url('contact')); ?>">Contact Us</a></li>
      <li><a href="<?php echo esc_url(executel_url('data-privacy-questions')); ?>">Data Privacy Questions</a></li>
    </ul></div></div>
    <a href="https://secure2.executel.biz/">Login</a>
    <a class="btn primary sm" href="<?php echo esc_url(executel_url('free-trial')); ?>">Free Trial</a>
  </nav>
</div></header>
