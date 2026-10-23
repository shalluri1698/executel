<?php
// Executel Modern theme

add_action('after_setup_theme', function () {
    add_theme_support('title-tag');
    add_theme_support('post-thumbnails');
});

/**
 * Permalink-safe URL for a page slug (works with Plain or Post-name permalinks and nested pages).
 */
function executel_url($slug) {
    static $cache = [];
    if ($slug === '') return home_url('/');
    if (isset($cache[$slug])) return $cache[$slug];
    $found = get_posts(['name' => $slug, 'post_type' => 'page', 'post_status' => 'publish', 'numberposts' => 1, 'no_found_rows' => true]);
    return $cache[$slug] = $found ? get_permalink($found[0]->ID) : home_url('/' . $slug . '/');
}

// Load the web font without blocking first paint (noscript fallback included)
add_filter('style_loader_tag', function ($tag, $handle) {
    if ($handle !== 'executel-font') return $tag;
    return str_replace("media='all'", "media='print' onload=\"this.media='all'\"", $tag) . '<noscript>' . $tag . '</noscript>';
}, 10, 2);

add_action('wp_enqueue_scripts', function () {
    $v = wp_get_theme()->get('Version');
    wp_enqueue_style('executel-font', 'https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700;800&display=swap', [], null);
    wp_enqueue_style('executel-style', get_template_directory_uri() . '/assets/styles.css', ['executel-font'], $v);
    wp_enqueue_script('executel-site', get_template_directory_uri() . '/assets/site.js', [], $v, ['in_footer' => true, 'strategy' => 'defer']);
});

/**
 * On activation: create any page that does not exist yet (matched by slug).
 * Existing pages (same slug) are left untouched and simply pick up the
 * matching page-{slug}.php template. Content is not overwritten.
 */
add_action('after_switch_theme', function () {
    $pages = [
        'services' => 'Our Services',
        'call-center-services' => 'Call Center Services',
        'answering-services' => 'Answering Services',
        'medical-answering-services' => 'Medical Answering Services',
        'after-hours-answering-services' => 'After Hours Answering Services',
        'contact' => 'Contact',
        'free-trial' => 'Free Trial',
        'data-privacy-questions' => 'Data Privacy Questions',
        'privacy-policy' => 'Privacy Policy',
        'terms' => 'Terms',
        'dpa' => 'DPA',
        'ai-agents' => 'AI Voice Agents',
        'ai-plus-human' => 'AI + Human Hybrid',
    ];
    foreach ($pages as $slug => $title) {
        if (!get_page_by_path($slug)) {
            wp_insert_post([
                'post_type'   => 'page',
                'post_status' => 'publish',
                'post_name'   => $slug,
                'post_title'  => $title,
            ]);
        }
    }
    // Make sure a static "Home" page is the front page.
    $home = get_page_by_path('home');
    if (!$home) {
        $id = wp_insert_post(['post_type' => 'page', 'post_status' => 'publish', 'post_name' => 'home', 'post_title' => 'Home']);
        $home = get_post($id);
    }
    if (!get_option('permalink_structure')) {
        update_option('permalink_structure', '/%postname%/');
    }
    update_option('show_on_front', 'page');
    update_option('page_on_front', $home->ID);
    flush_rewrite_rules();
});

/**
 * Technical SEO: per-page title, meta description, Open Graph/Twitter and JSON-LD.
 * Skipped automatically if Yoast SEO or Rank Math is active (they manage this instead).
 */
