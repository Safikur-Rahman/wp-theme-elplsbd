<?php
/*
Template Name: Careers Page
*/
get_header(); 
$careers_img = get_theme_mod('careers_image', 'https://42f2671d685f51e10fc6-b9fcecea3e50b3b59bdc28dead054ebc.ssl.cf5.rackcdn.com/illustrations/interview_re_e5jn.svg');
$careers_email = get_theme_mod('careers_email', 'careers@elpis.bd');
?>
<main>
    <section id="careers" class="career-section-enterprise">
        <!-- Ambient Decorative Glow Background Orbs -->
        <div class="career-ambient-orb orb-1"></div>
        <div class="career-ambient-orb orb-2"></div>
        <div class="career-grid-pattern"></div>

        <div class="container career-main-container">
            <!-- Header Badge & Title -->
            <div class="career-header-area">
                <div class="career-badge-wrap">
                    <span class="career-pulse-dot"></span>
                    <h2 class="section-title career-badge-title">CAREERS</h2>
                </div>
                <h3 class="career-hero-title">JOIN US</h3>
            </div>

            <!-- Enterprise 2-Column Split Grid -->
            <div class="career-content-grid">
                <!-- Left Column: Levitating Tech Graphic & Ambient Backdrop -->
                <div class="career-visual-col">
                    <div class="career-visual-card">
                        <div class="career-image-halo"></div>
                        <img src="<?php echo esc_url($careers_img); ?>" alt="Join Us" class="hero-image career-floating-img">
                    </div>
                </div>

                <!-- Right Column: Narrative Culture & Interactive CV Drop Hub -->
                <div class="career-info-col">
                    <!-- Manifesto / Value Statement Card -->
                    <div class="career-card career-manifesto-card">
                        <div class="card-accent-bar"></div>
                        <p class="career-desc-text">At ELPIS, we encourage innovation and creativity to drive growth and add value. We love what we do and believe in open communication and transparency, where every idea and suggestion matters. We invest in our people by offering continuous learning and development opportunities. Be a part of our visionary team and grow with us.</p>
                    </div>

                    <!-- CV Submission / Action Pod -->
                    <div class="career-card career-cta-card" id="career-cta-card">
                        <div class="career-cv-prompt-wrap">
                            <span class="cv-prompt-icon">
                                <svg width="22" height="22" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                                    <path d="M22 19a2 2 0 0 1-2 2H4a2 2 0 0 1-2-2V5a2 2 0 0 1 2-2h5l2 3h9a2 2 0 0 1 2 2z"></path>
                                    <line x1="12" y1="11" x2="12" y2="17"></line>
                                    <line x1="9" y1="14" x2="15" y2="14"></line>
                                </svg>
                            </span>
                            <p class="career-cv-label">Drop your CV here-</p>
                        </div>
                        
                        <div class="career-actions-wrap">
                            <button type="button" id="open-cv-modal-btn" class="career-send-btn">
                                <span class="btn-text">Send Resume</span>
                                <svg class="btn-arrow-icon" width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.2" stroke-linecap="round" stroke-linejoin="round">
                                    <line x1="5" y1="12" x2="19" y2="12"></line>
                                    <polyline points="12 5 19 12 12 19"></polyline>
                                </svg>
                            </button>
                            <a href="mailto:<?php echo esc_attr($careers_email); ?>" class="career-email-link">
                                <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                                    <rect width="20" height="16" x="2" y="4" rx="2"></rect>
                                    <path d="m22 7-8.97 5.7a1.94 1.94 0 0 1-2.06 0L2 7"></path>
                                </svg>
                                <span><?php echo esc_html($careers_email); ?></span>
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Enterprise CV Drop Modal Popup -->
    <div id="cv-drop-modal" class="cv-modal-backdrop" style="display: none;">
        <div class="cv-modal-dialog">
            <button type="button" class="cv-modal-close" id="cv-modal-close-btn" title="Close modal">&times;</button>
            
            <div class="cv-modal-header">
                <div class="cv-modal-badge">
                    <span class="career-pulse-dot"></span>
                    <span>CAREERS AT ELPIS</span>
                </div>
                <h3 class="cv-modal-title">Drop Your CV / Resume</h3>
                <p class="cv-modal-subtitle">Join our team of passionate engineers and creative innovators.</p>
            </div>

            <!-- Notification Banner -->
            <div id="cv-alert-box" class="cv-alert-banner" style="display: none;"></div>

            <form id="elpis-cv-form" method="post" enctype="multipart/form-data" class="cv-upload-form">
                <?php wp_nonce_field('elpis_cv_action', 'elpis_cv_nonce'); ?>
                <input type="hidden" name="action" value="elpis_submit_cv">

                <!-- Interactive File Dropzone -->
                <div class="cv-dropzone" id="cv-modal-dropzone">
                    <input type="file" name="cv_file" id="cv-file-input" accept=".pdf,.doc,.docx" required class="cv-hidden-file-input">
                    <div class="cv-dropzone-content" id="cv-dropzone-empty-state">
                        <div class="cv-dropzone-icon">
                            <svg width="34" height="34" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                                <path d="M21 15v4a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2v-4"></path>
                                <polyline points="17 8 12 3 7 8"></polyline>
                                <line x1="12" y1="3" x2="12" y2="15"></line>
                            </svg>
                        </div>
                        <p class="cv-dropzone-text"><strong>Click to browse</strong> or drag & drop your CV here</p>
                        <p class="cv-dropzone-hint">Supports PDF, DOC, DOCX (Up to 10 MB)</p>
                    </div>
                    <div class="cv-file-selected-state" id="cv-dropzone-selected-state" style="display: none;">
                        <span class="cv-selected-icon">&#128196;</span>
                        <div class="cv-selected-info">
                            <span class="cv-selected-name" id="cv-selected-file-name">filename.pdf</span>
                            <span class="cv-selected-size" id="cv-selected-file-size">1.2 MB</span>
                        </div>
                        <button type="button" class="cv-remove-file" id="cv-remove-file-btn" title="Remove file">&times;</button>
                    </div>
                </div>

                <div class="cv-form-grid">
                    <!-- Applicant Full Name -->
                    <div class="cv-form-group">
                        <input type="text" name="applicant_name" placeholder="Full Name *" required class="cv-input">
                    </div>

                    <!-- Email Address -->
                    <div class="cv-form-group">
                        <input type="email" name="applicant_email" placeholder="Email Address *" required class="cv-input">
                    </div>

                    <!-- Phone Number -->
                    <div class="cv-form-group">
                        <input type="tel" name="applicant_phone" placeholder="Phone Number" class="cv-input">
                    </div>

                    <!-- Position of Interest -->
                    <div class="cv-form-group">
                        <input type="text" name="applicant_position" placeholder="Position of Interest (e.g. Software Engineer)" class="cv-input">
                    </div>
                </div>

                <!-- Cover Note / Message -->
                <div class="cv-form-group">
                    <textarea name="applicant_message" rows="3" placeholder="Cover note or brief introduction (optional)..." class="cv-textarea"></textarea>
                </div>

                <!-- Submit Button -->
                <button type="submit" id="cv-submit-btn" class="cv-submit-button">
                    <span class="btn-text">Submit Application</span>
                    <span class="btn-loader" style="display: none;">
                        <svg class="spinner" width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5">
                            <circle cx="12" cy="12" r="10" stroke-opacity="0.25"></circle>
                            <path d="M12 2a10 10 0 0 1 10 10" stroke-linecap="round"></path>
                        </svg>
                    </span>
                </button>
            </form>
        </div>
    </div>

    <style>
    /* Modern Enterprise Careers Section Styling & Micro-Animations */
    .career-section-enterprise {
        position: relative;
        background: linear-gradient(180deg, #f8fafc 0%, #f1f5f9 50%, #e2e8f0 100%);
        padding: 90px 0 110px;
        overflow: hidden;
        min-height: calc(100vh - 200px);
        display: flex;
        align-items: center;
    }

    /* Ambient Tech Lighting Mesh */
    .career-ambient-orb {
        position: absolute;
        border-radius: 50%;
        filter: blur(90px);
        pointer-events: none;
        z-index: 1;
        opacity: 0.45;
        animation: orbFloat 10s ease-in-out infinite alternate;
    }
    .orb-1 {
        width: 450px;
        height: 450px;
        top: -80px;
        right: -80px;
        background: radial-gradient(circle, rgba(184, 134, 11, 0.28) 0%, rgba(184, 134, 11, 0) 70%);
    }
    .orb-2 {
        width: 500px;
        height: 500px;
        bottom: -100px;
        left: -100px;
        background: radial-gradient(circle, rgba(15, 23, 42, 0.18) 0%, rgba(15, 23, 42, 0) 70%);
        animation-delay: -5s;
    }
    .career-grid-pattern {
        position: absolute;
        inset: 0;
        background-image: radial-gradient(rgba(15, 23, 42, 0.06) 1px, transparent 1px);
        background-size: 28px 28px;
        pointer-events: none;
        z-index: 1;
        opacity: 0.6;
    }

    .career-main-container {
        position: relative;
        z-index: 2;
        width: 100%;
    }

    /* Header Area */
    .career-header-area {
        text-align: center;
        margin-bottom: 3.5rem;
        animation: careerFadeInUp 0.8s ease-out both;
    }
    .career-badge-wrap {
        display: inline-flex;
        align-items: center;
        gap: 0.6rem;
        padding: 0.45rem 1.25rem;
        background: rgba(255, 255, 255, 0.85);
        border: 1px solid rgba(184, 134, 11, 0.25);
        border-radius: 9999px;
        box-shadow: 0 4px 15px -2px rgba(184, 134, 11, 0.12);
        backdrop-filter: blur(8px);
        margin-bottom: 1rem;
        transition: transform 0.3s ease, box-shadow 0.3s ease;
    }
    .career-badge-wrap:hover {
        transform: translateY(-2px);
        box-shadow: 0 8px 20px -2px rgba(184, 134, 11, 0.2);
    }
    .career-pulse-dot {
        width: 8px;
        height: 8px;
        background: var(--secondary-color, #b8860b);
        border-radius: 50%;
        box-shadow: 0 0 0 0 rgba(184, 134, 11, 0.7);
        animation: pulseDot 2s infinite;
    }
    .career-badge-title {
        font-size: 0.85rem !important;
        font-weight: 700 !important;
        letter-spacing: 2px !important;
        color: var(--secondary-color, #b8860b) !important;
        margin: 0 !important;
        text-transform: uppercase;
        border: none !important;
    }
    .career-hero-title {
        font-size: 3.25rem;
        font-weight: 800;
        letter-spacing: -0.5px;
        color: var(--primary-color, #0f172a);
        margin: 0;
        line-height: 1.15;
        background: linear-gradient(135deg, var(--primary-color, #0f172a) 0%, #334155 100%);
        -webkit-background-clip: text;
        -webkit-text-fill-color: transparent;
    }

    /* Content Grid */
    .career-content-grid {
        display: flex;
        align-items: center;
        gap: 4rem;
        max-width: 1200px;
        margin: 0 auto;
    }
    .career-visual-col {
        flex: 1.1;
        min-width: 320px;
        animation: careerFadeInUp 0.9s 0.15s ease-out both;
    }
    .career-info-col {
        flex: 1;
        min-width: 320px;
        display: flex;
        flex-direction: column;
        gap: 2rem;
        animation: careerFadeInUp 0.9s 0.3s ease-out both;
    }

    /* Visual Graphic Card & Float Animation */
    .career-visual-card {
        position: relative;
        background: rgba(255, 255, 255, 0.75);
        backdrop-filter: blur(14px);
        -webkit-backdrop-filter: blur(14px);
        border: 1px solid rgba(255, 255, 255, 0.9);
        border-radius: 28px;
        padding: 3rem 2.5rem;
        box-shadow: 0 25px 50px -12px rgba(15, 23, 42, 0.08), 0 0 0 1px rgba(15, 23, 42, 0.04);
        display: flex;
        justify-content: center;
        align-items: center;
        transition: transform 0.4s cubic-bezier(0.16, 1, 0.3, 1), box-shadow 0.4s ease;
    }
    .career-visual-card:hover {
        transform: translateY(-6px);
        box-shadow: 0 35px 60px -15px rgba(15, 23, 42, 0.12), 0 0 0 1px rgba(184, 134, 11, 0.2);
    }
    .career-image-halo {
        position: absolute;
        width: 70%;
        height: 70%;
        background: radial-gradient(circle, rgba(184, 134, 11, 0.15) 0%, rgba(255, 255, 255, 0) 70%);
        border-radius: 50%;
        pointer-events: none;
        z-index: 1;
        animation: haloPulse 4s ease-in-out infinite alternate;
    }
    .career-floating-img {
        position: relative;
        z-index: 2;
        width: 100%;
        height: auto;
        display: block;
        animation: floatLevitate 6s ease-in-out infinite;
        filter: drop-shadow(0 15px 25px rgba(0, 0, 0, 0.08));
    }

    /* Cards Common */
    .career-card {
        background: rgba(255, 255, 255, 0.85);
        backdrop-filter: blur(16px);
        -webkit-backdrop-filter: blur(16px);
        border: 1px solid rgba(255, 255, 255, 0.95);
        border-radius: 24px;
        box-shadow: 0 20px 40px -12px rgba(15, 23, 42, 0.07), 0 0 0 1px rgba(15, 23, 42, 0.03);
        transition: transform 0.35s cubic-bezier(0.16, 1, 0.3, 1), box-shadow 0.35s ease, border-color 0.35s ease;
    }
    .career-card:hover {
        transform: translateY(-4px);
        box-shadow: 0 25px 50px -12px rgba(15, 23, 42, 0.11), 0 0 0 1px rgba(184, 134, 11, 0.2);
        border-color: rgba(184, 134, 11, 0.3);
    }

    /* Manifesto Card */
    .career-manifesto-card {
        position: relative;
        padding: 2.75rem 2.25rem 2.75rem 2.5rem;
        overflow: hidden;
    }
    .card-accent-bar {
        position: absolute;
        top: 0;
        left: 0;
        bottom: 0;
        width: 5px;
        background: linear-gradient(180deg, var(--secondary-color, #b8860b) 0%, rgba(184, 134, 11, 0.4) 100%);
    }
    .career-desc-text {
        font-size: 1.15rem;
        line-height: 1.85;
        color: #334155;
        margin: 0;
        font-weight: 400;
        letter-spacing: -0.1px;
    }

    /* CTA Card with Drag & Drop capability */
    .career-cta-card {
        padding: 2.25rem 2.25rem;
        display: flex;
        flex-direction: column;
        gap: 1.5rem;
        cursor: pointer;
        position: relative;
        transition: all 0.3s ease;
    }
    .career-cta-card.is-dragover {
        border-color: var(--secondary-color, #b8860b) !important;
        background: rgba(254, 249, 195, 0.4) !important;
        box-shadow: 0 0 0 4px rgba(184, 134, 11, 0.25) !important;
        transform: scale(1.02);
    }
    .career-cv-prompt-wrap {
        display: flex;
        align-items: center;
        gap: 0.85rem;
    }
    .cv-prompt-icon {
        display: inline-flex;
        align-items: center;
        justify-content: center;
        width: 44px;
        height: 44px;
        border-radius: 12px;
        background: rgba(184, 134, 11, 0.12);
        color: var(--secondary-color, #b8860b);
        flex-shrink: 0;
        box-shadow: 0 4px 10px rgba(184, 134, 11, 0.1);
        transition: transform 0.3s ease;
    }
    .career-card:hover .cv-prompt-icon {
        transform: scale(1.08) rotate(3deg);
    }
    .career-cv-label {
        font-size: 1.35rem;
        font-weight: 700;
        color: var(--primary-color, #0f172a);
        margin: 0;
        letter-spacing: -0.2px;
    }

    .career-actions-wrap {
        display: flex;
        flex-wrap: wrap;
        align-items: center;
        gap: 1.5rem;
    }
    .career-send-btn {
        position: relative;
        display: inline-flex;
        align-items: center;
        gap: 0.75rem;
        padding: 1rem 2.25rem;
        background: linear-gradient(135deg, var(--secondary-color, #b8860b) 0%, #996515 100%);
        color: #ffffff !important;
        border: none;
        border-radius: 14px;
        font-weight: 600;
        font-size: 1.1rem;
        cursor: pointer;
        text-decoration: none;
        box-shadow: 0 10px 25px -5px rgba(184, 134, 11, 0.4), 0 0 0 1px rgba(255, 255, 255, 0.2) inset;
        overflow: hidden;
        transition: all 0.35s cubic-bezier(0.16, 1, 0.3, 1);
    }
    .career-send-btn::before {
        content: '';
        position: absolute;
        top: 0;
        left: -100%;
        width: 100%;
        height: 100%;
        background: linear-gradient(90deg, transparent, rgba(255, 255, 255, 0.35), transparent);
        transition: left 0.6s ease;
    }
    .career-send-btn:hover {
        transform: translateY(-3px) scale(1.02);
        box-shadow: 0 16px 32px -6px rgba(184, 134, 11, 0.55), 0 0 0 1px rgba(255, 255, 255, 0.3) inset;
    }
    .career-send-btn:hover::before {
        left: 100%;
    }
    .career-send-btn:hover .btn-arrow-icon {
        transform: translateX(4px);
    }
    .btn-arrow-icon {
        transition: transform 0.3s ease;
    }
    .career-email-link {
        display: inline-flex;
        align-items: center;
        gap: 0.5rem;
        color: #64748b;
        font-size: 0.98rem;
        font-weight: 500;
        text-decoration: none;
        padding: 0.6rem 1rem;
        border-radius: 10px;
        background: rgba(15, 23, 42, 0.04);
        border: 1px solid rgba(15, 23, 42, 0.06);
        transition: all 0.25s ease;
    }
    .career-email-link:hover {
        color: var(--secondary-color, #b8860b);
        background: rgba(184, 134, 11, 0.08);
        border-color: rgba(184, 134, 11, 0.25);
        transform: translateY(-1px);
    }

    /* Modal Backdrop & Dialog */
    .cv-modal-backdrop {
        position: fixed;
        inset: 0;
        z-index: 99999;
        background: rgba(15, 23, 42, 0.72);
        backdrop-filter: blur(10px);
        -webkit-backdrop-filter: blur(10px);
        display: flex;
        align-items: center;
        justify-content: center;
        padding: 20px;
        animation: cvFadeIn 0.3s ease-out;
    }
    .cv-modal-dialog {
        position: relative;
        background: #ffffff;
        border-radius: 26px;
        max-width: 640px;
        width: 100%;
        max-height: 90vh;
        overflow-y: auto;
        padding: 2.75rem 2.5rem;
        box-shadow: 0 25px 60px -15px rgba(0, 0, 0, 0.35), 0 0 0 1px rgba(0, 0, 0, 0.05);
        animation: cvSlideUp 0.35s cubic-bezier(0.16, 1, 0.3, 1);
    }
    .cv-modal-close {
        position: absolute;
        top: 20px;
        right: 22px;
        width: 38px;
        height: 38px;
        border-radius: 50%;
        background: #f1f5f9;
        border: none;
        font-size: 24px;
        line-height: 1;
        color: #64748b;
        cursor: pointer;
        display: flex;
        align-items: center;
        justify-content: center;
        transition: all 0.2s ease;
    }
    .cv-modal-close:hover {
        background: #e2e8f0;
        color: #0f172a;
        transform: rotate(90deg);
    }

    /* Modal Header */
    .cv-modal-header {
        text-align: center;
        margin-bottom: 2rem;
    }
    .cv-modal-badge {
        display: inline-flex;
        align-items: center;
        gap: 0.5rem;
        padding: 0.35rem 1rem;
        background: rgba(184, 134, 11, 0.1);
        border: 1px solid rgba(184, 134, 11, 0.25);
        border-radius: 9999px;
        font-size: 11px;
        font-weight: 700;
        letter-spacing: 1.5px;
        color: var(--secondary-color, #b8860b);
        margin-bottom: 0.75rem;
    }
    .cv-modal-title {
        font-size: 2rem;
        font-weight: 800;
        color: var(--primary-color, #0f172a);
        margin: 0 0 0.5rem 0;
        letter-spacing: -0.5px;
    }
    .cv-modal-subtitle {
        color: #64748b;
        font-size: 1.02rem;
        margin: 0;
    }

    /* Modal Dropzone */
    .cv-dropzone {
        position: relative;
        border: 2px dashed #cbd5e1;
        border-radius: 18px;
        background: #f8fafc;
        padding: 2rem 1.5rem;
        text-align: center;
        cursor: pointer;
        margin-bottom: 1.5rem;
        transition: all 0.3s ease;
    }
    .cv-dropzone:hover,
    .cv-dropzone.is-dragover {
        border-color: var(--secondary-color, #b8860b);
        background: rgba(184, 134, 11, 0.04);
        box-shadow: 0 4px 16px rgba(184, 134, 11, 0.1);
    }
    .cv-hidden-file-input {
        position: absolute;
        inset: 0;
        width: 100%;
        height: 100%;
        opacity: 0;
        cursor: pointer;
        z-index: 5;
    }
    .cv-dropzone-icon {
        display: inline-flex;
        align-items: center;
        justify-content: center;
        width: 60px;
        height: 60px;
        border-radius: 50%;
        background: #ffffff;
        color: var(--secondary-color, #b8860b);
        box-shadow: 0 6px 18px -4px rgba(184, 134, 11, 0.25);
        margin-bottom: 0.85rem;
    }
    .cv-dropzone-text {
        font-size: 1.05rem;
        color: #1e293b;
        margin: 0 0 0.35rem 0;
    }
    .cv-dropzone-text strong {
        color: var(--secondary-color, #b8860b);
    }
    .cv-dropzone-hint {
        font-size: 0.85rem;
        color: #94a3b8;
        margin: 0;
    }

    /* File Selected State in Dropzone */
    .cv-file-selected-state {
        display: flex;
        align-items: center;
        justify-content: space-between;
        background: #ffffff;
        border: 1px solid #bbf7d0;
        border-radius: 12px;
        padding: 0.85rem 1.25rem;
        position: relative;
        z-index: 10;
        box-shadow: 0 4px 12px rgba(16, 185, 129, 0.1);
    }
    .cv-selected-icon {
        font-size: 26px;
        margin-right: 12px;
    }
    .cv-selected-info {
        flex: 1;
        text-align: left;
    }
    .cv-selected-name {
        display: block;
        font-weight: 700;
        color: #0f172a;
        font-size: 14px;
        word-break: break-all;
    }
    .cv-selected-size {
        font-size: 12px;
        color: #10b981;
        font-weight: 600;
    }
    .cv-remove-file {
        background: #fee2e2;
        border: none;
        color: #ef4444;
        width: 30px;
        height: 30px;
        border-radius: 50%;
        font-size: 18px;
        line-height: 1;
        cursor: pointer;
        display: flex;
        align-items: center;
        justify-content: center;
        transition: all 0.2s ease;
    }
    .cv-remove-file:hover {
        background: #ef4444;
        color: #fff;
    }

    /* Modal Form Inputs */
    .cv-form-grid {
        display: grid;
        grid-template-columns: 1fr 1fr;
        gap: 1rem;
        margin-bottom: 1rem;
    }
    .cv-form-group {
        width: 100%;
        margin-bottom: 1rem;
    }
    .cv-input,
    .cv-textarea {
        width: 100%;
        padding: 0.95rem 1.15rem;
        background: #f8fafc;
        border: 1.5px solid #e2e8f0;
        border-radius: 12px;
        font-family: inherit;
        font-size: 1rem;
        color: #1e293b;
        transition: border-color 0.25s ease, box-shadow 0.25s ease, background 0.25s ease;
    }
    .cv-input:focus,
    .cv-textarea:focus {
        outline: none;
        background: #ffffff;
        border-color: var(--secondary-color, #b8860b);
        box-shadow: 0 0 0 4px rgba(184, 134, 11, 0.14);
    }
    .cv-textarea {
        resize: vertical;
        min-height: 90px;
    }

    /* Submit Button */
    .cv-submit-button {
        position: relative;
        width: 100%;
        padding: 1.05rem 2rem;
        background: linear-gradient(135deg, var(--secondary-color, #b8860b) 0%, #996515 100%);
        color: #ffffff;
        border: none;
        border-radius: 14px;
        font-weight: 700;
        font-size: 1.1rem;
        font-family: inherit;
        cursor: pointer;
        display: flex;
        align-items: center;
        justify-content: center;
        gap: 0.5rem;
        box-shadow: 0 10px 25px -5px rgba(184, 134, 11, 0.45);
        transition: all 0.3s ease;
        overflow: hidden;
    }
    .cv-submit-button:hover {
        transform: translateY(-2px);
        box-shadow: 0 16px 32px -5px rgba(184, 134, 11, 0.55);
    }
    .cv-submit-button:disabled {
        opacity: 0.7;
        cursor: not-allowed;
    }

    /* Alerts */
    .cv-alert-banner {
        padding: 0.95rem 1.25rem;
        border-radius: 12px;
        font-size: 0.98rem;
        line-height: 1.5;
        margin-bottom: 1.25rem;
    }
    .cv-alert-banner.is-success {
        background: #f0fdf4;
        border: 1px solid #86efac;
        color: #166534;
    }
    .cv-alert-banner.is-error {
        background: #fef2f2;
        border: 1px solid #fca5a5;
        color: #991b1b;
    }

    /* Keyframe Animations */
    @keyframes cvFadeIn {
        from { opacity: 0; }
        to { opacity: 1; }
    }
    @keyframes cvSlideUp {
        from { opacity: 0; transform: translateY(30px) scale(0.97); }
        to { opacity: 1; transform: translateY(0) scale(1); }
    }
    @keyframes careerFadeInUp {
        0% { opacity: 0; transform: translateY(28px); }
        100% { opacity: 1; transform: translateY(0); }
    }
    @keyframes floatLevitate {
        0%, 100% { transform: translateY(0px) rotate(0deg); }
        50% { transform: translateY(-12px) rotate(0.4deg); }
    }
    @keyframes haloPulse {
        0%, 100% { transform: scale(0.95); opacity: 0.4; }
        50% { transform: scale(1.15); opacity: 0.8; }
    }
    @keyframes orbFloat {
        0% { transform: translate(0, 0) scale(1); }
        100% { transform: translate(-30px, 30px) scale(1.08); }
    }
    @keyframes pulseDot {
        0% { box-shadow: 0 0 0 0 rgba(184, 134, 11, 0.7); }
        70% { box-shadow: 0 0 0 8px rgba(184, 134, 11, 0); }
        100% { box-shadow: 0 0 0 0 rgba(184, 134, 11, 0); }
    }
    .spinner {
        animation: rotateSpinner 1s linear infinite;
    }
    @keyframes rotateSpinner {
        100% { transform: rotate(360deg); }
    }

    /* Responsive */
    @media screen and (max-width: 992px) {
        .career-section-enterprise {
            padding: 70px 0 80px;
        }
        .career-content-grid {
            flex-direction: column;
            gap: 3rem;
        }
        .career-visual-card {
            padding: 2.5rem 1.5rem;
            max-width: 580px;
            margin: 0 auto;
        }
        .career-hero-title {
            font-size: 2.6rem;
        }
        .career-desc-text {
            font-size: 1.05rem;
        }
        .career-actions-wrap {
            flex-direction: column;
            align-items: flex-start;
            gap: 1rem;
        }
        .career-send-btn {
            width: 100%;
            justify-content: center;
        }
    }
    @media screen and (max-width: 640px) {
        .career-hero-title {
            font-size: 2.2rem;
        }
        .career-header-area {
            margin-bottom: 2.5rem;
        }
        .career-manifesto-card,
        .career-cta-card {
            padding: 1.75rem 1.5rem;
            border-radius: 18px;
        }
        .career-cv-label {
            font-size: 1.2rem;
        }
        .cv-form-grid {
            grid-template-columns: 1fr;
        }
        .cv-modal-dialog {
            padding: 2rem 1.5rem;
            border-radius: 20px;
        }
        .cv-modal-title {
            font-size: 1.6rem;
        }
    }
    </style>

    <!-- Interactive CV Drop & AJAX Upload Script -->
    <script>
    document.addEventListener('DOMContentLoaded', function() {
        const modal = document.getElementById('cv-drop-modal');
        const openBtn = document.getElementById('open-cv-modal-btn');
        const closeBtn = document.getElementById('cv-modal-close-btn');
        const ctaCard = document.getElementById('career-cta-card');

        const dropzone = document.getElementById('cv-modal-dropzone');
        const fileInput = document.getElementById('cv-file-input');
        const emptyState = document.getElementById('cv-dropzone-empty-state');
        const selectedState = document.getElementById('cv-dropzone-selected-state');
        const selectedFileName = document.getElementById('cv-selected-file-name');
        const selectedFileSize = document.getElementById('cv-selected-file-size');
        const removeFileBtn = document.getElementById('cv-remove-file-btn');

        const form = document.getElementById('elpis-cv-form');
        const submitBtn = document.getElementById('cv-submit-btn');
        const alertBox = document.getElementById('cv-alert-box');
        const btnText = submitBtn ? submitBtn.querySelector('.btn-text') : null;
        const btnLoader = submitBtn ? submitBtn.querySelector('.btn-loader') : null;

        function openModal() {
            if (modal) {
                modal.style.display = 'flex';
                document.body.style.overflow = 'hidden';
            }
        }

        function closeModal() {
            if (modal) {
                modal.style.display = 'none';
                document.body.style.overflow = '';
            }
        }

        if (openBtn) openBtn.addEventListener('click', openModal);
        if (closeBtn) closeBtn.addEventListener('click', closeModal);

        // Click on background closes modal
        if (modal) {
            modal.addEventListener('click', function(e) {
                if (e.target === modal) closeModal();
            });
        }

        // Escape key closes modal
        document.addEventListener('keydown', function(e) {
            if (e.key === 'Escape' && modal && modal.style.display === 'flex') {
                closeModal();
            }
        });

        // Drag & Drop onto the Career CTA Card on the page
        if (ctaCard) {
            ['dragenter', 'dragover'].forEach(evt => {
                ctaCard.addEventListener(evt, function(e) {
                    e.preventDefault();
                    e.stopPropagation();
                    ctaCard.classList.add('is-dragover');
                });
            });
            ['dragleave', 'drop'].forEach(evt => {
                ctaCard.addEventListener(evt, function(e) {
                    e.preventDefault();
                    e.stopPropagation();
                    ctaCard.classList.remove('is-dragover');
                });
            });
            ctaCard.addEventListener('drop', function(e) {
                if (e.dataTransfer && e.dataTransfer.files.length > 0) {
                    const droppedFile = e.dataTransfer.files[0];
                    handleFileSelection(droppedFile);
                    openModal();
                }
            });
        }

        // File Selection in Dropzone
        function handleFileSelection(file) {
            if (!file) return;

            const validExts = ['pdf', 'doc', 'docx'];
            const fileExt = file.name.split('.').pop().toLowerCase();
            if (!validExts.includes(fileExt)) {
                alert('Please upload a PDF, DOC, or DOCX document.');
                return;
            }

            // Assign to fileInput using DataTransfer
            const dt = new DataTransfer();
            dt.items.add(file);
            fileInput.files = dt.files;

            // Format size
            let sizeStr = (file.size / 1024).toFixed(1) + ' KB';
            if (file.size > 1024 * 1024) {
                sizeStr = (file.size / (1024 * 1024)).toFixed(1) + ' MB';
            }

            selectedFileName.textContent = file.name;
            selectedFileSize.textContent = sizeStr;

            emptyState.style.display = 'none';
            selectedState.style.display = 'flex';
        }

        if (fileInput) {
            fileInput.addEventListener('change', function() {
                if (fileInput.files.length > 0) {
                    handleFileSelection(fileInput.files[0]);
                }
            });
        }

        if (removeFileBtn) {
            removeFileBtn.addEventListener('click', function(e) {
                e.stopPropagation();
                fileInput.value = '';
                emptyState.style.display = 'block';
                selectedState.style.display = 'none';
            });
        }

        // Drag & Drop inside modal dropzone
        if (dropzone) {
            ['dragenter', 'dragover'].forEach(evt => {
                dropzone.addEventListener(evt, function(e) {
                    e.preventDefault();
                    e.stopPropagation();
                    dropzone.classList.add('is-dragover');
                });
            });
            ['dragleave', 'drop'].forEach(evt => {
                dropzone.addEventListener(evt, function(e) {
                    e.preventDefault();
                    e.stopPropagation();
                    dropzone.classList.remove('is-dragover');
                });
            });
            dropzone.addEventListener('drop', function(e) {
                if (e.dataTransfer && e.dataTransfer.files.length > 0) {
                    handleFileSelection(e.dataTransfer.files[0]);
                }
            });
        }

        // AJAX Form Submission
        if (form && submitBtn) {
            form.addEventListener('submit', function(e) {
                e.preventDefault();

                if (!fileInput.files || fileInput.files.length === 0) {
                    alertBox.className = 'cv-alert-banner is-error';
                    alertBox.innerHTML = '&#9888; Please select or drop your CV file before submitting.';
                    alertBox.style.display = 'block';
                    return;
                }

                alertBox.style.display = 'none';
                alertBox.className = 'cv-alert-banner';

                submitBtn.disabled = true;
                btnText.style.display = 'none';
                btnLoader.style.display = 'inline-block';

                const formData = new FormData(form);

                fetch('<?php echo esc_url(admin_url('admin-ajax.php')); ?>', {
                    method: 'POST',
                    body: formData
                })
                .then(res => res.json())
                .then(data => {
                    submitBtn.disabled = false;
                    btnText.style.display = 'inline-block';
                    btnLoader.style.display = 'none';

                    if (data.success) {
                        alertBox.className = 'cv-alert-banner is-success';
                        alertBox.innerHTML = '&check; ' + (data.data.message || 'CV submitted successfully!');
                        alertBox.style.display = 'block';

                        form.reset();
                        emptyState.style.display = 'block';
                        selectedState.style.display = 'none';
                    } else {
                        alertBox.className = 'cv-alert-banner is-error';
                        alertBox.innerHTML = '&#9888; ' + (data.data.message || 'Error uploading CV.');
                        alertBox.style.display = 'block';
                    }
                })
                .catch(err => {
                    submitBtn.disabled = false;
                    btnText.style.display = 'inline-block';
                    btnLoader.style.display = 'none';

                    alertBox.className = 'cv-alert-banner is-error';
                    alertBox.innerHTML = '&#9888; Network error. Please try again.';
                    alertBox.style.display = 'block';
                });
            });
        }
    });
    </script>
</main>
<?php get_footer(); ?>
