<?php
// 1. STRICT CORS HEADERS FOR SECURE SESSIONS
if (isset($_SERVER['HTTP_ORIGIN'])) {
    header("Access-Control-Allow-Origin: {$_SERVER['HTTP_ORIGIN']}");
} else {
    header("Access-Control-Allow-Origin: http://localhost");
}
header("Access-Control-Allow-Credentials: true");
header("Access-Control-Allow-Methods: POST, GET, OPTIONS");
header("Access-Control-Allow-Headers: Content-Type, Authorization");
header("Content-Type: application/json; charset=UTF-8");

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

require 'PHPMailer/src/Exception.php';
require 'PHPMailer/src/PHPMailer.php';
require 'PHPMailer/src/SMTP.php';

// Handle preflight requests from the browser
if ($_SERVER['REQUEST_METHOD'] == 'OPTIONS') {
    exit(0);
}

// 2. START SECURE SESSION (10 Years)
session_set_cookie_params(10 * 365 * 24 * 60 * 60);
session_start();

// 3. DATABASE CONNECTION
// $host = "localhost";
// $user = "u608454033_bagathsingh";      // Default XAMPP username
// $pass = "*3G|ezndJr0r";          // Default XAMPP password is empty
// $db   = "u608454033_bagathsingh_db";


$host = "localhost";
$user = "root";      // Default XAMPP username
$pass = "";          // Default XAMPP password is empty
$db   = "sri_Periyandavar";