function executel_seo_data() {
    static $d = null;
    if ($d === null) {
        $json = <<<'EXECUTEL_JSON'
{"org": {"@type": ["LocalBusiness", "ProfessionalService"], "@id": "https://executel.biz/#org", "name": "Executel Communications", "url": "https://executel.biz/", "logo": "https://executel.biz/wp-content/uploads/2025/07/logo-header.png", "image": "https://executel.biz/wp-content/uploads/2026/01/homepage_midpage_310x310.jpg", "description": "Nationwide inbound call center and live answering telephone services for small and large businesses.", "telephone": "+1-800-562-7505", "faxNumber": "+1-508-870-1940", "email": "executelcustsvc@executel.biz", "address": {"@type": "PostalAddress", "streetAddress": "4 Meeting House Road, Suite 14", "addressLocality": "Chelmsford", "addressRegion": "MA", "postalCode": "01824", "addressCountry": "US"}, "areaServed": {"@type": "Country", "name": "United States"}, "openingHoursSpecification": [{"@type": "OpeningHoursSpecification", "dayOfWeek": ["Monday", "Tuesday", "Wednesday", "Thursday", "Friday", "Saturday", "Sunday"], "opens": "00:00", "closes": "23:59"}]}, "pages": {"index": {"title": "Live Call Answering & Call Center Services | Executel", "desc": "Executel provides nationwide inbound call center and live answering services for small and large businesses, 24/7, plus AI voice agents. Free 7-day trial.", "graph": []}, "services": {"title": "Answering Service Features & Solutions | Executel", "desc": "Virtual receptionist, auto attendant, voice mail, order taking, appointment scheduling, wake-up calls and more. Executel designs a solution that gets results.", "graph": [{"@type": "BreadcrumbList", "itemListElement": [{"@type": "ListItem", "position": 1, "name": "Home", "item": "https://executel.biz/"}, {"@type": "ListItem", "position": 2, "name": "Answering Service Features & Solutions", "item": "https://executel.biz/services/"}]}]}, "call-center-services": {"title": "Inbound Call Center Services | Executel", "desc": "Scalable inbound call center services with the fastest pick-up times, real-time analytics, call screening and emergency backup for any call volume.", "graph": [{"@type": "BreadcrumbList", "itemListElement": [{"@type": "ListItem", "position": 1, "name": "Home", "item": "https://executel.biz/"}, {"@type": "ListItem", "position": 2, "name": "Inbound Call Center Services", "item": "https://executel.biz/call-center-services/"}]}, {"@type": "Service", "name": "Inbound Call Center Services", "description": "Scalable inbound call center services with the fastest pick-up times, real-time analytics, call screening and emergency backup for any call volume.", "provider": {"@id": "https://executel.biz/#org"}, "areaServed": "US", "url": "https://executel.biz/call-center-services/"}]}, "answering-services": {"title": "Live Answering Services 24/7 | Executel", "desc": "Highly trained live receptionists answer in your business name 24/7, forward calls, screen, and deliver messages by email, SMS or portal. Free 7-day trial.", "graph": [{"@type": "BreadcrumbList", "itemListElement": [{"@type": "ListItem", "position": 1, "name": "Home", "item": "https://executel.biz/"}, {"@type": "ListItem", "position": 2, "name": "Live Answering Services 24/7", "item": "https://executel.biz/answering-services/"}]}, {"@type": "Service", "name": "Live Answering Services 24/7", "description": "Highly trained live receptionists answer in your business name 24/7, forward calls, screen, and deliver messages by email, SMS or portal. Free 7-day trial.", "provider": {"@id": "https://executel.biz/#org"}, "areaServed": "US", "url": "https://executel.biz/answering-services/"}]}, "medical-answering-services": {"title": "Medical Answering Service, HIPAA-Aware | Executel", "desc": "Medical answering for doctors, dentists, hospitals and hospice: secure messages, appointment scheduling and after-hours emergency support, 24/7.", "graph": [{"@type": "BreadcrumbList", "itemListElement": [{"@type": "ListItem", "position": 1, "name": "Home", "item": "https://executel.biz/"}, {"@type": "ListItem", "position": 2, "name": "Medical Answering Service, HIPAA-Aware", "item": "https://executel.biz/medical-answering-services/"}]}, {"@type": "Service", "name": "Medical Answering Service, HIPAA-Aware", "description": "Medical answering for doctors, dentists, hospitals and hospice: secure messages, appointment scheduling and after-hours emergency support, 24/7.", "provider": {"@id": "https://executel.biz/#org"}, "areaServed": "US", "url": "https://executel.biz/medical-answering-services/"}]}, "after-hours-answering-services": {"title": "After Hours Answering Service | Executel", "desc": "Never reach voicemail again. Executel answers after-hours calls in your brand voice, takes messages and patches emergencies. Lower overhead, higher ROI.", "graph": [{"@type": "BreadcrumbList", "itemListElement": [{"@type": "ListItem", "position": 1, "name": "Home", "item": "https://executel.biz/"}, {"@type": "ListItem", "position": 2, "name": "After Hours Answering Service", "item": "https://executel.biz/after-hours-answering-services/"}]}, {"@type": "Service", "name": "After Hours Answering Service", "description": "Never reach voicemail again. Executel answers after-hours calls in your brand voice, takes messages and patches emergencies. Lower overhead, higher ROI.", "provider": {"@id": "https://executel.biz/#org"}, "areaServed": "US", "url": "https://executel.biz/after-hours-answering-services/"}]}, "contact": {"title": "Contact Executel Communications | 800-562-7505", "desc": "Contact Executel Communications in Chelmsford, MA. Call 800-562-7505 or email executelcustsvc@executel.biz to get started with live answering services.", "graph": [{"@type": "BreadcrumbList", "itemListElement": [{"@type": "ListItem", "position": 1, "name": "Home", "item": "https://executel.biz/"}, {"@type": "ListItem", "position": 2, "name": "Contact Executel Communications", "item": "https://executel.biz/contact/"}]}]}, "free-trial": {"title": "Free 7-Day Trial | Executel Communications", "desc": "Start a free, no-obligation 7-day trial of Executel call answering and call center services. No contracts and no credit card required.", "graph": [{"@type": "BreadcrumbList", "itemListElement": [{"@type": "ListItem", "position": 1, "name": "Home", "item": "https://executel.biz/"}, {"@type": "ListItem", "position": 2, "name": "Free 7-Day Trial", "item": "https://executel.biz/free-trial/"}]}]}, "data-privacy-questions": {"title": "Data Privacy Questions | Executel Communications", "desc": "Executel is dedicated to protecting your data privacy and security. Submit your data privacy questions and concerns and we will be in touch shortly.", "graph": [{"@type": "BreadcrumbList", "itemListElement": [{"@type": "ListItem", "position": 1, "name": "Home", "item": "https://executel.biz/"}, {"@type": "ListItem", "position": 2, "name": "Data Privacy Questions", "item": "https://executel.biz/data-privacy-questions/"}]}]}, "privacy-policy": {"title": "Privacy Policy | Executel Communications", "desc": "Read the Executel Communications privacy policy: how we collect, use and protect personal information across our website and call answering services.", "graph": [{"@type": "BreadcrumbList", "itemListElement": [{"@type": "ListItem", "position": 1, "name": "Home", "item": "https://executel.biz/"}, {"@type": "ListItem", "position": 2, "name": "Privacy Policy", "item": "https://executel.biz/privacy-policy/"}]}]}, "terms": {"title": "Terms and Conditions | Executel Communications", "desc": "Service terms and conditions for Executel Communications website use and live answering, call center and related services.", "graph": [{"@type": "BreadcrumbList", "itemListElement": [{"@type": "ListItem", "position": 1, "name": "Home", "item": "https://executel.biz/"}, {"@type": "ListItem", "position": 2, "name": "Terms and Conditions", "item": "https://executel.biz/terms/"}]}]}, "dpa": {"title": "Data Processing Addendum | Executel Communications", "desc": "Executel Communications Data Processing Addendum (DPA) describing how customer personal data is processed in the delivery of our services.", "graph": [{"@type": "BreadcrumbList", "itemListElement": [{"@type": "ListItem", "position": 1, "name": "Home", "item": "https://executel.biz/"}, {"@type": "ListItem", "position": 2, "name": "Data Processing Addendum", "item": "https://executel.biz/dpa/"}]}]}, "ai-agents": {"title": "AI Voice Agents for Phone Calls | Executel", "desc": "Fully automated AI voice agents that answer, qualify, schedule and resolve calls 24/7 with no queues and no missed calls. See how Executel AI works.", "graph": [{"@type": "BreadcrumbList", "itemListElement": [{"@type": "ListItem", "position": 1, "name": "Home", "item": "https://executel.biz/"}, {"@type": "ListItem", "position": 2, "name": "AI Voice Agents for Phone Calls", "item": "https://executel.biz/ai-agents/"}]}, {"@type": "Service", "name": "AI Voice Agents for Phone Calls", "description": "Fully automated AI voice agents that answer, qualify, schedule and resolve calls 24/7 with no queues and no missed calls. See how Executel AI works.", "provider": {"@id": "https://executel.biz/#org"}, "areaServed": "US", "url": "https://executel.biz/ai-agents/"}, {"@type": "FAQPage", "mainEntity": [{"@type": "Question", "name": "Will callers know it's AI?", "acceptedAnswer": {"@type": "Answer", "text": "The agent sounds natural, and we recommend being transparent. You choose whether it introduces itself as an AI assistant."}}, {"@type": "Question", "name": "What if a caller needs a person?", "acceptedAnswer": {"@type": "Answer", "text": "You can set escalation rules. For fully human coverage or a blend, see our AI + Human option."}}, {"@type": "Question", "name": "Is it secure and compliant?", "acceptedAnswer": {"@type": "Answer", "text": "Executel follows strict data-handling protocols and offers a DPA. For healthcare, talk to us about HIPAA requirements for your use case."}}, {"@type": "Question", "name": "Can I try it first?", "acceptedAnswer": {"@type": "Answer", "text": "Yes. Executel offers a customized 7-day trial with no contract and no credit card."}}]}]}, "ai-plus-human": {"title": "AI + Human Call Handling with AI Overflow | Executel", "desc": "Live Executel agents answer first; when call volume spikes, AI picks up the overflow so no caller waits. Compare AI-only, hybrid and human-only coverage.", "graph": [{"@type": "BreadcrumbList", "itemListElement": [{"@type": "ListItem", "position": 1, "name": "Home", "item": "https://executel.biz/"}, {"@type": "ListItem", "position": 2, "name": "AI + Human Call Handling with AI Overflow", "item": "https://executel.biz/ai-plus-human/"}]}, {"@type": "Service", "name": "AI + Human Call Handling with AI Overflow", "description": "Live Executel agents answer first; when call volume spikes, AI picks up the overflow so no caller waits. Compare AI-only, hybrid and human-only coverage.", "provider": {"@id": "https://executel.biz/#org"}, "areaServed": "US", "url": "https://executel.biz/ai-plus-human/"}, {"@type": "FAQPage", "mainEntity": [{"@type": "Question", "name": "How does AI know when to step in?", "acceptedAnswer": {"@type": "Answer", "text": "We set a trigger with you, such as number of waiting callers, wait time, or concurrent calls. When it's crossed, overflow calls route to AI automatically."}}, {"@type": "Question", "name": "Can calls move from AI to a person?", "acceptedAnswer": {"@type": "Answer", "text": "Yes. Escalation rules transfer a call to a live agent with a summary when a caller asks or when the topic is sensitive."}}, {"@type": "Question", "name": "Do I need a new phone number?", "acceptedAnswer": {"@type": "Answer", "text": "No. Forward your existing number and we handle the routing."}}, {"@type": "Question", "name": "Is there a trial?", "acceptedAnswer": {"@type": "Answer", "text": "Yes, Executel offers a customized 7-day trial with no contract and no credit card."}}]}]}}}
EXECUTEL_JSON;
        $d = json_decode($json, true);
    }
    return $d;
}
function executel_seo_slug() {
    if (is_front_page()) return 'index';
    if (is_page()) return get_post_field('post_name', get_queried_object_id());
    return '';
}
function executel_seo_active() {
    return !(defined('WPSEO_VERSION') || defined('RANK_MATH_VERSION'));
}
add_filter('pre_get_document_title', function ($title) {
    if (!executel_seo_active()) return $title;
    $d = executel_seo_data(); $s = executel_seo_slug();
    return isset($d['pages'][$s]) ? $d['pages'][$s]['title'] : $title;
}, 20);
add_action('wp_head', function () {
    if (!executel_seo_active()) return;
    $d = executel_seo_data(); $s = executel_seo_slug();
    if (!isset($d['pages'][$s])) return;
    $p = $d['pages'][$s];
    $url = $s === 'index' ? home_url('/') : executel_url($s);
    $img = get_template_directory_uri() . '/assets/img/homepage_midpage_310x310.jpg';
    echo '<meta name="description" content="' . esc_attr($p['desc']) . '">' . "\n";
    echo '<meta name="theme-color" content="#070b1a">' . "\n";
    echo '<meta property="og:type" content="website">' . "\n";
    echo '<meta property="og:site_name" content="Executel Communications">' . "\n";
    echo '<meta property="og:title" content="' . esc_attr($p['title']) . '">' . "\n";
    echo '<meta property="og:description" content="' . esc_attr($p['desc']) . '">' . "\n";
    echo '<meta property="og:url" content="' . esc_url($url) . '">' . "\n";
    echo '<meta property="og:image" content="' . esc_url($img) . '">' . "\n";
    echo '<meta name="twitter:card" content="summary">' . "\n";
    echo '<meta name="twitter:title" content="' . esc_attr($p['title']) . '">' . "\n";
    echo '<meta name="twitter:description" content="' . esc_attr($p['desc']) . '">' . "\n";
    $org = $d['org'];
    $org['logo'] = get_template_directory_uri() . '/assets/logo-header.png';
    $graph = array_merge([$org], $p['graph']);
    $ld = wp_json_encode(['@context' => 'https://schema.org', '@graph' => $graph], JSON_UNESCAPED_SLASHES | JSON_UNESCAPED_UNICODE);
    $ld = str_replace('https://executel.biz', untrailingslashit(home_url()), $ld);
    echo '<script type="application/ld+json">' . $ld . '</script>' . "\n";
}, 1);
