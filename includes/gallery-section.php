<?php
/**
 * Dynamic Gallery Section Template
 * 
 * Required variables before include:
 *   $galleryCompanyId - The company ID to fetch gallery for
 *   $galleryBasePath  - Relative path to root (e.g., '../' for subdirectory pages)
 * 
 * Optional:
 *   $gallerySectionBg - CSS class for background (default: 'bg-light')
 */

if (!isset($galleryBasePath)) $galleryBasePath = '../';
if (!isset($gallerySectionBg)) $gallerySectionBg = 'bg-light';
if (!isset($galleryCompanyId)) $galleryCompanyId = null;

// Include classes if not already included
if (!class_exists('Gallery')) {
    include_once(dirname(__FILE__) . '/../class/include.php');
}

$galleryObj = new Gallery();
$galleryItems = !empty($galleryCompanyId) ? $galleryObj->getByCompany($galleryCompanyId) : [];

// Count by type for filter buttons
$photoCount = 0;
$videoCount = 0;
foreach ($galleryItems as $gi) {
    if ($gi['media_type'] === 'photo') $photoCount++;
    else $videoCount++;
}
$hasMultipleTypes = ($photoCount > 0 && $videoCount > 0);
?>

<!-- Gallery Section -->
<section id="gallery" class="py-5 <?= $gallerySectionBg ?>">
    <div class="container">
        <div class="text-center mb-5" data-aos="fade-up">
            <h2 class="section-title">Our <span class="text-accent">Gallery</span></h2>
            <p class="section-subtitle">Explore our latest photos and videos</p>
        </div>

        <?php if (!empty($galleryItems)): ?>
            <!-- Filter Buttons (only show if both types exist) -->
            <?php if ($hasMultipleTypes): ?>
            <div class="gallery-filters" data-aos="fade-up">
                <button class="gallery-filter-btn active" data-filter="all">All (<?= count($galleryItems) ?>)</button>
                <button class="gallery-filter-btn" data-filter="photo">📷 Photos (<?= $photoCount ?>)</button>
                <button class="gallery-filter-btn" data-filter="video">🎬 Videos (<?= $videoCount ?>)</button>
            </div>
            <?php endif; ?>

            <!-- Gallery Grid -->
            <div class="gallery-grid">
                <?php 
                $delay = 100;
                foreach ($galleryItems as $gi): 
                    // Determine image source
                    $imgSrc = '';
                    if ($gi['media_type'] === 'photo' && !empty($gi['file_name'])) {
                        $imgSrc = $galleryBasePath . 'upload/gallery/' . $gi['file_name'];
                    } elseif (!empty($gi['thumbnail'])) {
                        $imgSrc = $galleryBasePath . 'upload/gallery/' . $gi['thumbnail'];
                    } elseif (!empty($gi['video_url'])) {
                        $ytId = Gallery::getYoutubeId($gi['video_url']);
                        if ($ytId) {
                            $imgSrc = 'https://img.youtube.com/vi/' . $ytId . '/hqdefault.jpg';
                        }
                    }
                    if (empty($imgSrc)) $imgSrc = $galleryBasePath . 'assets/images/about-main.jpg';

                    // Lightbox data
                    $lbSrc = $imgSrc;
                    $lbVideo = '';
                    if ($gi['media_type'] === 'video') {
                        if (!empty($gi['video_url'])) {
                            $lbVideo = $gi['video_url'];
                        } elseif (!empty($gi['file_name'])) {
                            $lbSrc = $galleryBasePath . 'upload/gallery/' . $gi['file_name'];
                        }
                    }

                    $iconClass = $gi['media_type'] === 'photo' ? 'fa-search-plus' : 'fa-play';
                ?>
                <div class="gallery-grid-item gallery-fade-in" 
                     data-type="<?= $gi['media_type'] ?>"
                     data-aos="fade-up" data-aos-delay="<?= $delay ?>"
                     data-lightbox="<?= htmlspecialchars($lbSrc) ?>"
                     data-lightbox-group="agency-gallery"
                     data-lightbox-type="<?= $gi['media_type'] ?>"
                     data-lightbox-title="<?= htmlspecialchars($gi['title'] ?? '') ?>"
                     data-lightbox-video="<?= htmlspecialchars($lbVideo) ?>">
                    
                    <img src="<?= htmlspecialchars($imgSrc) ?>" alt="<?= htmlspecialchars($gi['title'] ?? 'Gallery') ?>" class="img-fluid" loading="lazy">
                    
                    <?php if ($gi['media_type'] === 'video'): ?>
                    <span class="gallery-video-badge"><i class="fas fa-play me-1"></i>Video</span>
                    <?php endif; ?>
                    
                    <div class="gallery-item-overlay">
                        <div class="gallery-item-icon">
                            <i class="fas <?= $iconClass ?>"></i>
                        </div>
                        <?php if (!empty($gi['title'])): ?>
                        <span class="gallery-item-title"><?= htmlspecialchars($gi['title']) ?></span>
                        <?php endif; ?>
                    </div>
                </div>
                <?php 
                    $delay += 100;
                    if ($delay > 400) $delay = 100;
                endforeach; 
                ?>
            </div>
        <?php else: ?>
            <!-- Empty State -->
            <div class="gallery-empty" data-aos="fade-up">
                <i class="fas fa-images d-block"></i>
                <h5>No Gallery Items Yet</h5>
                <p>Photos and videos will appear here soon. Stay tuned!</p>
            </div>
        <?php endif; ?>
    </div>
</section>