try {
    $pdo = new PDO("mysql:host=$host;dbname=$db", $user, $pass);
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch (PDOException $e) {
    die(json_encode(["error" => "Database connection failed: " . $e->getMessage()]));
}

function sendEmailOTP($email, $otp) {
    $mail = new PHPMailer(true);
    try {
        $mail->isSMTP();
        $mail->Host = 'smtp.gmail.com';
        $mail->SMTPAuth = true;
        $mail->Username = 'bagathsinghfish.shop@gmail.com'; // ⚠️ CHANGE THIS
        $mail->Password = 'frpl cvpf ebcl zqkk';   // ⚠️ CHANGE THIS
        $mail->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS;
        $mail->Port = 587;

        $mail->setFrom('bagathsinghfish.shop@gmail.com', 'Sri Periyandavar Auto Consulting'); // ⚠️ CHANGE THIS
        $mail->addAddress($email);
        $mail->isHTML(true);
        $mail->Subject = 'Your OTP for SPAC Login';
        $mail->Body    = "Your verification code is: <b style='font-size: 20px;'>$otp</b>. This code expires in 1 minute.";
        
        $mail->send();
        return true;
    } catch (Exception $e) {
        return false;
    }
}

$action = $_GET['action'] ?? '';
$data = json_decode(file_get_contents("php://input"), true);

// 4. API ENDPOINTS
switch ($action) {

    case 'get_user_orders':
        if (!isset($data['customer_id'])) { die(json_encode(["error" => "Unauthorized"])); }
        $stmt = $pdo->prepare("SELECT * FROM orders WHERE customer_id = ? ORDER BY id DESC");
        $stmt->execute([$data['customer_id']]);
        echo json_encode($stmt->fetchAll(PDO::FETCH_ASSOC));
        break;

    // ==========================================
    // 1. SEND OTP (Handles both SMS and Email)
    // ==========================================
    case 'send_otp':
        $type = $data['type']; // 'phone' or 'email'
        $contact = $data['contact'];

        if ($type === 'email') {
            // -- EMAIL OTP LOGIC --
            $otp = rand(1000, 9999);
            $_SESSION['email_otp'] = $otp;
            $_SESSION['email_verified_target'] = $contact; // Store email in session
            
            if (sendEmailOTP($contact, $otp)) {
                echo json_encode(["responseCode" => 200, "data" => ["verificationId" => "email_session"]]);
            } else {
                echo json_encode(["responseCode" => 500, "message" => "Email failed. Check SMTP settings."]);
            }
        } else {
            // -- SMS OTP LOGIC (MessageCentral API) --
            $phone = $contact;
            $authToken = 'eyJhbGciOiJIUzUxMiJ9.eyJzdWIiOiJDLTBDQjEwRDY3MDFDQzQ4QiIsImlhdCI6MTc3ODkxODQxNCwiZXhwIjoxOTM2NTk4NDE0fQ.G-1Nvd08WCaUXiJ3tnCpCQNyFQqjimC_LVh-QDOy0qHBeaeoeFXmT9A6MuuBXHKApt6nyxZ_a9Y49HftkLaArg';

            $ch = curl_init();
            curl_setopt($ch, CURLOPT_URL, "https://cpaas.messagecentral.com/verification/v3/send?mobileNumber=" . $phone . "&countryCode=91&flowType=SMS&type=OTP");
            curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
            curl_setopt($ch, CURLOPT_POST, 1);
            curl_setopt($ch, CURLOPT_HTTPHEADER, ["authToken: " . $authToken]);
            
            $response = curl_exec($ch);
            curl_close($ch);
            
            echo $response; // Return MessageCentral's exact response
        }
        break;

    // ==========================================
    // 2. VERIFY OTP (Handles both SMS and Email)
    // ==========================================
    case 'verify_otp':
        $type = isset($data['type']) ? $data['type'] : 'phone';
        $otp = $data['otp'];
        $contact = isset($data['phone']) ? $data['phone'] : ''; 
        $isLinking = isset($data['is_linking']) ? $data['is_linking'] : false; // Catch the link flag
        $isValid = false;

        if ($type === 'email') {
            if (isset($_SESSION['email_otp']) && $_SESSION['email_otp'] == $otp) {
                $isValid = true;
                $contact = $_SESSION['email_verified_target']; 
                unset($_SESSION['email_otp']);
            }
        } else {
            $verificationId = $data['verificationId'];
            $customerId = 'C-0CB10D6701CC48B';
            $authToken = 'eyJhbGciOiJIUzUxMiJ9.eyJzdWIiOiJDLTBDQjEwRDY3MDFDQzQ4QiIsImlhdCI6MTc3ODkxODQxNCwiZXhwIjoxOTM2NTk4NDE0fQ.G-1Nvd08WCaUXiJ3tnCpCQNyFQqjimC_LVh-QDOy0qHBeaeoeFXmT9A6MuuBXHKApt6nyxZ_a9Y49HftkLaArg';

            $ch = curl_init();
            curl_setopt($ch, CURLOPT_URL, "https://cpaas.messagecentral.com/verification/v3/validateOtp?code=" . $otp . "&customerId=" . $customerId . "&verificationId=" . $verificationId);
            curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
            curl_setopt($ch, CURLOPT_HTTPHEADER, ["authToken: " . $authToken]);
            
            $response = json_decode(curl_exec($ch), true);
            curl_close($ch);

            if (isset($response['responseCode']) && $response['responseCode'] == 200 && isset($response['data']['verificationStatus']) && $response['data']['verificationStatus'] === 'VERIFICATION_COMPLETED') {
                $isValid = true;
            }
        }

        if ($isValid) {
            // If we are strictly LINKING a phone, stop here. Do NOT create a user.
            if ($isLinking) {
                echo json_encode(["status" => "success", "message" => "OTP Verified for linking"]);
                exit;
            }

            $stmt = $pdo->prepare("SELECT * FROM users WHERE email = ? OR phone = ?");
            $stmt->execute([$contact, $contact]);
            $user = $stmt->fetch(PDO::FETCH_ASSOC);

            if (!$user) {
                if ($type === 'email') {
                    $stmt = $pdo->prepare("INSERT INTO users (email, role, name) VALUES (?, 'customer', ?)");
                    $stmt->execute([$contact, $contact]); 
                } else {
                    // Force null instead of blank string if missing
                    $phoneParam = trim($contact) !== '' ? trim($contact) : null;
                    $stmt = $pdo->prepare("INSERT INTO users (phone, role, name) VALUES (?, 'customer', ?)");
                    $stmt->execute([$phoneParam, $contact]); 
                }
                
                $userId = $pdo->lastInsertId();
                $stmt = $pdo->prepare("SELECT * FROM users WHERE id = ?");
                $stmt->execute([$userId]);
                $user = $stmt->fetch(PDO::FETCH_ASSOC);
            }

            echo json_encode(["status" => "success", "user" => $user]);
        } else {
            echo json_encode(["status" => "error", "message" => "Invalid OTP"]);
        }
        break;
        
    // ==========================================
    // 3. GOOGLE LOGIN HANDLER
    // ==========================================
    case 'google_login':
        $email = $data['email'];
        $name = $data['name']; // Keep the Google name directly

        $stmt = $pdo->prepare("SELECT * FROM users WHERE email = ?");
        $stmt->execute([$email]);
        $user = $stmt->fetch(PDO::FETCH_ASSOC);

        if (!$user) {
            $stmt = $pdo->prepare("INSERT INTO users (email, name, role) VALUES (?, ?, 'customer')");
            $stmt->execute([$email, $name]);
            $userId = $pdo->lastInsertId();
            echo json_encode(["status" => "needs_phone", "user_id" => $userId, "email" => $email]);
        } else {
            // Existing user. Do they have a phone number?
            if (empty($user['phone'])) {
                echo json_encode(["status" => "needs_phone", "user_id" => $user['id'], "email" => $email]);
            } else {
                echo json_encode(["status" => "success", "user" => $user]);
            }
        }
        break;

    // ==========================================
    // 4. LINK PHONE NUMBER TO GOOGLE ACCOUNT
    // ==========================================
    case 'link_phone':
        $userId = $data['user_id'];
        
        // NULL CONVERSION: Convert empty string to null to prevent Duplicate Entry errors
        $phone = (isset($data['phone']) && trim($data['phone']) !== '') ? trim($data['phone']) : null;

        if ($phone !== null) {
            // First, check if this phone number is already registered to another account
            $stmt = $pdo->prepare("SELECT id FROM users WHERE phone = ?");
            $stmt->execute([$phone]);
            if ($stmt->fetch()) {
                echo json_encode(["status" => "error", "message" => "Phone number already in use by another account."]);
                exit;
            }
        }

        $stmt = $pdo->prepare("UPDATE users SET phone = ? WHERE id = ?");
        $stmt->execute([$phone, $userId]);
        
        $stmt = $pdo->prepare("SELECT * FROM users WHERE id = ?");
        $stmt->execute([$userId]);
        $user = $stmt->fetch(PDO::FETCH_ASSOC);

        echo json_encode(["status" => "success", "user" => $user]);
        break;

    case 'admin_login':
        // Check if the user exists and is an admin
        $stmt = $pdo->prepare("SELECT * FROM users WHERE phone = ? AND role = 'admin'");
        $stmt->execute([$data['username']]);
        $admin = $stmt->fetch(PDO::FETCH_ASSOC);

        // Verify password (Fallback default: admin / admin123)
        if ($admin && $data['password'] === $admin['password']) {
            $_SESSION['admin_logged_in'] = true;
            echo json_encode(["status" => "success"]);
        } else if ($data['username'] === 'admin' && $data['password'] === 'admin123') {
            // Failsafe backdoor in case the database admin password isn't set yet
            $_SESSION['admin_logged_in'] = true;
            echo json_encode(["status" => "success"]);
        } else {
            echo json_encode(["status" => "error", "message" => "Invalid credentials"]);
        }
        break;

    case 'check_session':
        if (isset($_SESSION['admin_logged_in']) && $_SESSION['admin_logged_in'] === true) {
            echo json_encode(["status" => "active"]);
        } else {
            echo json_encode(["status" => "inactive"]);
        }
        break;

    case 'admin_logout':
        session_destroy();
        echo json_encode(["status" => "success"]);
        break;

    case 'login':
        // NULL CONVERSION
        $phone = (isset($data['phone']) && trim($data['phone']) !== '') ? trim($data['phone']) : null;
        
        $stmt = $pdo->prepare("SELECT * FROM users WHERE phone = ?");
        $stmt->execute([$phone]);
        $user = $stmt->fetch(PDO::FETCH_ASSOC);

        if ($user && $user['password'] === $data['password']) {
            echo json_encode(["status" => "success", "user" => $user]);
        } elseif (!$user && $phone !== 'admin' && $phone !== null) {
            // Auto-register new customer
            $stmt = $pdo->prepare("INSERT INTO users (phone, password, role, name) VALUES (?, ?, 'customer', ?)");
            $stmt->execute([$phone, $data['password'], 'Customer ' . $phone]);
            $newId = $pdo->lastInsertId();
            echo json_encode(["status" => "success", "user" => ["id" => $newId, "phone" => $phone, "role" => "customer"]]);
        } else {
            echo json_encode(["status" => "error", "message" => "Invalid credentials"]);
        }
        break;

    case 'reset_password':
        // Optional: Ensure only logged-in admins can trigger a password reset
        if (!isset($_SESSION['admin_logged_in'])) { die(json_encode(["error" => "Unauthorized"])); }
        
        $stmt = $pdo->prepare("UPDATE users SET password = ? WHERE id = ?");
        $stmt->execute([$data['password'], $data['id']]);
        echo json_encode(["status" => "success"]);
        break;

    case 'get_admin_data':
        // Optional: Protect dashboard data so only admins can download it
        if (!isset($_SESSION['admin_logged_in'])) { die(json_encode(["error" => "Unauthorized"])); }
        
        $products = $pdo->query("SELECT * FROM products")->fetchAll(PDO::FETCH_ASSOC);
        
        // --- ADDED 50 DAY FILTER HERE ---
        $orders = $pdo->query("SELECT * FROM orders WHERE delivery_date >= DATE_SUB(CURDATE(), INTERVAL 50 DAY) ORDER BY id DESC")->fetchAll(PDO::FETCH_ASSOC);
        // --------------------------------
        
        // Grab ALL user details, including address, pincode, and GPS
        $users = $pdo->query("SELECT * FROM users")->fetchAll(PDO::FETCH_ASSOC);
        
        echo json_encode(["products" => $products, "orders" => $orders, "users" => $users]);
        break;

    case 'get_products':
        // Only fetch products that are NOT hidden (Safe for public storefront)
        $products = $pdo->query("SELECT * FROM products WHERE is_hidden = 0")->fetchAll(PDO::FETCH_ASSOC);
        echo json_encode($products);
        break;
    
    case 'toggle_visibility':
        if (!isset($_SESSION['admin_logged_in'])) { die(json_encode(["error" => "Unauthorized"])); }
        $stmt = $pdo->prepare("UPDATE products SET is_hidden = ? WHERE id = ?");
        $stmt->execute([$data['is_hidden'], $data['id']]);
        echo json_encode(["status" => "success"]);
        break;

    case 'get_customer_orders':
        $stmt = $pdo->prepare("SELECT * FROM orders WHERE customer_id = ? ORDER BY id DESC");
        $stmt->execute([$_GET['customer_id']]);
        echo json_encode($stmt->fetchAll(PDO::FETCH_ASSOC));
        break;

    case 'add_product':
        if (!isset($_SESSION['admin_logged_in'])) { die(json_encode(["error" => "Unauthorized"])); }
        
        $name = isset($data['name']) ? $data['name'] : '';
        $price = isset($data['price']) ? $data['price'] : 0;
        $category = isset($data['category']) ? $data['category'] : '';
        $stock = isset($data['stock']) ? $data['stock'] : 0;
        $comment = isset($data['comment']) ? $data['comment'] : '';
        $is_hidden = isset($data['is_hidden']) ? (int)$data['is_hidden'] : 0;
        $image = isset($data['image']) ? $data['image'] : null;
        $unit = isset($data['unit']) ? $data['unit'] : 'pcs'; 
        
        $year = isset($data['year']) ? (int)$data['year'] : 2020;
        $kms = isset($data['kms']) ? $data['kms'] : '0';
        $transmission = isset($data['transmission']) ? $data['transmission'] : 'Manual';
        $fuel = isset($data['fuel']) ? $data['fuel'] : 'Petrol';
        $owner = isset($data['owner']) ? $data['owner'] : '1st Owner';
        $condition_text = isset($data['condition_text']) ? $data['condition_text'] : 'Excellent';
        $fitness = isset($data['fitness']) ? $data['fitness'] : '';
        $insurance = isset($data['insurance']) ? $data['insurance'] : '';
        $tax = isset($data['tax']) ? $data['tax'] : '';
        $location = isset($data['location']) ? $data['location'] : 'Madurai';
        $final_offer = (isset($data['final_offer']) && $data['final_offer'] !== '') ? $data['final_offer'] : null;
        $contact = isset($data['contact']) ? $data['contact'] : '8098364254';
        $images = isset($data['images']) ? $data['images'] : null;

        $stmt = $pdo->prepare("INSERT INTO products (name, price, stock, image, category, unit, comment, is_hidden, year, kms, transmission, fuel, owner, condition_text, fitness, insurance, tax, location, final_offer, contact, images) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)");
        $stmt->execute([$name, $price, $stock, $image, $category, $unit, $comment, $is_hidden, $year, $kms, $transmission, $fuel, $owner, $condition_text, $fitness, $insurance, $tax, $location, $final_offer, $contact, $images]);
        
        echo json_encode(["status" => "success"]);
        break;

    case 'adjust_stock':
        $stmt = $pdo->prepare("SELECT stock FROM products WHERE id = ?");
        $stmt->execute([$data['id']]);
        $currentStock = (float) $stmt->fetchColumn();
        
        $newStock = $currentStock;
        if ($data['type'] === 'add') {
            $newStock += (float) $data['qty'];
        } elseif ($data['type'] === 'remove') {
            $newStock -= (float) $data['qty'];
            if ($newStock < 0) $newStock = 0; // Prevent negative stock
        } elseif ($data['type'] === 'set') {
            $newStock = (float) $data['qty'];
        }

        $stmt = $pdo->prepare("UPDATE products SET stock = ? WHERE id = ?");
        $stmt->execute([$newStock, $data['id']]);
        echo json_encode(["status" => "success", "new_stock" => $newStock]);
        break;

    case 'update_product':
        if (!isset($_SESSION['admin_logged_in'])) { die(json_encode(["error" => "Unauthorized"])); }
        
        $name = isset($data['name']) ? $data['name'] : '';
        $price = isset($data['price']) ? $data['price'] : 0;
        $category = isset($data['category']) ? $data['category'] : '';
        $stock = isset($data['stock']) ? $data['stock'] : 0;
        $comment = isset($data['comment']) ? $data['comment'] : '';
        $is_hidden = isset($data['is_hidden']) ? (int)$data['is_hidden'] : 0;
        $id = isset($data['id']) ? $data['id'] : null;
        $unit = isset($data['unit']) ? $data['unit'] : 'pcs'; 
        
        $year = isset($data['year']) ? (int)$data['year'] : 2020;
        $kms = isset($data['kms']) ? $data['kms'] : '0';
        $transmission = isset($data['transmission']) ? $data['transmission'] : 'Manual';
        $fuel = isset($data['fuel']) ? $data['fuel'] : 'Petrol';
        $owner = isset($data['owner']) ? $data['owner'] : '1st Owner';
        $condition_text = isset($data['condition_text']) ? $data['condition_text'] : 'Excellent';
        $fitness = isset($data['fitness']) ? $data['fitness'] : '';
        $insurance = isset($data['insurance']) ? $data['insurance'] : '';
        $tax = isset($data['tax']) ? $data['tax'] : '';
        $location = isset($data['location']) ? $data['location'] : 'Madurai';
        $final_offer = (isset($data['final_offer']) && $data['final_offer'] !== '') ? $data['final_offer'] : null;
        $contact = isset($data['contact']) ? $data['contact'] : '8098364254';
        $images = isset($data['images']) ? $data['images'] : null;

        if (!empty($data['image'])) {
            $stmt = $pdo->prepare("UPDATE products SET name=?, price=?, stock=?, image=?, category=?, unit=?, comment=?, is_hidden=?, year=?, kms=?, transmission=?, fuel=?, owner=?, condition_text=?, fitness=?, insurance=?, tax=?, location=?, final_offer=?, contact=?, images=? WHERE id=?");
            $stmt->execute([$name, $price, $stock, $data['image'], $category, $unit, $comment, $is_hidden, $year, $kms, $transmission, $fuel, $owner, $condition_text, $fitness, $insurance, $tax, $location, $final_offer, $contact, $images, $id]);
        } else {
            $stmt = $pdo->prepare("UPDATE products SET name=?, price=?, stock=?, category=?, unit=?, comment=?, is_hidden=?, year=?, kms=?, transmission=?, fuel=?, owner=?, condition_text=?, fitness=?, insurance=?, tax=?, location=?, final_offer=?, contact=?, images=? WHERE id=?");
            $stmt->execute([$name, $price, $stock, $category, $unit, $comment, $is_hidden, $year, $kms, $transmission, $fuel, $owner, $condition_text, $fitness, $insurance, $tax, $location, $final_offer, $contact, $images, $id]);
        }
        echo json_encode(["status" => "success"]);
        break;

    case 'delete_product':
        if (!isset($_SESSION['admin_logged_in'])) { die(json_encode(["error" => "Unauthorized"])); }
        $stmt = $pdo->prepare("DELETE FROM products WHERE id = ?");
        $stmt->execute([$data['id']]);
        echo json_encode(["status" => "success"]);
        break;

    case 'check_customer':
        // Smart check: Look up by ID first, then Email, then Phone
        if (isset($data['id']) && $data['id'] !== null) {
            $stmt = $pdo->prepare("SELECT * FROM users WHERE id = ?");
            $stmt->execute([$data['id']]);
        } elseif (isset($data['email']) && $data['email'] !== null) {
            $stmt = $pdo->prepare("SELECT * FROM users WHERE email = ?");
            $stmt->execute([$data['email']]);
        } elseif (isset($data['phone']) && $data['phone'] !== null) {
            $stmt = $pdo->prepare("SELECT * FROM users WHERE phone = ?");
            $stmt->execute([$data['phone']]);
        } else {
            echo json_encode(["status" => "not_found"]);
            exit;
        }
        
        $user = $stmt->fetch(PDO::FETCH_ASSOC);
        
        if ($user) {
            echo json_encode(["status" => "success", "user" => $user]);
        } else {
            echo json_encode(["status" => "not_found"]);
        }
        break;

    case 'place_order':
        // NULL CONVERSION
        $customerPhone = (isset($data['customer_phone']) && trim($data['customer_phone']) !== '') ? trim($data['customer_phone']) : null;

        // 1. Check if user exists. If yes -> Update details. If no -> Create new user.
        $stmt = $pdo->prepare("SELECT id FROM users WHERE phone = ?");
        $stmt->execute([$customerPhone]);
        $user = $stmt->fetch(PDO::FETCH_ASSOC);

        if ($user) {
            $customerId = $user['id'];
            $stmt = $pdo->prepare("UPDATE users SET name=?, pincode=?, address_1=?, address_2=?, landmark=?, lat=?, lng=? WHERE id=?");
            $stmt->execute([$data['customer_name'], $data['pincode'], $data['address_1'], $data['address_2'], $data['landmark'], $data['lat'], $data['lng'], $customerId]);
        } else {
            $stmt = $pdo->prepare("INSERT INTO users (phone, name, role, pincode, address_1, address_2, landmark, lat, lng) VALUES (?, ?, 'customer', ?, ?, ?, ?, ?, ?)");
            $stmt->execute([$customerPhone, $data['customer_name'], $data['pincode'], $data['address_1'], $data['address_2'], $data['landmark'], $data['lat'], $data['lng']]);
            $customerId = $pdo->lastInsertId();
        }

        // 2. Insert the Order with Delivery Info AND Items
        $delivery_address = $data['address_1'] . ", " . $data['address_2'] . " - Pincode: " . $data['pincode'] . " (Landmark: " . $data['landmark'] . ")";
        
        $items = isset($data['items']) ? $data['items'] : ''; // <-- CRITICAL: GRABS THE CART DATA
        
        $stmt = $pdo->prepare("INSERT INTO orders (customer_id, customer_phone, total, status, delivery_date, delivery_slot, delivery_address, lat, lng, items) VALUES (?, ?, ?, 'Processing', ?, ?, ?, ?, ?, ?)");
        
        // Ensure $items is the very last variable in this array
        $stmt->execute([$customerId, $customerPhone, $data['total'], $data['delivery_date'], $data['delivery_slot'], $delivery_address, $data['lat'], $data['lng'], $items]);
        
        $orderId = $pdo->lastInsertId();

        echo json_encode(["status" => "success", "order_id" => $orderId, "customer_id" => $customerId]);
        break;

    case 'update_order':
        if (!isset($_SESSION['admin_logged_in'])) { die(json_encode(["error" => "Unauthorized"])); }
        $stmt = $pdo->prepare("UPDATE orders SET status = ? WHERE id = ?");
        $stmt->execute([$data['status'], $data['id']]);
        echo json_encode(["status" => "success"]);
        break;

    default:
        echo json_encode(["error" => "Invalid action"]);
}
?>