<style>
    .glass-nav {
        background: transparent;
        border-bottom: none;
    }

    /* Guest navbar shell: hanya bar putih rounded di atas background halaman */
    .guest-nav-shell {
        background: #ffffff;
        border-radius: 1.25rem;
        box-shadow: 0 10px 24px rgba(15, 23, 42, 0.08);
        border: 1px solid rgba(148, 163, 184, 0.67);
    }

    .glass-nav.scrolled .guest-nav-shell {
        box-shadow: 0 12px 28px rgba(15, 23, 42, 0.12);
    }

    /* Hero slider smooth pop-in/out effect */
    .hero-slide {
        transition: transform 700ms ease-out, opacity 700ms ease-out;
    }
    .hero-slide-inactive {
        opacity: 0.45;
        transform: scale(0.96);
    }
    .hero-slide-active {
        opacity: 1;
        transform: scale(1.02);
    }
    .hero-slide-image {
        transition: transform 900ms ease-out, opacity 700ms ease-out;
    }
    .hero-slide-active .hero-slide-image {
        transform: scale(1.04);
    }
    .hero-slide-inactive .hero-slide-image {
        transform: scale(1.01);
    }

    .nav-link {
        position: relative;
        color: #2346a3;
        transition: all 0.25s ease;
        text-shadow: none;
        border-radius: 9999px;
    }
    .nav-link:hover {
        color: #1d4ed8;
        background-color: rgba(140, 169, 255, 0.16);
        transform: translateY(0);
    }
    .nav-link.active {
        color: #1d4ed8;
    }
    .glass-nav.scrolled .nav-link {
        color: #0f172a;
    }
    .nav-link.active::after {
        content: '';
        position: absolute;
        left: 0;
        bottom: -2px;
        width: 100%;
        height: 3px;
        background: linear-gradient(90deg, #8CA9FF 0%, #B4C5FF 100%);
        border-radius: 2px;
    }

    .glass-card {
        background: rgba(255, 255, 255, 0.05);
        backdrop-filter: blur(10px);
        border: 1px solid rgba(255, 255, 255, 0.1);
        box-shadow: 0 8px 32px 0 rgba(51, 65, 85, 0.12);
    }

    .elegant-gradient {
        background: linear-gradient(135deg, #1a1c2c 0%, #2a3042 100%);
    }

    .elegant-text-gradient {
        background: linear-gradient(135deg, #c2c8ff 0%, #ffffff 100%);
        -webkit-background-clip: text;
        -webkit-text-fill-color: transparent;
    }

    .hover-lift {
        transition: transform 0.3s ease, box-shadow 0.3s ease;
    }

    .hover-lift:hover {
        transform: translateY(-5px);
        box-shadow: 0 20px 40px rgba(51, 65, 85, 0.25);
    }

    .animate-float {
        animation: float 6s ease-in-out infinite;
    }

    @keyframes float {
        0% { transform: translateY(0px); }
        50% { transform: translateY(-20px); }
        100% { transform: translateY(0px); }
    }

    .elegant-border {
        border: 1px solid rgba(255, 255, 255, 0.1);
    }

    .elegant-shadow {
        box-shadow: 0 8px 32px 0 rgba(51, 65, 85, 0.15);
    }

    .section-spacing {
        padding: 80px 0;
    }
    
    @media (min-width: 1024px) {
        .section-spacing {
            padding: 100px 0;
        }
    }

    .elegant-button {
        background: linear-gradient(135deg, #7F9CFF 0%, #8CA9FF 40%, #C3D1FF 100%);
    }

    .elegant-input {
        background: rgba(255, 255, 255, 0.05);
        border: 1px solid rgba(255, 255, 255, 0.1);
        backdrop-filter: blur(5px);
    }

    /* View Mode Button Styles */
    .view-mode-btn.active {
        background: linear-gradient(135deg, #7F9CFF 0%, #8CA9FF 60%, #C3D1FF 100%);
        color: white;
    }
    
    .view-mode-btn.active svg {
        stroke: white;
    }

    /* Masonry Layout */
    .masonry-grid {
        column-count: 4;
        column-gap: 1rem;
    }

    .masonry-grid .masonry-item {
        break-inside: avoid;
        margin-bottom: 1rem;
    }

    @media (max-width: 1024px) {
        .masonry-grid {
            column-count: 3;
        }
    }

    @media (max-width: 768px) {
        .masonry-grid {
            column-count: 2;
        }
    }

    .elegant-input:focus {
        border-color: rgba(140, 169, 255, 0.7);
        box-shadow: 0 0 0 2px rgba(140, 169, 255, 0.35);
    }

    .scroll-indicator {
        animation: bounce 2s infinite;
    }

    @keyframes bounce {
        0%, 20%, 50%, 80%, 100% { transform: translateY(0); }
        40% { transform: translateY(-30px); }
        60% { transform: translateY(-15px); }
    }

    .bg-pattern {
        background-image: radial-gradient(circle at 2px 2px, rgba(255,255,255,0.05) 1px, transparent 0);
        background-size: 40px 40px;
    }

    @keyframes fade-in {
        from { opacity: 0; }
        to { opacity: 1; }
    }

    @keyframes slide-up {
        from {
            opacity: 0;
            transform: translateY(30px);
        }
        to {
            opacity: 1;
            transform: translateY(0);
        }
    }

    .animate-slide-up {
        animation: slide-up 1s ease-out forwards;
        animation-fill-mode: forwards;
    }

    @keyframes bounce-slow {
        0%, 20%, 50%, 80%, 100% { transform: translateY(0) translateX(-50%); }
        40% { transform: translateY(-20px) translateX(-50%); }
        60% { transform: translateY(-10px) translateX(-50%); }
    }

    @keyframes gradient-shift {
        0% { background-position: 0% 50%; }
        50% { background-position: 100% 50%; }
        100% { background-position: 0% 50%; }
    }

    /* Instagram-Style Scrollbar Hide */
    .scrollbar-hide {
        -ms-overflow-style: none;
        scrollbar-width: none;
    }
    
    .scrollbar-hide::-webkit-scrollbar {
        display: none;
    }

    /* Instagram-Style Fade In Animation */
    @keyframes fadeInUp {
        from {
            opacity: 0;
            transform: translateY(30px);
        }
        to {
            opacity: 1;
            transform: translateY(0);
        }
    }

    .gallery-category-content {
        animation: fadeInUp 0.6s ease-out;
    }

    /* Smooth Category Tab Active State */
    .gallery-category-tab.active {
        background: linear-gradient(135deg, #7F9CFF 0%, #8CA9FF 50%, #C3D1FF 100%);
        color: white;
        box-shadow: 0 10px 25px rgba(140, 169, 255, 0.35);
    }

    /* Ken Burns Effect - Zoom and Pan */
    @keyframes ken-burns {
        0% { 
            transform: scale(1.05) translate(0, 0);
        }
        100% { 
            transform: scale(1.12) translate(-3%, -2%);
        }
    }

    .animate-ken-burns {
        animation: ken-burns 25s ease-in-out infinite alternate;
        will-change: transform;
    }

    .animate-fade-in {
        animation: fade-in 1.5s ease-out forwards;
    }

    .animate-gradient {
        background: linear-gradient(
            270deg,
            rgba(0,0,0,0.7) 0%,
            rgba(0,0,0,0.5) 50%,
            rgba(0,0,0,0.7) 100%
        );
        background-size: 200% 200%;
        animation: gradient-shift 15s ease infinite;
    }

    .glass-nav.scrolled {
        background: rgba(0, 0, 0, 0.3);
        border-bottom: 1px solid rgba(255, 255, 255, 0.2);
        box-shadow: 0 4px 30px rgba(0, 0, 0, 0.3);
    }
    
    /* Custom Scrollbar for Modal */
    .overflow-y-auto::-webkit-scrollbar {
        width: 8px;
    }
    
    .overflow-y-auto::-webkit-scrollbar-track {
        background: #f1f5f9;
        border-radius: 10px;
    }
    
    .overflow-y-auto::-webkit-scrollbar-thumb {
        background: linear-gradient(135deg, #7F9CFF 0%, #8CA9FF 60%, #C3D1FF 100%);
        border-radius: 10px;
    }
    
    .overflow-y-auto::-webkit-scrollbar-thumb:hover {
        background: linear-gradient(135deg, #6E8CFF 0%, #7F9CFF 60%, #B4C5FF 100%);
    }

    /* Gallery header & search accents */
    .gallery-title-gradient {
        background: linear-gradient(135deg, #5F7CFF 0%, #8CA9FF 45%, #C3D1FF 100%);
        -webkit-background-clip: text;
        -webkit-text-fill-color: transparent;
        text-shadow: 0 2px 6px rgba(15, 23, 42, 0.22);
    }

    .gallery-underline {
        background: linear-gradient(90deg, #8CA9FF 0%, #C3D1FF 100%);
    }

    .gallery-search-glow {
        background: linear-gradient(90deg, #8CA9FF 0%, #C3D1FF 100%);
    }

    /* Footer accents */
    .footer-accent {
        color: #8CA9FF;
    }

    .footer-link {
        transition: color 0.3s ease;
    }

    .footer-link:hover {
        color: #8CA9FF;
    }

    /* AI Assistant Widget */
    .ai-assistant-wrapper {
        position: fixed;
        bottom: 32px;
        right: 32px;
        z-index: 60;
        display: flex;
        flex-direction: column;
        align-items: flex-end;
        gap: 12px;
    }

    .ai-assistant-toggle {
        width: 64px;
        height: 64px;
        border-radius: 9999px;
        border: 3px solid rgba(255, 255, 255, 0.7);
        background: linear-gradient(135deg, #7F9CFF 0%, #8CA9FF 50%, #C3D1FF 100%);
        box-shadow: 0 20px 35px rgba(124, 143, 255, 0.35);
        display: flex;
        align-items: center;
        justify-content: center;
        cursor: pointer;
        transition: transform 0.3s ease, box-shadow 0.3s ease;
    }

    .ai-assistant-toggle:hover {
        transform: translateY(-4px) scale(1.02);
        box-shadow: 0 25px 45px rgba(124, 143, 255, 0.45);
    }

    .ai-assistant-toggle img {
        width: 38px;
        height: 38px;
    }

    .ai-assistant-badge {
        position: absolute;
        top: -6px;
        right: -4px;
        background: #f97316;
        color: #fff;
        font-size: 0.7rem;
        font-weight: 700;
        padding: 2px 8px;
        border-radius: 9999px;
        box-shadow: 0 4px 12px rgba(249, 115, 22, 0.4);
    }

    .ai-assistant-panel {
        width: clamp(280px, 24vw, 360px);
        max-width: calc(100vw - 32px);
        background: #ffffff;
        border-radius: 20px;
        box-shadow: 0 35px 45px rgba(15, 23, 42, 0.2);
        border: 1px solid rgba(124, 143, 255, 0.25);
        overflow: hidden;
        transform-origin: bottom right;
        animation: assistant-pop 0.35s ease forwards;
        display: flex;
        flex-direction: column;
        height: clamp(380px, 45vh, 520px);
        max-height: calc(80vh - 80px);
    }

    .ai-assistant-header {
        background: linear-gradient(135deg, #5F7CFF 0%, #8CA9FF 60%, #C3D1FF 100%);
        color: #fff;
        padding: 16px;
        display: flex;
        align-items: center;
        justify-content: space-between;
        box-shadow: inset 0 -1px 0 rgba(255, 255, 255, 0.2);
    }

    .ai-assistant-header .info {
        display: flex;
        align-items: center;
        gap: 10px;
    }

    .ai-assistant-header img {
        width: 38px;
        height: 38px;
        background: rgba(255, 255, 255, 0.2);
        border-radius: 12px;
        padding: 4px;
        border: 1px solid rgba(255, 255, 255, 0.4);
    }

    .ai-status-box {
        display: flex;
        flex-direction: column;
        gap: 2px;
    }

    .ai-status-pill {
        display: inline-flex;
        align-items: center;
        gap: 6px;
        background: rgba(255, 255, 255, 0.2);
        padding: 3px 10px;
        border-radius: 9999px;
        font-size: 0.7rem;
        font-weight: 600;
    }

    .ai-status-pill span {
        width: 8px;
        height: 8px;
        border-radius: 9999px;
        background: #4ade80;
        box-shadow: 0 0 6px rgba(74, 222, 128, 0.7);
    }

    .ai-assistant-body {
        padding: 16px 16px 0 16px;
        background: linear-gradient(180deg, #f8f9ff 0%, #ffffff 100%);
        display: flex;
        flex-direction: column;
        flex: 1;
        min-height: 0;
        overflow: hidden;
        gap: 0;
    }

    .ai-assistant-messages {
        flex: 1;
        min-height: 0;
        overflow-y: auto;
        padding-right: 4px;
        padding-bottom: 12px;
        display: flex;
        flex-direction: column;
        gap: 12px;
        scrollbar-width: thin;
        scrollbar-color: #C7D2FE #f8f9ff;
        white-space: pre-line;
    }

    .ai-assistant-messages::-webkit-scrollbar {
        width: 6px;
    }

    .ai-assistant-messages::-webkit-scrollbar-track {
        background: #f8f9ff;
        border-radius: 3px;
    }

    .ai-assistant-messages::-webkit-scrollbar-thumb {
        background: #C7D2FE;
        border-radius: 3px;
    }

    .ai-assistant-messages::-webkit-scrollbar-thumb:hover {
        background: #A5B4FC;
    }

    .ai-quick-questions {
        display: flex;
        flex-wrap: nowrap;
        gap: 8px;
        padding: 12px 16px;
        margin: 0 -16px;
        border-top: 1px solid #e5e7eb;
        overflow-x: auto;
        overflow-y: hidden;
        scrollbar-width: thin;
        scrollbar-color: #C7D2FE #f8f9ff;
        -webkit-overflow-scrolling: touch;
        position: relative;
    }

    /* Fade effect untuk menunjukkan ada scroll horizontal */
    .ai-quick-questions::after {
        content: '';
        position: absolute;
        right: 0;
        top: 12px;
        bottom: 18px;
        width: 40px;
        background: linear-gradient(to left, rgba(248, 249, 255, 0.95), transparent);
        pointer-events: none;
        z-index: 1;
    }

    .ai-quick-questions::-webkit-scrollbar {
        height: 6px;
    }

    .ai-quick-questions::-webkit-scrollbar-track {
        background: #f8f9ff;
        border-radius: 3px;
    }

    .ai-quick-questions::-webkit-scrollbar-thumb {
        background: #C7D2FE;
        border-radius: 3px;
    }

    .ai-quick-questions::-webkit-scrollbar-thumb:hover {
        background: #A5B4FC;
    }

    .ai-quick-question {
        padding: 8px 14px;
        background: linear-gradient(135deg, #EEF2FF 0%, #E0E7FF 100%);
        color: #4F46E5;
        border: 1px solid #C7D2FE;
        border-radius: 20px;
        font-size: 0.8rem;
        font-weight: 500;
        cursor: pointer;
        transition: all 0.2s ease;
        white-space: nowrap;
        flex-shrink: 0;
    }

    .ai-quick-question:hover {
        background: linear-gradient(135deg, #E0E7FF 0%, #C7D2FE 100%);
        transform: translateY(-1px);
        box-shadow: 0 4px 8px rgba(79, 70, 229, 0.15);
    }

    .ai-quick-question:active {
        transform: translateY(0);
    }

    .ai-assistant-input-wrapper {
        padding: 12px 16px;
        border-top: 1px solid #e5e7eb;
        background: #ffffff;
    }

    .ai-assistant-input-wrapper .flex {
        display: flex;
        gap: 8px;
    }

    .ai-assistant-input-wrapper input {
        flex: 1;
        padding: 10px 14px;
        border: 1px solid #d1d5db;
        border-radius: 12px;
        font-size: 0.875rem;
        outline: none;
        transition: all 0.2s ease;
    }

    .ai-assistant-input-wrapper input:focus {
        border-color: #7F9CFF;
        box-shadow: 0 0 0 3px rgba(127, 156, 255, 0.1);
    }

    .ai-assistant-input-wrapper button {
        padding: 10px 20px;
        background: linear-gradient(135deg, #7F9CFF 0%, #8CA9FF 100%);
        color: white;
        border: none;
        border-radius: 12px;
        font-size: 0.875rem;
        font-weight: 600;
        cursor: pointer;
        transition: all 0.2s ease;
    }

    .ai-assistant-input-wrapper button:hover {
        background: linear-gradient(135deg, #6B8AFF 0%, #7F9CFF 100%);
        box-shadow: 0 4px 12px rgba(127, 156, 255, 0.3);
    }

    .ai-assistant-input-wrapper button:active {
        transform: scale(0.98);
    }

    .assistant-bubble,
    .user-bubble {
        padding: 10px 14px;
        border-radius: 14px;
        font-size: 0.9rem;
        line-height: 1.4;
        max-width: 85%;
        box-shadow: 0 8px 18px rgba(15, 23, 42, 0.08);
        position: relative;
    }

    .assistant-bubble {
        background: linear-gradient(135deg, #f0f4ff 0%, #e8f0ff 100%);
        color: #1e293b;
        align-self: flex-start;
        border-bottom-left-radius: 4px;
    }

    .user-bubble {
        background: linear-gradient(135deg, #7F9CFF 0%, #8CA9FF 60%, #C3D1FF 100%);
        color: #fff;
        align-self: flex-end;
        border-bottom-right-radius: 4px;
    }

    .ai-typing {
        display: flex;
        gap: 4px;
        padding: 8px 12px;
    }

    .ai-typing span {
        width: 6px;
        height: 6px;
        background: #7F9CFF;
        border-radius: 9999px;
        animation: typing 1.2s infinite ease-in-out;
    }

    .ai-typing span:nth-child(2) { animation-delay: 0.15s; }
    .ai-typing span:nth-child(3) { animation-delay: 0.3s; }

    @keyframes typing {
        0%, 80%, 100% { opacity: 0.3; transform: translateY(0); }
        40% { opacity: 1; transform: translateY(-2px); }
    }

    @keyframes assistant-pop {
        0% {
            opacity: 0;
            transform: scale(0.9) translateY(20px);
        }
        100% {
            opacity: 1;
            transform: scale(1) translateY(0);
        }
    }

    @media (max-width: 768px) {
        .ai-assistant-wrapper {
            right: 12px;
            bottom: 12px;
        }

        .ai-assistant-panel {
            width: calc(100vw - 24px);
            height: clamp(340px, 70vh, 520px);
        }
    }

    @media (max-height: 640px) {
        .ai-assistant-panel {
            height: calc(100vh - 60px);
        }
    }

    /* Hide scroll arrow */
    #scrollToTop {
        opacity: 0 !important;
        pointer-events: none !important;
    }
</style>
