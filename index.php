<?php
$host = "localhost";
$user = "root";
$pass = "";
$db   = "sri_periyandavar";

try {
    $pdo = new PDO("mysql:host=$host;dbname=$db", $user, $pass);
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    $stmt = $pdo->query("SELECT * FROM products WHERE is_hidden = 0 ORDER BY id DESC");
    $products = $stmt->fetchAll(PDO::FETCH_ASSOC);
    
    // Pagination logic (5 items per page)
    $itemsPerPage = 5;
    $totalProducts = count($products);
    $totalPages = ceil($totalProducts / $itemsPerPage);
    
    $page = isset($_GET['page']) ? (int)$_GET['page'] : 1;
    if ($page < 1) $page = 1;
    if ($page > $totalPages && $totalPages > 0) $page = $totalPages;
    
    $offset = ($page - 1) * $itemsPerPage;
    $currentProducts = array_slice($products, $offset, $itemsPerPage);

} catch (PDOException $e) {
    $products = [];
    $totalProducts = 0;
    $totalPages = 1;
    $page = 1;
    $currentProducts = [];
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>ஸ்ரீ பெரியாண்டவர் ஆட்டோ கன்சல்டிங்</title>
    <meta name="description" content="Authorized dealer for high-quality cars and heavy-duty trucks. Expert automotive consulting and sales in your service.">
    
    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;600&family=Outfit:wght@700;800&display=swap" rel="stylesheet">
    
    <!-- Icons -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    
    <!-- Styles -->
    <link rel="stylesheet" href="index.css?v=<?php echo time(); ?>">

    <!--
        ONE-VEHICLE-PER-SCREEN FIX
        ---------------------------------------------------------------
        Root cause of "more than one vehicle visible / awkward partial
        scroll" at 100% zoom: .product-section was likely using
        min-height: 100vh (which lets content grow taller than the
        viewport) with no scroll-snap, so scrolling stops at any
        arbitrary point between two vehicle sections.

        Fix: lock every .product-section to EXACTLY one viewport tall,
        and turn on CSS scroll-snap so the browser always settles on a
        full vehicle section, never a partial view of two at once.

        If your real navbar height differs from 84px, change the two
        "84px" values below to match (open devtools > inspect #navbar
        > check its rendered height).
    -->
    <style id="one-vehicle-per-screen-fix">
        :root {
            --navbar-height: 84px; /* <-- adjust if your navbar is a different height */
        }

        html {
            scroll-behavior: smooth;
        }

        /* The scrolling container: turn on mandatory vertical snapping */
        body {
            scroll-snap-type: y mandatory;
            overflow-y: auto;
            height: 100vh;
        }

        /* Each vehicle takes up exactly one screen, no more, no less.
           No inner scrollbar here on purpose — if content is taller than
           the screen, JS below shrinks it to fit instead of scrolling it.
           This keeps you with ONE scrollbar (the page's own). */
        .product-section {
            min-height: 100vh !important;
            height: 100vh !important;
            box-sizing: border-box !important;
            padding-top: var(--navbar-height) !important;
            margin-top: 0 !important;
            scroll-margin-top: 0 !important;
            scroll-snap-align: start;
            scroll-snap-stop: always;
            overflow: hidden;
            display: flex;
            align-items: flex-start;
            justify-content: center;
            padding: initial;
        }

        .product-section .product-view-container {
            zoom: 1; /* JS adjusts this per-section to shrink-fit content */
            width: 100%;
        }

        /* Trust badges strip — fills the empty space under the thumbnails */
        .trust-badges {
            display: grid;
            grid-template-columns: repeat(5, 1fr);
            gap: 12px;
            margin-top: 20px;
        }
        .trust-badge-item {
            background: #f4f2fc;
            border-radius: 14px;
            padding: 18px 14px;
            text-align: center;
            display: flex;
            flex-direction: column;
            align-items: center;
            gap: 10px;
        }
        .trust-badge-item .badge-icon {
            width: 42px;
            height: 42px;
            display: flex;
            align-items: center;
            justify-content: center;
            border-radius: 50%;
            background: #fff;
            box-shadow: 0 2px 8px rgba(88, 28, 135, 0.12);
            font-size: 1.1rem;
            color: #6d28d9;
        }
        .trust-badge-item .badge-title {
            font-size: 0.85rem;
            font-weight: 700;
            color: #1e1b3a;
            line-height: 1.25;
        }
        .trust-badge-item .badge-sub {
            font-size: 0.72rem;
            color: #7a7a8c;
            line-height: 1.2;
        }
        @media (max-width: 900px) {
            .trust-badges {
                grid-template-columns: repeat(2, 1fr);
            }
        }

        /* Pagination controls + first/last section shouldn't snap oddly */
        .product-section:first-of-type {
            scroll-margin-top: 0;
        }
    </style>
</head>
<body>
    <!-- Quick Nav Sidebar -->
    <div class="quick-nav-sidebar">
        <?php foreach ($products as $index => $product): ?>
            <?php 
                $sidebar_images = [];
                if (!empty($product['images'])) {
                    $decoded = json_decode($product['images'], true);
                    if (is_array($decoded)) $sidebar_images = $decoded;
                }
                if (!empty($product['image']) && !in_array($product['image'], $sidebar_images)) {
                    array_unshift($sidebar_images, $product['image']);
                }
                if (empty($sidebar_images)) $sidebar_images[] = 'assets/hero.png';
                $cover = $sidebar_images[0];
                $pageNum = floor($index / 5) + 1;
            ?>
            <a href="?page=<?php echo $pageNum; ?>#product-<?php echo $product['id']; ?>" class="quick-nav-item <?php echo ($pageNum == $page) ? 'active' : ''; ?>" title="<?php echo htmlspecialchars($product['name']); ?>">
                <img src="<?php echo $cover; ?>" alt="<?php echo htmlspecialchars($product['name']); ?>">
            </a>
        <?php endforeach; ?>
    </div>

        <!-- Navigation -->
    <nav id="navbar">
        <div class="nav-content">
            <a href="#" class="logo">
                <img src="assets/logo.png" alt="SPAC Logo" class="logo-img">
                <div class="logo-text">
                    <span class="logo-title">Shri Periyandavar</span>
                    <span class="logo-subtitle">Auto Consulting</span>
                </div>
            </a>
            <div class="menu-toggle" id="mobile-menu">
                <i class="fas fa-bars"></i>
            </div>
            <ul class="nav-links">
                <li><a href="#home">Home</a></li>
                <li><a href="#vehicles">Vehicles</a></li>
                <li><a href="#services">Services</a></li>
                <li><a href="#about">About</a></li>
                <li class="dropdown">
                    <a href="#" class="btn-primary dropdown-toggle" style="padding: 10px 20px;">Category <i class="fas fa-chevron-down"></i></a>
                    <ul class="dropdown-menu">
                        <li><a href="#yodha">TATA (Yodha)</a></li>
                        <li><a href="https://wa.me/c/918098364254" target="_blank">ASHOKLEYLAND</a></li>
                        <li><a href="#maximo">MAHINDRA (Maxximo)</a></li>
                        <li><a href="#carrier">MARUTI SUZUKI (Super Carry)</a></li>
                        <li><a href="https://wa.me/c/918098364254" target="_blank">Others</a></li>
                    </ul>
                </li>
                <li><a href="#contact" class="btn-primary" style="padding: 10px 20px;">Contact Us</a></li>
            </ul>
        </div>
    </nav>

    <!-- Dynamic Product Sections -->
    <?php if ($totalProducts > 0 && !empty($currentProducts)): ?>
    <?php foreach ($currentProducts as $displayIndex => $product): ?>
    <?php
        $images = [];
        if (!empty($product['images'])) {
            $decoded = json_decode($product['images'], true);
            if (is_array($decoded)) $images = $decoded;
        }
        if (!empty($product['image']) && !in_array($product['image'], $images)) {
            array_unshift($images, $product['image']);
        }
        if (empty($images)) $images[] = 'assets/hero.png';
        
        $mainImage = $images[0];
        $phone_number = "918098364254";
        if(!empty($product['contact'])) {
            $phone_number = "91" . ltrim($product['contact'], '+91'); 
        }
        $whatsapp_text = urlencode("I'm interested in the " . $product['name']);
        
        // Ensure unique IDs for JS
        $uniqueId = "main-img-" . $product['id'];
    ?>
    <section class="section product-section" id="product-<?php echo $product['id']; ?>">
        <div class="container product-view-container">
            
            <div class="product-gallery">
                <div class="breadcrumbs">
                    <a href="#">HOME</a> <i class="fas fa-chevron-right"></i> <a href="#">VEHICLES</a> <i class="fas fa-chevron-right"></i> <a href="#"><?php echo strtoupper(explode(' ', htmlspecialchars($product['name']))[0]); ?> CARS</a> <i class="fas fa-chevron-right"></i> <span><?php echo strtoupper(htmlspecialchars($product['name'])); ?></span>
                </div>
                <div class="main-image reveal active">
                    <button class="main-nav prev"><i class="fas fa-chevron-left"></i></button>
                    <img id="<?php echo $uniqueId; ?>" src="<?php echo $mainImage; ?>" alt="<?php echo htmlspecialchars($product['name']); ?>" onclick="openImageModal(this.src)" style="cursor: zoom-in;">
                    <button class="main-nav next"><i class="fas fa-chevron-right"></i></button>
                    <div class="image-counter" id="counter-<?php echo $uniqueId; ?>">1/<?php echo count($images); ?></div>
                </div>
                <div class="thumbnails-wrapper reveal active">
                    <button class="thumb-nav" onclick="scrollThumbs('thumbs-<?php echo $product['id']; ?>', -1)"><i class="fas fa-chevron-left"></i></button>
                    <div class="thumbnails" id="thumbs-<?php echo $product['id']; ?>">
                        <?php foreach ($images as $imgIndex => $imgSrc): ?>
                            <img src="<?php echo $imgSrc; ?>" alt="View <?php echo $imgIndex + 1; ?>" class="<?php echo $imgIndex === 0 ? 'active' : ''; ?>" onclick="changeGalleryImage(this, '<?php echo $uniqueId; ?>', <?php echo $imgIndex; ?>, <?php echo count($images); ?>)">
                        <?php endforeach; ?>
                    </div>
                    <button class="thumb-nav" onclick="scrollThumbs('thumbs-<?php echo $product['id']; ?>', 1)"><i class="fas fa-chevron-right"></i></button>
                </div>

                <div class="trust-badges reveal active">
                    <div class="trust-badge-item">
                        <div class="badge-icon"><i class="fas fa-shield-alt"></i></div>
                        <span class="badge-title">6 Months Warranty</span>
                        <span class="badge-sub">Our promise to you</span>
                    </div>
                    <div class="trust-badge-item">
                        <div class="badge-icon"><i class="fas fa-rotate-left"></i></div>
                        <span class="badge-title">5-Day Money Back</span>
                        <span class="badge-sub">Love it or return it</span>
                    </div>
                    <div class="trust-badge-item">
                        <div class="badge-icon"><i class="fas fa-hand-holding-dollar"></i></div>
                        <span class="badge-title">Lowest EMIs</span>
                        <span class="badge-sub">Drive home today</span>
                    </div>
                    <div class="trust-badge-item">
                        <div class="badge-icon"><i class="fas fa-truck-fast"></i></div>
                        <span class="badge-title">Hand-Picked Vehicle</span>
                        <span class="badge-sub">Inspected & verified</span>
                    </div>
                    <div class="trust-badge-item">
                        <div class="badge-icon"><i class="fas fa-award"></i></div>
                        <span class="badge-title">Quality Assured</span>
                        <span class="badge-sub">Checked by our experts</span>
                    </div>
                </div>
            </div>

            <div class="product-info-wrapper">
                <div class="product-info reveal active">
                    <div class="product-header">
                        <div>
                            <h2 class="product-title"><?php echo htmlspecialchars($product['name']); ?></h2>
                            <p class="product-subtitle">
                                <?php echo htmlspecialchars($product['kms'] ?? '-'); ?> kms • 
                                <?php echo htmlspecialchars($product['fuel'] ?? '-'); ?> • 
                                <?php echo htmlspecialchars($product['transmission'] ?? '-'); ?>
                            </p>
                        </div>
                        <div class="shortlist-icon">
                            <div class="heart-circle">
                                <i class="far fa-heart"></i>
                            </div>
                            <span>109 people</span>
                        </div>
                    </div>
                    

                    
                    <div class="product-extra-details" style="margin-top: 10px; margin-bottom: 10px;">
                        <h3 class="details-heading" style="font-size: 1rem; margin-bottom: 10px; border-bottom: none; padding-bottom: 0;">Vehicle Details</h3>
                        <div class="details-grid" style="grid-template-columns: repeat(2, 1fr); gap: 10px; margin-bottom: 10px;">
                            <div class="detail-item">
                                <i class="fas fa-calendar-alt"></i>
                                <div>
                                    <span class="detail-label" style="font-size: 0.75rem;">Make Year</span>
                                    <span class="detail-value" style="font-size: 0.85rem;"><?php echo htmlspecialchars($product['year'] ?? '-'); ?></span>
                                </div>
                            </div>
                            <div class="detail-item">
                                <i class="fas fa-user"></i>
                                <div>
                                    <span class="detail-label" style="font-size: 0.75rem;">Ownership</span>
                                    <span class="detail-value" style="font-size: 0.85rem;"><?php echo htmlspecialchars($product['owner'] ?? '-'); ?></span>
                                </div>
                            </div>
                            <div class="detail-item">
                                <i class="fas fa-file-contract"></i>
                                <div>
                                    <span class="detail-label" style="font-size: 0.75rem;">Fitness</span>
                                    <span class="detail-value" style="font-size: 0.85rem;"><?php echo htmlspecialchars($product['fitness'] ?? '-'); ?></span>
                                </div>
                            </div>
                            <div class="detail-item">
                                <i class="fas fa-shield-alt"></i>
                                <div>
                                    <span class="detail-label" style="font-size: 0.75rem;">Insurance</span>
                                    <span class="detail-value" style="font-size: 0.85rem;"><?php echo htmlspecialchars($product['insurance'] ?? '-'); ?></span>
                                </div>
                            </div>
                            <div class="detail-item">
                                <i class="fas fa-file-invoice-dollar"></i>
                                <div>
                                    <span class="detail-label" style="font-size: 0.75rem;">Tax</span>
                                    <span class="detail-value" style="font-size: 0.85rem;"><?php echo htmlspecialchars($product['tax'] ?? '-'); ?></span>
                                </div>
                            </div>
                            <div class="detail-item">
                                <i class="fas fa-map-marker-alt"></i>
                                <div>
                                    <span class="detail-label" style="font-size: 0.75rem;">Location</span>
                                    <span class="detail-value" style="font-size: 0.85rem;"><?php echo htmlspecialchars($product['location'] ?? '-'); ?></span>
                                </div>
                            </div>
                            <div class="detail-item">
                                <i class="fas fa-check-circle"></i>
                                <div>
                                    <span class="detail-label" style="font-size: 0.75rem;">Condition</span>
                                    <span class="detail-value" style="font-size: 0.85rem;"><?php echo htmlspecialchars($product['condition_text'] ?? '-'); ?></span>
                                </div>
                            </div>
                        </div>
                        <?php if(!empty($product['comment'])): ?>
                        <div class="product-description" style="padding: 10px; margin-top: 10px;">
                            <h4 class="description-heading" style="font-size: 0.9rem; margin-bottom: 3px;">Seller's Note</h4>
                            <p style="font-size: 0.8rem; margin-bottom: 0;"><?php echo nl2br(htmlspecialchars($product['comment'])); ?></p>
                        </div>
                        <?php endif; ?>
                    </div>
                    
                    <div class="product-price-card">
                        <p class="price-label">Car price</p>
                        <h3 class="product-price">₹<?php echo number_format($product['price'] ?? 0); ?></h3>
                        <p class="price-taxes">+On-road charges & taxes</p>
                        
                        <div class="emi-section">
                            <div class="emi-text">
                                <p class="emi-amount">or ₹18,036/m</p>
                                <p class="emi-label">Starting EMI</p>
                            </div>
                            <button class="calculate-emi-btn">Calculate your EMI</button>
                        </div>
                    </div>
                    
                    <div class="product-actions">
                        <a href="https://wa.me/<?php echo $phone_number; ?>?text=<?php echo $whatsapp_text; ?>" target="_blank" class="btn-primary btn-book-now">
                            <span class="btn-title">BOOK NOW</span>
                            <span class="btn-sub">100% refundable</span>
                        </a>
                        <a href="https://wa.me/<?php echo $phone_number; ?>?text=<?php echo $whatsapp_text; ?>" target="_blank" class="btn-primary btn-test-drive">FREE TEST DRIVE</a>
                    </div>
                </div>
                
                <div class="share-section reveal active">
                    <span>Share with a friend :</span>
                    <a href="#"><i class="fas fa-link"></i></a>
                    <a href="#"><i class="fab fa-facebook-f"></i></a>
                    <a href="#"><i class="fab fa-twitter"></i></a>
                    <a href="#"><i class="fas fa-envelope"></i></a>
                </div>
            </div>
            
        </div>
        
    </section>
    <?php endforeach; ?>
    
    <!-- Pagination Controls -->
    <div class="container" style="display: flex; justify-content: space-between; align-items: center; margin-top: 15px; border-top: 1px solid var(--glass-border); padding-top: 15px; padding-bottom: 10px;">
        <?php if ($page > 1): ?>
            <a href="?page=<?php echo $page - 1; ?>" class="btn-primary" style="background: var(--secondary-color); color: #fff; padding: 10px 20px;">&laquo; Previous</a>
        <?php else: ?>
            <div style="width: 110px;"></div>
        <?php endif; ?>
        
        <span style="font-size: 1rem; color: var(--text-muted); font-weight: 600;">Page <?php echo $page; ?> of <?php echo $totalPages; ?></span>

        <?php if ($page < $totalPages): ?>
            <a href="?page=<?php echo $page + 1; ?>" class="btn-primary" style="padding: 10px 20px;">Next &raquo;</a>
        <?php else: ?>
            <div style="width: 110px;"></div>
        <?php endif; ?>
    </div>
    <?php endif; ?>
    
    <!-- Image Zoom Modal -->
    <div id="imageModal" class="image-modal" onclick="closeImageModal(event)">
        <span class="close-modal" onclick="closeImageModal(event)">&times;</span>
        <img class="modal-content" id="modalImg" onclick="toggleZoom(event)">
    </div>

    <script>
        // Modal functions
        function openImageModal(src) {
            const modal = document.getElementById('imageModal');
            const modalImg = document.getElementById('modalImg');
            modal.style.display = "flex";
            modalImg.src = src;
            modalImg.classList.remove('zoomed');
            document.body.style.overflow = 'hidden'; // Prevent scrolling
        }

        function closeImageModal(e) {
            if (e.target.id === 'imageModal' || e.target.classList.contains('close-modal')) {
                document.getElementById('imageModal').style.display = "none";
                document.body.style.overflow = 'auto';
            }
        }

        function toggleZoom(e) {
            e.stopPropagation(); // Prevent modal from closing
            const img = e.target;
            img.classList.toggle('zoomed');
            
            if (img.classList.contains('zoomed')) {
                updateTransformOrigin(e, img);
                img.addEventListener('mousemove', handlePan);
            } else {
                img.removeEventListener('mousemove', handlePan);
                img.style.transformOrigin = 'center center';
            }
        }

        function handlePan(e) {
            updateTransformOrigin(e, e.target);
        }

        function updateTransformOrigin(e, img) {
            // Calculate percentage based on mouse position inside the image
            const x = (e.offsetX / img.offsetWidth) * 100;
            const y = (e.offsetY / img.offsetHeight) * 100;
            img.style.transformOrigin = `${x}% ${y}%`;
        }

        function scrollThumbs(containerId, direction) {
            const container = document.getElementById(containerId);
            if (container) {
                // Scroll by 90px (80px thumbnail width + 10px gap)
                container.scrollBy({ left: direction * 90, behavior: 'smooth' });
            }
        }

        function changeGalleryImage(thumbnail, mainImgId, index, total) {
            document.getElementById(mainImgId).src = thumbnail.src;
            
            // Update active state
            let container = thumbnail.parentElement;
            let thumbs = container.getElementsByTagName('img');
            for(let i = 0; i < thumbs.length; i++) {
                thumbs[i].classList.remove('active');
            }
            thumbnail.classList.add('active');
            
            // Update counter
            let counter = document.getElementById('counter-' + mainImgId);
            if(counter) {
                counter.innerText = (index + 1) + '/' + total;
            }
        }

        /* ---------------------------------------------------------------
           SHRINK-TO-FIT: keeps exactly ONE scrollbar (the page's own).
           Instead of letting a tall vehicle card create its own inner
           scrollbar, we shrink that card's content (via CSS zoom) so it
           fits inside one screen, like "fit to page" scaling.
           --------------------------------------------------------------- */
        const MIN_ZOOM = 0.55; // don't shrink content below 55% no matter what

        function fitVehicleSections() {
            const navbar = document.getElementById('navbar');
            const navbarHeight = navbar ? navbar.offsetHeight : 84;
            const bottomBuffer = 16;

            // Keep the CSS variable in sync with the navbar's REAL current
            // height (it can differ from our guess, or change if the navbar
            // shrinks/grows on scroll) so every section's top padding lines
            // up with the navbar consistently.
            document.documentElement.style.setProperty('--navbar-height', navbarHeight + 'px');

            document.querySelectorAll('.product-section').forEach(function (section) {
                // Force this directly on the element with !important — this is
                // the highest-priority way to set a style in CSS, so it beats
                // any other script (e.g. a scroll-reveal animation) that resets
                // padding on this element via its own inline style.
                section.style.setProperty('padding-top', navbarHeight + 'px', 'important');
                section.style.setProperty('height', '100vh', 'important');
                section.style.setProperty('min-height', '100vh', 'important');
            });

            document.querySelectorAll('.product-section').forEach(function (section) {
                const container = section.querySelector('.product-view-container');
                if (!container) return;

                // Reset to natural size first so we measure true content height
                container.style.zoom = 1;

                const available = window.innerHeight - navbarHeight - bottomBuffer;
                const natural = container.scrollHeight;

                if (natural > available) {
                    const ratio = Math.max(available / natural, MIN_ZOOM);
                    container.style.zoom = ratio;
                } else {
                    container.style.zoom = 1;
                }
            });
        }

        function debounce(fn, delay) {
            let t;
            return function () {
                clearTimeout(t);
                t = setTimeout(fn, delay);
            };
        }

        document.addEventListener('DOMContentLoaded', function () {
            const navbar = document.getElementById('navbar');
            if (navbar) {
                document.documentElement.style.setProperty('--navbar-height', navbar.offsetHeight + 'px');
            }
        });

        window.addEventListener('load', fitVehicleSections);
        window.addEventListener('resize', debounce(fitVehicleSections, 150));

        // Guard: if any other script (e.g. a scroll-reveal animation) rewrites
        // a section's inline style and wipes out our forced padding-top,
        // re-apply it immediately instead of waiting for the next resize.
        (function guardSectionPadding() {
            let reapplying = false;
            const observer = new MutationObserver(function (mutations) {
                if (reapplying) return;
                const navbar = document.getElementById('navbar');
                const navbarHeight = navbar ? navbar.offsetHeight : 84;
                const wanted = navbarHeight + 'px';

                mutations.forEach(function (m) {
                    const el = m.target;
                    if (!(el instanceof HTMLElement) || !el.classList.contains('product-section')) return;
                    if (el.style.paddingTop !== wanted) {
                        reapplying = true;
                        el.style.setProperty('padding-top', wanted, 'important');
                        el.style.setProperty('height', '100vh', 'important');
                        el.style.setProperty('min-height', '100vh', 'important');
                        reapplying = false;
                    }
                });
            });

            document.querySelectorAll('.product-section').forEach(function (section) {
                observer.observe(section, { attributes: true, attributeFilter: ['style'] });
            });
        })();

        // Images loading late can change content height — re-fit once they're in
        document.querySelectorAll('.product-section img').forEach(function (img) {
            if (!img.complete) {
                img.addEventListener('load', debounce(fitVehicleSections, 150));
            }
        });
    </script>
</body>
</html>