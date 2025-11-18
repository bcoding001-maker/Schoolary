<style>
    .glass-nav {
        background: transparent;
        border-bottom: 1px solid rgba(255, 255, 255, 0.1);
    }
    .nav-link {
        position: relative;
        color: #ffffff;
        transition: all 0.3s;
        text-shadow: 0 2px 4px rgba(0, 0, 0, 0.3);
    }
    .nav-link:hover {
        color: #8CA9FF;
        transform: translateY(-2px);
    }
    .nav-link.active {
        color: #8CA9FF;
    }
    .glass-nav.scrolled .nav-link {
        color: #ffffff;
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
    .nav-link:hover {
        color: #8CA9FF;
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

    .animate-slide-up {
        animation: slide-up 1s ease-out forwards;
        animation-fill-mode: forwards;
    }
    
    /* Fallback jika animasi tidak berjalan */
    @media (prefers-reduced-motion: reduce) {
        .animate-slide-up {
            opacity: 1 !important;
            animation: none;
        }
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
</style>
